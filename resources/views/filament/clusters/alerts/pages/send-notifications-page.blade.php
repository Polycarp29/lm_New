<x-filament-panels::page>
    {{ $this->form }}
    <div class="mt-4">
        <x-filament::button wire:click="submit" type="button">
            Send Notification
        </x-filament::button>
    </div>
</x-filament-panels::page>
