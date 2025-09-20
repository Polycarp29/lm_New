<?php

namespace App\Livewire\Pages\User\Actions;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Task\TaskAllocation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Services\Plagarism\CopyLeaksService;
use App\Notifications\SeoApprovedNotification;
use App\Services\Whatsapp\whatsappNotifications;
use App\Services\SeoAnalytics\FetchGoogleDocument;
use Livewire\WithFileUploads;

class ViewTask extends Component
{

    use WithFileUploads;
    #[Layout('components.layouts.main')]

    public $taskId;
    public $taskData;

    public $status;
    public $blogLink;

    public $result,$plagarism;

    public $manualModal = false;

    public $content = '';



    public function mount($taskId)
    {
        $this->taskId = $taskId;
        $this->fetchTaskDetails();
    }

    public function fetchTaskDetails()
    {
        $this->taskData = TaskAllocation::with(['taskcategory', 'writer', 'reviewer', 'taskcategory.tasktypes.taskinsurer'])->where('id', $this->taskId)->first();
        $this->blogLink = $this->taskData->doc_link;
        $this->status = $this->taskData->progress;
    }


    // Extract google doc id

    public function extractGoogleDocId($googleDocUrl)
    {
        preg_match('/\/d\/(.*?)\//', $googleDocUrl, $matches);
        return $matches[1] ?? null;
    }



    public function openManualDialog()
    {
        $this->manualModal = true;
    }

    public function closeManualDialog()
    {
        $this->manualModal = false;
    }


    public function manuallyAnalyse()
{
    $user = Auth::user();

    $this->validate([
        'content' => 'required|string|min:10',
        'blogLink' => 'required|url',
        'status' => 'required|in:in_progress,done',
        'plagarism' => 'required|image|max:4000',
    ]);

    if ($this->plagarism) {
        $filePath = $this->plagarism->store('plagarism_image', 'public');
    }

    // $checkScore = TaskAllocation::whereNotNull('perfomance_score')
    //     ->where('id', $this->taskId)
    //     ->exists();

    // if ($checkScore) {
    //     $this->dispatch('showToast', message: 'Document had already been analysed', type: 'error');
    //     return $this->dispatch('analysis-failed');
    // }

    try {
        $plainContent = strip_tags($this->content);

        if ($this->status === 'in_progress' || $this->status === 'pending') {
            $this->dispatch('showToast', message: 'Please, make sure the task is completed and marked done before you can submit', type: 'error');
            return $this->dispatch('analysis-failed');
        }

        if (!$plainContent) {
            $this->dispatch('showToast', 'Invalid document content.', type: 'error');
            return $this->dispatch('analysis-failed');
        }

        $mainKeyword = $this->taskData->main_keyword;
        $secondaryKeywords = array_filter(array_map('trim', explode('<br>', strip_tags($this->taskData->secondary_keywords, '<br>'))));

        $prompt = "Here is the blog content I want you to analyze:\n\n$plainContent\n\n" .
            "Main keyword: \"$mainKeyword\"\n" .
            "Secondary keywords: " . json_encode($secondaryKeywords) . "\n\n" .
            "Please return a JSON response analyzing the following:\n" .
            "1. Main keyword usage (where it appears and how often)\n" .
            "2. Secondary keywords used and missing\n" .
            "3. Total word count important\n" .
            "4. Heading structure (H1, H2, H3 correctness) important\n" .
            "5. Internal and external link usage important\n" .
            "6. Readability and content structure important\n" .
            "7. On-page SEO issues (if any) Important\n" .
            "8. Recommendations to improve SEO, Very Important\n" .
            "9. SEO performance score from 0 to 100 based on best practices.\n\n" .
            "Return all valid responses from what is requested. Return only a valid JSON.";

        $response = Http::withToken(config('services.openai.secret_key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4.1',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an expert SEO assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.5,
            ]);

        $aiRawOutput = $response->json()['choices'][0]['message']['content'] ?? null;

        if (!$aiRawOutput) {
            $this->dispatch('showToast', 'Failed to analyze content.', type: 'error');
            return $this->dispatch('analysis-failed');
        }

        $cleanedOutput = preg_replace('/^```json|```$/m', '', trim($aiRawOutput));
        $seoAnalysis = json_decode(trim($cleanedOutput), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::warning('Invalid AI JSON response', ['raw' => $aiRawOutput]);
            $this->dispatch('showToast', message: 'AI response was not valid JSON.', type: 'error');
            return $this->dispatch('analysis-failed');
        }

        $seoScore = $seoAnalysis['seo_performance_score'] ?? null;
        $totalCount = $seoAnalysis['total_word_count'] ?? null;

        if ($seoScore < 60) {
            TaskAllocation::updateOrCreate([
                'writer_id' => $user->id,
                'id' => $this->taskId,
            ], [
                'progress' => $this->status,
                'seo_analysis' => json_encode($seoAnalysis),
                'perfomance_score' => $seoScore,
                'reviewer_count' => $totalCount,
                'content' => $this->content,
                'doc_link' => $this->blogLink,
                'taskstatus' => 'rejected',
            ]);

            $this->dispatch('showToast', message: 'Your SEO Perfomance Score is too low! Your Article will be automatically be re-assigned', type: 'error');
            return $this->dispatch('analysis-failed');
        }

        TaskAllocation::updateOrCreate([
            'writer_id' => $user->id,
            'id' => $this->taskId,
        ], [
            'progress' => $this->status,
            'seo_analysis' => json_encode($seoAnalysis),
            'perfomance_score' => $seoScore,
            'reviewer_count' => $totalCount,
            'content' => $this->content,
            'doc_link' => $this->blogLink,
            'plagrism_image' => $filePath,
        ]);

        $link = 'http://leemarketing.io/user/task_view/' . $this->taskId;

        User::find($user->id)->notify(new SeoApprovedNotification($this->taskData->main_title, $link));

        $this->dispatch('showToast', message: 'Content successfully analyzed and submitted!', type: 'success');
        return $this->dispatch('analysis-submitted');

    } catch (\Exception $e) {
        Log::error('SEO Analysis Failed: ' . $e->getMessage());
        $this->dispatch('showToast', 'An error occurred during analysis.', type: 'error');
        return $this->dispatch('analysis-failed');
    }
}



