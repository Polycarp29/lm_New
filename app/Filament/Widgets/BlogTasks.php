<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use App\Models\Task\TaskAllocation;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Concerns\CanNotify;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Services\SeoAnalytics\SeoAnalyzerServices;
use App\Http\Controllers\Actions\SEOAnalysisController;

class BlogTasks extends BaseWidget
{

    use CanNotify;
    protected static ?int $sort = 6;


    public static function canView(): bool
    {
        return true; // Optional: gate it as needed
    }

    // Make it full width
    protected function getColumns(): int
    {
        return 1;
    }

    public function getColumnSpan(): string|int|array
    {
        return 'full';
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                TaskAllocation::query()->latest(),
            )
            ->columns([
                // ...
                TextColumn::make('main_keyword')->sortable()->searchable(),
                TextColumn::make('keyword_difficulty'),
                TextColumn::make('secondary_keywords')
                    ->label('Secondary Keywords')
                    ->formatStateUsing(fn(string $state): HtmlString => new HtmlString($state))
                    ->limit(400),
                TextColumn::make('main_title')
                    ->label('Main Title')
                    ->limit(50)
                    ->sortable(),
                TextColumn::make('due_date')
                    ->label('Due Date')
                    ->sortable()
                    ->dateTimeTooltip()
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return 'No due date';
                        }

                        return Carbon::parse($state)->format('M d, Y');
                    })
                    ->color(function ($state) {
                        if (!$state) {
                            return 'gray'; // or danger, based on your preference
                        }

                        $due = Carbon::parse($state);
                        $now = now();
                        $daysUntilDue = $now->diffInDays($due, false); // false = show negative if overdue

                        return match (true) {
                            $daysUntilDue <= 0 => 'danger',    // overdue
                            $daysUntilDue <= 4 => 'red',
                            $daysUntilDue <= 7 => 'yellow',
                            default => 'green',
                        };
                    }),

                TextColumn::make('writer.name')
                    ->label('Writer')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('reviewer.name')
                    ->label('Reviewer')
                    ->sortable()
                    ->searchable(),

                BooleanColumn::make('seo_approved')
                    ->label('SEO Approved')
                    ->sortable(),

                BadgeColumn::make('priority')
                    ->label('Priority')
                    ->colors(['low' => 'gray', 'medium' => 'yellow', 'high' => 'green'])
                    ->sortable(),
                TextColumn::make('doc_link')
                    ->label('Document')
                    ->url(fn($record) => $record->doc_link, true) // `true` makes it open in a new tab
                    ->openUrlInNewTab()
                    ->limit(30),
                TextColumn::make('blog_link')->label('Blog Url')->url(fn($record) => $record->blog_link, true)
                    ->openUrlInNewTab()->limit(30),


                BooleanColumn::make('reviewed')
                    ->label('Reviewed')
                    ->sortable(),

                TextColumn::make('perfomance_score')
                    ->label('Performance Score')
                    ->sortable()
                    ->numeric(),
            ])
            ->filters([
                SelectFilter::make('progress')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'done' => 'Completed',
                    ])
                    ->default(null),
                SelectFilter::make('seo_approved')
                    ->label('SEO Approved')
                    ->options([
                        true => 'Approved',
                        false => 'Not Approved',
                    ])
                    ->default(null),
            ])
            ->actions([
                // Tables\Actions\DeleteAction::make(),
                // Action::make('analyse')
                // ->label('Analyse')
                // ->color('info')
                // ->icon('heroicon-o-chart-bar')
                // ->requiresConfirmation()
                // ->action(function ($record, $livewire) {
                //     $seoService = new SeoAnalyzerServices();
                //     $controller = new SEOAnalysisController($seoService);
                //     $request = new \Illuminate\Http\Request([
                //         'url' => $record->blog_link,
                //         'keyword' => $record->main_keyword,
                //     ]);

                //     $controller->analyzeBlog($request);

                //     Notification::make()
                //     ->title('SEO Analysis completed!')
                //     ->success()
                //     ->send();
                // }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
