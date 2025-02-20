<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputMultipleFiles extends Component
{
    public string $label, $name, $accept;
    /**
     * Create a new component instance.
     */
    public function __construct(string $label, $name, $accept)
    {
        $this->label = $label;
        $this->name = $name;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-multiple-files');
    }
}
