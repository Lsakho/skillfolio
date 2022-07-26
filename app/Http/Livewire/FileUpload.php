<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\File;
use Livewire\WithFileUploads;
use Validator;
use Illuminate\Http\Request;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file, $title;

    public function render()
    {
        return view('livewire.file-upload');
    }

    public function submit()
    {

        $validatedData = $this->validate([
            'title' => 'required',
            'file' => 'required'
        ]);

        $validator = Validator::make($validatedData, [
            // 'title' => 'required',
            'file' => 'mimes:jpeg,bmp,png,gif,svg,jpg'
        ]);

        if($validator->fails()){
            $validatedData['file'] = $this->file->store('files', 'public');
        File::create($validatedData);

  
        session()->flash('message', 'File successfully Uploaded.');

        }

        else{
            $validatedData['file'] = $this->file->store('images', 'public');
        File::create($validatedData);

  
        session()->flash('message', 'Image successfully Uploaded.');
        }

        

    }
}