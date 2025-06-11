<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PhotoUpload extends Component
{
    public $name;
    public $label;
    public $width;
    public $readonly;
    public $deleteTitle;
    public $deleteAllow;
    public $imageUrl;

    public function __construct(
        $name = 'photo_file',
        $label = 'Photo',
        $width = 'md',
        $readonly = false,
        $deleteTitle = 'Delete Photo',
        $deleteAllow = true,
        $imageUrl = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->width = $width;
        $this->readonly = filter_var($readonly, FILTER_VALIDATE_BOOLEAN);
        $this->deleteTitle = $deleteTitle;
        $this->deleteAllow = filter_var($deleteAllow, FILTER_VALIDATE_BOOLEAN);
        $this->imageUrl = $imageUrl;
    }

    public function render()
    {
        return view('components.photo-upload');
    }
}