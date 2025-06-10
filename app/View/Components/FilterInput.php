<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterInput extends Component
{
    public string $name;
    public string $placeholder;
    public ?string $value;  // Allow null

    public function __construct(string $name, string $placeholder = '', ?string $value = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value ?? '';  // fallback to empty string
    }

    public function render()
    {
        return view('components.filter-input');
    }
}

