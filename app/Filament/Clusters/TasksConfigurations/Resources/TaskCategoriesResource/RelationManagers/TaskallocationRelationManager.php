<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources\TaskCategoriesResource\RelationManagers;

use Filament\Forms;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use App\Models\Task\TaskAllocation;
use App\Notifications\TaskApproved;
use App\Notifications\TaskRejected;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;
use App\Notifications\ReviewAssigned;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\TaskHasBeenAssigned;
use App\Notifications\TaskHasBeenReviewed;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SecondaryKeywordsUpdated;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Notifications\AdminSystemNotifications;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\Filter;
use Filament\Resources\RelationManagers\RelationManager;

class TaskallocationRelationManager extends RelationManager
{
    protected static string $relationship = 'taskallocation';
    protected static ? string $label = 'Blog Articles';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description('Include every task that belongs to the above category. All will be registered here.')
                    ->schema([
                        TextInput::make('main_keyword')
                            ->label('Main Keyword')
                            ->required(),

                        TextInput::make('keyword_difficulty')
                            ->label('Keyword Difficulty')
                            ->numeric(),


                        RichEditor::make('secondary_keywords')
                            ->afterStateUpdated(function ($state, callable $get) {
                                if ($state) {
                                    $taskId = $get('id');
                                    $task =  TaskAllocation::where('id', $taskId)->first();
                                    $task->writer_id;

                                    $writer = User::find($task->writer_id);

                                    if ($writer) {
                                        Notification::send($writer, new  SecondaryKeywordsUpdated($writer->writer_id, $taskId));
                                    }
                                }
                            })
                            ->label('Secondary Keywords'),

                        TextInput::make('main_title')
                            ->label('Main Title')
                            ->required(),

                        RichEditor::make('keyword_photo')
                            ->label('Keyword Photos'),


                        RichEditor::make('suggested_topics')
                            ->label('Suggested Topics'),


                        RichEditor::make('suggested_subtopics')
                            ->label('Suggested Subtopics'),


                        RichEditor::make('copy_leaks')
                            ->label('Copy Leaks'),

                        Select::make('writer_id')
                            ->label('Writer')
                            ->afterStateUpdated(function ($state, callable $get) {
                                if ($state) {
                                    $taskId = $get('id');
                                    $writerId = $state;
                                    // Find Writer
                                    Log::info('User  log:', [
                                        'user' => $writerId,
                                    ]);

                                    $writer = \App\Models\User::find($writerId);
                                    if ($writer) {
                                        Notification::send($writer, new TaskHasBeenAssigned($writerId, $taskId));
                                    }
                                }
                            })
                            ->searchable()
                            ->options(function () {
                                return \App\Models\User::pluck('name', 'id')->toArray(); // Plucks 'name' and 'id' from the 'users' table
                            }),


                        Select::make('reviewer_id')
                            ->label('Reviewer')
                            ->searchable()
                            ->relationship('reviewer', 'name') // Assuming 'reviewer' relationship is defined
                            ->afterStateUpdated(
                                function ($state, callable $get) {
                                    if ($state) {
                                        $taskId = $get('id');
                                        $reviewerId = $state;

                                        // Get reviewer
                                        $reviewer = User::find($reviewerId);

                                        if ($reviewer) {
                                            Notification::send($reviewer, new ReviewAssigned($reviewerId, $taskId));
                                        }
                                    }
                                }
                            ),


                        Select::make('seo_engineer')
                            ->relationship('seo', 'name') // Assuming 'seo' relationship is defined
                            ->searchable()
                            ->label('SEO Expert'),

                        DatePicker::make('due_date')
                            ->label('Due Date')
                            ->required(),

                        TextInput::make('doc_link')
                            ->label('Document Link')
                            ->url(),

                        TextInput::make('writer_count')
                            ->label('Writer Count'),

                        TextInput::make('reviewer_count')
                            ->label('Reviewer Count')
                            ->numeric(),

                        RichEditor::make('writer_notes')
                            ->label('Writer Notes')
                            ->nullable(),

                        RichEditor::make('reviewer_notes')
                            ->label('Reviewer Notes'),

                        Toggle::make('seo_approved')
                             ->afterStateUpdated(function($state, callable $get){
                                if($state)
                                {
                                    $taskId = $get('id');
                                    $seoEngineer = $state;

                                    $notificants = User::whereIn('email', [
                                        'earnestmbugua268@gmail.com',
                                        'fb.admin87@protonmail.com',
                                    ])->get();

                                    $task = TaskAllocation::find($taskId);

                                    $message = 'Article' .' ' . $task->main_title . ' '. 'Has been approved for SEO';

                                    // Notify System Admin

                                    Notification::send($notificants, new AdminSystemNotifications($notificants, $message));

                                }
                            })
                            ->label('SEO Approved'),

                        Select::make('taskstatus')
                            ->afterStateUpdated(function ($state, callable $get) {
                                $writerId = $get('writer_id');
                                $taskId = $get('id');
                                $writer = User::find($writerId);
                                if ($state == 'rejected') {

                                    Notification::send($writer, new TaskRejected($taskId, $writerId));
                                } elseif ($state == 'approved') {
                                    Notification::send($writer, new TaskApproved($taskId, $writerId));
                                }
                            })
                            ->options([
                                'approved' => 'approved',
                                'rejected' => 'rejected',
                            ])->label('Task Status'),

                        Select::make('priority')
                            ->label('Priority')
                            ->options([
                                'low' => 'Low',
                                'medium' => 'Medium',
                                'high' => 'High',
                            ])
                            ->required(),

                        Toggle::make('reviewed')
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state) {
                                    $taskId = $get('id');
                                    $writerId = $get('writer_id');
                                    $revierId = $get('reviewer_id');

                                    // You can retrieve the writer model like this
                                    $writer = \App\Models\User::find($writerId);
                                    if ($revierId && $writerId) {
                                        Notification::send($writer, new TaskHasBeenReviewed($taskId, $writerId));
                                    }
                                }
                            })
                            ->label('Reviewed'),

                        Select::make('progress')
                            ->label('Progress')

                            ->options([
                                'pending' => 'Not Started',
                                'in_progress' => 'In Progress',
                                'done' => 'Completed',
                            ]),

                        TextInput::make('blog_link')
                            ->label('Blog Link')
                            ->url()
                            ->nullable(),


                        TextInput::make('perfomance_score')
                            ->label('Performance Score')
                            ->numeric()
                            ->nullable(),

                       FileUpload::make('plagrism_image')
                        ->image()
                        ->directory('plagarism_image')
                        ->previewable(true)          // ✅ show inline preview
                        ->openable()                 // adds “open in new tab” button
                        ->downloadable()             // adds “download” button
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeMode('cover')
                        ->imageResizeTargetWidth(1920)
                        ->imageResizeTargetHeight(1080),

                        Checkbox::make('is_task_submitted')
                         ->afterStateUpdated(function($state, callable $get){
                                if($state)
                                {
                                    $taskId = $get('id');
                                    $user = Auth::user();

                                    $notificants = User::whereIn('email', [
                                        'earnestmbugua268@gmail.com',
                                        'fb.admin87@protonmail.com',
                                    ])->get();

                                    $task = TaskAllocation::find($taskId);

                                    $message = 'Article' . $task->main_title . 'Has been marked submitted by'.' '.$user->name;

                                    // Notify System Admin

                                    Notification::send($notificants, new AdminSystemNotifications($notificants, $message));

                                }
                            })
                        ->label('Submitted')
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('TasksAllocations')
            ->columns([
                ImageColumn::make('plagrism_image')
                ->label('Image')
                ->disk('public')          // or whatever disk you use
                ->visibility('public')    // needed only if the file isn’t public
                ->square()                // or ->circular(), ->rounded()
                ->height(100),
                TextColumn::make('main_keyword')
                    ->label('Main Keyword')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('keyword_difficulty')
                    ->label('Keyword Difficulty')
                    ->sortable(),

                TextColumn::make('secondary_keywords')
                    ->label('Secondary Keywords')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn(string $state): HtmlString => new HtmlString($state))
                    ->limit(400),

                TextColumn::make('main_title')
                    ->label('Main Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->sortable(),

                TextColumn::make('due_date')
                    ->label('Due Date')
                    ->sortable()
                    ->searchable()
                    ->dateTimeTooltip()
                    ->sortable(),

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
                BooleanColumn::make('is_task_submitted')->label('Task Submitted'),
                BooleanColumn::make('reviewed')
                    ->label('Reviewed')
                    ->sortable(),

                TextColumn::make('perfomance_score')
                    ->label('Performance Score')
                    ->sortable()
                    ->numeric(),

            ])
            ->filters([

                //


                  /** ─────────────────────────────
             *  DATE‑BASED
             * ──────────────────────────── */
            Filter::make('due_date_range')
            ->label('Due Date Range')
            ->form([
                DatePicker::make('from')->label('From'),
                DatePicker::make('to')->label('To'),
            ])
            ->query(function ($query, array $data) {
                return $query
                    ->when(
                        $data['from'],
                        fn ($q, $date) => $q->whereDate('due_date', '>=', $date)
                    )
                    ->when(
                        $data['to'],
                        fn ($q, $date) => $q->whereDate('due_date', '<=', $date)
                    );
            }),


            /** ─────────────────────────────
             *  RELATIONSHIP SELECTS
             * ──────────────────────────── */
            SelectFilter::make('writer_id')
                ->label('Writer')
                ->relationship('writer', 'name'),

            SelectFilter::make('reviewer_id')
                ->label('Reviewer')
                ->relationship('reviewer', 'name'),

            /** ─────────────────────────────
             *  ENUM / TEXT COLUMN
             * ──────────────────────────── */
            SelectFilter::make('priority')
                ->options([
                    'low'    => 'Low',
                    'medium' => 'Medium',
                    'high'   => 'High',
                ]),

            /** ─────────────────────────────
             *  BOOLEAN COLUMNS (Yes / No / Any)
             * ──────────────────────────── */
            TernaryFilter::make('seo_approved')
                ->label('SEO Approved'),

            TernaryFilter::make('is_task_submitted')
                ->label('Task Submitted'),

            TernaryFilter::make('reviewed')
                ->label('Reviewed'),

            /** ─────────────────────────────
             *  NUMERIC RANGE – keyword_difficulty
             * ──────────────────────────── */
            Filter::make('keyword_difficulty')
                ->form([
                    Forms\Components\TextInput::make('min')->numeric()->label('Min'),
                    Forms\Components\TextInput::make('max')->numeric()->label('Max'),
                ])
                ->query(fn (Builder $query, array $data): Builder =>
                    $query
                        ->when(filled($data['min']), fn ($q)     => $q->where('keyword_difficulty', '>=', $data['min']))
                        ->when(filled($data['max']), fn ($q)     => $q->where('keyword_difficulty', '<=', $data['max']))
                ),

            /** ─────────────────────────────
             *  NUMERIC RANGE – performance_score
             * ──────────────────────────── */
            Filter::make('perfomance_score')
                ->label('Performance Score')
                ->form([
                    Forms\Components\TextInput::make('min')->numeric()->label('Min'),
                    Forms\Components\TextInput::make('max')->numeric()->label('Max'),
                ])
                ->query(fn (Builder $query, array $data): Builder =>
                    $query
                        ->when(filled($data['min']), fn ($q)     => $q->where('perfomance_score', '>=', $data['min']))
                        ->when(filled($data['max']), fn ($q)     => $q->where('perfomance_score', '<=', $data['max']))
                ),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])


            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('analyse')
                    ->label('View Analysis')
                    ->color('info')
                    ->icon('heroicon-o-chart-bar')
                    ->requiresConfirmation()
                    ->url(fn($record) => route('filament.admin.pages.seo-analysis', ['taskId' => $record->id])),
                Action::make('preview')
                    ->label('Preview')
                    ->color('success')
                    ->icon('heroicon-o-document-check')
                    ->url( fn($record)=> route('filament.admin.pages.blog-preview', ['taskId' => $record->id]))


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->badge(fn() => $this->getRelationship()->count()),

            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn($query) => $query->where('progress', 'pending'))
                ->badge(fn() => $this->getRelationship()->where('progress', 'pending')->count())
                ->badgeColor('warning'),

            'in_progress' => Tab::make('In Progress')
                ->modifyQueryUsing(fn($query) => $query->where('progress', 'in_progress'))
                ->badge(fn() => $this->getRelationship()->where('progress', 'in_progress')->count())
                ->badgeColor('info'),

            'done' => Tab::make('Completed')
                ->modifyQueryUsing(fn($query) => $query->where('progress', 'done'))
                ->badge(fn() => $this->getRelationship()->where('progress', 'done')->count())
                ->badgeColor('success'),

            'seo_approved' => Tab::make('SEO Approved')
                ->modifyQueryUsing(fn($query) => $query->where('seo_approved', true))
                ->badge(fn() => $this->getRelationship()->where('seo_approved', true)->count())
                ->badgeColor('success'),
            'is_task_submitted' => Tab::make('Submitted')->modifyQueryUsing(fn($query) => $query->where('is_task_submitted', true))
            ->badge(fn() => $this->getRelationship()->where('is_task_submitted', true)->count())
            ->badgeColor('success'),

        ];
    }
}
