<?php

namespace App\Livewire\Pages\User\Partials;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\LeeMarketingPartners;
use App\Models\Task\LeeMarketingSOP;

class SOPPage extends Component
{
    // Inherit Layout

    #[Layout('components.layouts.main')]


    public $id;
    public $data;

    public function mount($id)
    {

        $this->id = $id;
        $this->data = LeeMarketingSOP::where('task_insurers_id', $this->id)
        ->where('is_active', true)
        ->first();



    }
    public function render()
    {
        return view('livewire.pages.user.partials.s-o-p-page');
    }
}
