<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputJson extends Component
{
    public string $label, $name;
    public int $count;
    public array $values;
    /**
     * Create a new component instance.
     */
    public function __construct(string $label, $name, int $count = 5, array $values = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->count = $count;
        $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-json');
    }
}
