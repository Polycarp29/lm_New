<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Illuminate\Support\Str;
use Filament\Widgets\ChartWidget;
use App\Models\Task\TaskAllocation;
use Filament\Widgets\Concerns\CanPoll;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileDownloads\DownloadsFiles;

class BlogPerformanceChart extends ChartWidget
{
    use CanPoll;
    // use DownloadsFiles;

    protected static ?string $heading = 'Blog Performance Trends';
    protected static ?int $sort = 4;

    public ?int $userId = null;
    public ?string $chartType = 'line';
    public ?array $dateRange = null;


    protected function getColumns(): int
    {
        return 1;
    }

    public function getColumnSpan(): string|int|array
    {
        return 'full';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('userId')
                ->label('User')
                ->options(User::pluck('name', 'id'))
                ->searchable()
                ->placeholder('All Users')
                ->reactive()
                ->afterStateUpdated(fn () => $this->updateChartData()),

            Forms\Components\Select::make('chartType')
                ->label('Chart Type')
                ->options([
                    'line' => 'Line Chart',
                    'bar' => 'Bar Chart',
                ])
                ->default('line')
                ->reactive()
                ->afterStateUpdated(fn () => $this->updateChartData()),

            Forms\Components\DatePicker::make('dateRange.start')
                ->label('Start Date')
                ->reactive()
                ->afterStateUpdated(fn () => $this->updateChartData()),

            Forms\Components\DatePicker::make('dateRange.end')
                ->label('End Date')
                ->reactive()
                ->afterStateUpdated(fn () => $this->updateChartData()),
        ];
    }

    protected function getData(): array
{
    $query = TaskAllocation::with('writer')->orderBy('created_at');

    if ($this->userId) {
        $query->where('writer_id', $this->userId);
    }

    if (!empty($this->dateRange['start'])) {
        $query->whereDate('created_at', '>=', Carbon::parse($this->dateRange['start']));
    }

    if (!empty($this->dateRange['end'])) {
        $query->whereDate('created_at', '<=', Carbon::parse($this->dateRange['end']));
    }

    $tasks = $query->get();

    // Group by writer name
    $groupedByWriter = $tasks->groupBy(fn ($task) => $task->writer->name ?? 'Unknown');

    $allDates = $tasks->pluck('created_at')
        ->map(fn ($date) => Carbon::parse($date)->format('Y-m-d'))
        ->unique()
        ->sort()
        ->values();

    $labels = $allDates->toArray();

    $datasets = [];

    foreach ($groupedByWriter as $writer => $tasksByWriter) {
        $scoresByDate = $tasksByWriter->groupBy(fn ($task) => Carbon::parse($task->created_at)->format('Y-m-d'))
            ->map(fn ($dayTasks) => round($dayTasks->avg('perfomance_score'), 2));

        $data = collect($labels)->map(fn ($date) => $scoresByDate[$date] ?? null)->toArray();

        $datasets[] = [
            'label' => $writer,
            'data' => $data,
            'fill' => false,
            'tension' => 0.4,
        ];
    }

    return [
        'labels' => $labels,
        'datasets' => $datasets,
    ];
}


    protected function getType(): string
    {
        return $this->chartType ?? 'line';
    }

    protected function getActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('Download CSV')
                ->action(fn () => $this->downloadCsv())
                ->icon('heroicon-o-arrow-down-tray'),
        ];
    }

    protected function downloadCsv()
    {
        $query = TaskAllocation::with('writer');

        if ($this->userId) {
            $query->where('writer_id', $this->userId);
        }

        if ($this->dateRange['start'] ?? null) {
            $query->whereDate('created_at', '>=', Carbon::parse($this->dateRange['start']));
        }

        if ($this->dateRange['end'] ?? null) {
            $query->whereDate('created_at', '<=', Carbon::parse($this->dateRange['end']));
        }

        $tasks = $query->get();

        $csvData = $tasks->map(function ($task) {
            return [
                'User' => $task->writer->name ?? 'N/A',
                'Blog Title' => $task->main_title,
                'Score' => $task->perfomance_score,
                'Date' => Carbon::parse($task->created_at)->toDateString(),
            ];
        });

        $filename = 'blog_performance_' . now()->format('Ymd_His') . '.csv';
        $filePath = 'exports/' . $filename;

        $csv = implode(",", array_keys($csvData->first() ?? [])) . "\n";
        foreach ($csvData as $row) {
            $csv .= implode(",", array_map(fn ($v) => '"' . str_replace('"', '""', $v) . '"', $row)) . "\n";
        }

        Storage::disk('local')->put($filePath, $csv);

        return response()->download(storage_path("app/{$filePath}"))->deleteFileAfterSend(true);
    }
}
