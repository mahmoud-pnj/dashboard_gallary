<?php

namespace App\Http\Livewire\Task\Tasks;

use Livewire\Component;

class Option extends Component
{
    public $sub_cat;
    public function render()
    {
        return view('livewire.task.tasks.option');
    }
}