    public function submittask()
    {
        $user = Auth::user();

        $this->validate([
            'blogLink' => 'required|active_url',
            'status' => 'required',
        ]);


        if ($this->status === 'in_progress' || $this->status === 'pending') {
            return $this->dispatch('showToast', message: 'Please,  make sure the task is completed and marked done before you can submit', type: 'error');
        }

        $docId = $this->extractGoogleDocId($this->blogLink);

        if (!$docId) {
            return $this->dispatch('showToast', 'Invalid document link', type: 'error');
        }

        $documentContent = new FetchGoogleDocument();
        $text = $documentContent->fetchGoogleDocContent($user->google_token, $user->google_refresh_token, $docId);

        if (!$text) {
            return $this->dispatch('showToast', message: 'Unable to read this document', type: 'error');
        }

        $mainKeyword = $this->taskData->main_keyword;
        $secondaryKeywords = array_filter(array_map('trim', explode('<br>', strip_tags($this->taskData->secondary_keywords, '<br>'))));

        $prompt = "Here is the blog content I want you to analyze:\n\n$text\n\n" .
            "Main keyword: \"$mainKeyword\"\n" .
            "Secondary keywords: " . json_encode($secondaryKeywords) . "\n\n" .
            "Please return a JSON response analyzing the following:\n" .
            "1. Main keyword usage (where it appears and how often)\n" .
            "2. Secondary keywords used and missing\n" .
            "3. Total word count important\n" .
            "4. Heading structure (H1, H2, H3 correctness) important \n" .
            "5. Internal and external link usage important \n" .
            "6. Readability and content structure important \n" .
            "7. On-page SEO issues (if any) Important\n" .
            "8. Recommendations to improve SEO Important\n" .
            "9. SEO performance score from 0 to 100 based on best practices.\n\n" .
            "Return all valid responses from what is requested" .
            "Return only a valid JSON.";

        try {
            $response = Http::withToken(config('services.openai.secret_key'))
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4.1',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an expert SEO assistant.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.5,
                ]);

            $aiRawOutput = $response->json()['choices'][0]['message']['content'] ?? null;

            if (!$aiRawOutput) {
                return $this->dispatch('showToast', 'Failed to analyze content.', type: 'error');
            }

            // Clean up markdown-style code blocks from AI response
            $cleanedOutput = preg_replace('/^```json|```$/m', '', trim($aiRawOutput));
            $cleanedOutput = trim($cleanedOutput);

            // Decode JSON
            $seoAnalysis = json_decode($cleanedOutput, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::warning('Invalid AI JSON response', ['raw' => $aiRawOutput]);
                return $this->dispatch('showToast', message: 'AI response was not valid JSON.', type: 'error');
            }

            $seoScore = $seoAnalysis['seo_performance_score'] ?? null;
            $totalCount = $seoAnalysis['total_word_count'] ?? null;


            TaskAllocation::updateOrCreate([
                'writer_id' => $user->id,
                'id' => $this->taskId,
            ], [
                'doc_link' => $this->blogLink,
                'progress' => $this->status,
                'seo_analysis' => json_encode($seoAnalysis),
                'perfomance_score' => $seoScore,
                'reviewer_count' => $totalCount,
                'content' => $text,
            ]);

            User::find($user->id)->notify(new SeoApprovedNotification($this->taskData->main_title, $this->blogLink));

            // Check For Plagarism


            $this->dispatch('showToast', message: 'Task submitted and analyzed successfully.', type: 'success');
            $this->dispatch('task-submitted');
        } catch (\Exception $e) {
            Log::error('AI SEO request failed', ['error' => $e->getMessage()]);
            return $this->dispatch('showToast', message: 'Model request failed: ' . $e->getMessage(), type: 'error');
        }
    }


    public function render()
    {
        return view('livewire.pages.user.actions.view-task');
    }
}
