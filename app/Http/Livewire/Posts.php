<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public $search;
    public $isOpen = 0;
    public $title, $description, $postId;

    public function render()
    {
        $searchParams = '%'.$this->search.'%';
        
        return view('livewire.posts', [
            'posts' => Post::where('title', 'like', $searchParams)->latest()->paginate(5),
        ]);
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
      session()->flash('delete', "Berhasil Menghapus Data");
    }
}
