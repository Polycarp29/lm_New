<div class="mb-10">
    <h2 class="text-xl font-semibold text-gray-700 mb-3">Completed Tasks</h2>
    @include('livewire.pages.user.partials.task-tables', ['tasks' => $tasks, 'type' => 'completed'])
</div>
