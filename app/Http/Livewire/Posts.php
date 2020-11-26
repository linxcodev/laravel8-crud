<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $title, $description, $postId;
    public $isOpen = 0;

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.posts');
    }

    public function showModal()
    {
      $this->isOpen = true;
    }

    public function hideModal()
    {
      $this->isOpen = false;
    }

    public function store()
    {
      $this->validate([
        'title' => 'required',
        'description' => 'required'
      ]);

      Post::updateOrCreate([
        'id' => $this->postId
      ], [
        'title' => $this->title,
        'description' => $this->description
      ]);

      $this->hideModal();

      session()->flash('info', $this->postId ? "Berhasil Edit Data" : "Berhasil Menambah Data");

      $this->postId = '';
      $this->title = '';
      $this->description = '';
    }

    public function edit($id)
    {
      $post = Post::findOrFail($id);
      $this->postId = $id;
      $this->title = $post->title;
      $this->description = $post->description;

      $this->showModal();
    }

    public function delete($id)
    {
      Post::findOrFail($id)->delete();
    }
}
