<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImagesComponent extends Component
{
    use WithFileUploads;

    public $images = [];

    public function render()
    {
        return view('livewire.upload-images-component');
    }
}
