<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputCheckbox extends Component
{
    public string $id, $name, $label, $xModel;
    public ?string $value;
    public bool $checked;

    /**
     * Create a new component instance.
     */
    public function __construct(string $id, $name, $label, $xModel = '', ?string $value = null, bool $checked = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->xModel = $xModel;
        $this->value = $value ?? old($name);
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-checkbox');
    }
}
