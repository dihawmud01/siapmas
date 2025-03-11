<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputSelect extends Component
{
    public string $name, $label;
    public array $options;
    public ?string $selected;
    /**
     * Create a new component instance.
     */
    public function __construct(string $name, $label, array $options = [], ?string $selected = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selected = $selected ?? old($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-select');
    }
}
