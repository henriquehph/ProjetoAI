<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    public $text;
    public $type;

    public function __construct($text, $type)
    {
        $this->text = $text;
        $this->type = $type;
    }

    public function render()
    {
        return view('components.submit-button');
    }
}