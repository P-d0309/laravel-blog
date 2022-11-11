<?php

namespace App\Http\Livewire;

use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class Post extends Component
{
    use WithFileUploads;

    public $text, $description,$file_type, $file, $status, $future_date, $post;

    protected $statuses = [
        'publised' => "Publised",
        'unpublised' => "Un Publised",
        'draft' => "Draft",
        'archieve' => "Archieve",
    ];

    public $rules = [
        'text' => 'required',
        'description' => 'required',
        'file' => 'nullable|image',
        'status' => 'required',
    ];

    public function mount() {
        $post = $this->post;

        if($post) {
            $this->text = $post->text;
            $this->description = $post->text;
            $this->status = $post->status;
        }

    }

    public function render()
    {
        return view('livewire.post');
    }

    public function savePost()
    {
        $data = $this->validate();
        $post = $this->post;

        if(!$post) {
            $post = new ModelsPost;
        }
        $post->text = $this->text;
        $post->description = $this->description;
        $post->status = $this->status;
        $post->text = $this->text;
        $post->user_id = auth()->user()->id;
        if($this->file) {
            $extension = $this->file->guessExtension();

            $pathFolder = Str::random(30);
            $pathFolder = "images/posts/$pathFolder";

            File::makeDirectory($pathFolder, 0777, true, false);

            Image::make($this->file)->resize(350, 150)->save("$pathFolder/350x150.$extension");
            Image::make($this->file)->resize(1600,800)->save("$pathFolder/1600x800.$extension");
            $post->thumbnail = "$pathFolder/350x150.$extension";
            $post->file = "$pathFolder/1600x800.$extension";
            $post->file_type = "image";
        }
        $post->save();
        Session::flash('message.level', 'success');
        if($post->wasRecentlyCreated) {
            Session::flash('message.content', 'Post added successfully.');
        } else {
            Session::flash('message.content', 'Post updated successfully.');
        }
        return redirect()->route('post.index');
    }
}
