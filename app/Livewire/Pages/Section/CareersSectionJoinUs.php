<?php

namespace App\Livewire\Pages\Section;

use Livewire\Component;
use App\Models\OpenPositions;
use Livewire\WithFileUploads;
use App\Models\JobOpeningData;
use App\Mail\ApplicationSuccess;
use Illuminate\Support\Facades\Mail;

class CareersSectionJoinUs extends Component
{
    use WithFileUploads;

    public $getData, $loading;
    public $isModalOpen = false;

    public $fname, $mname, $lname, $email, $phone_number, $job_title, $cv, $jobId, $jobName, $jobDetails;

    public function mount()
    {
        $this->getData();
    }

    public function getData()
    {
        $this->getData = OpenPositions::all();
    }

    public function openModal($jobId)
    {
        $this->jobId = $jobId;
        $this->isModalOpen = true;

        $this->jobDetails = OpenPositions::findOrFail($this->jobId);
        $this->jobName = $this->jobDetails->{'job-title'};
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->isModalOpen = false;
    }

    public function resetFields()
    {
        $this->fname = '';
        $this->mname = '';
        $this->lname = '';
        $this->email = '';
        $this->phone_number = '';
        $this->job_title = '';
        $this->cv = '';
        $this->jobId = null;
        $this->jobDetails = null;
    }

    public function save()
    {
        $this->loading = true;

        $this->validate([
            'fname' => 'required|min:4|max:11',
            'mname' => 'nullable|min:4',
            'lname' => 'required|min:4|max:11',
            'email' => 'required|email',
            'phone_number' => 'required',
            'cv' => 'required|file|mimes:pdf,docx,txt|max:10240',
        ]);

        $filePath = null;

        if ($this->cv) {
            $filePath = $this->cv->store('uploads/cvs', 'public');
        }

        JobOpeningData::create([
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'open_positions_id' => $this->jobId,
            'cv' => $filePath,
        ]);


        // Send Email Message

        Mail::to( $this->email)->send( new ApplicationSuccess([
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'email' => $this->email,
        ]));

        session()->flash('message', 'Details submitted successfully! We will contact you soon.');

        $this->resetFields();

        // Simulate preloader delay
        $this->loading = false;

        $this->dispatch('closeModalAfterDelay');


    }

    public function render()
    {
        return view('livewire.pages.section.careers-section-join-us');
    }
}
