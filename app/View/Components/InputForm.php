<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputForm extends Component
{
    public string $name, $label, $type, $accept, $placeholder;
    public ?string $value;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        $label,
        $type = 'text',
        $placeholder = '',
        ?string $value = null,
        $accept = '',
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value ?? old($name);
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-form');
    }
}
