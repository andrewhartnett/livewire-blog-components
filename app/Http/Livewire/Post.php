<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{

    public $creatingNewBlock = false;
    public $editingNewBlock = false;
    public $blocks = [];

// Example of what the block array could look like
//    public $blocks = [
//        ['type' => 'h1', 'value' => 'Some Heading'],
//        ['type' => 'paragraph', 'value' => 'Some Paragraph'],
//        ['type' => 'quote', 'value' => 'Some Quote'],
//    ];

    public $currentBlock = [];
    public $value = '';
    public $title = '';

    // Use postId to save to a Post model
    public $postId = null;

    public function render()
    {
        return view('livewire.post');
    }

    public function test()
    {
        $this->creatingNewBlock = 'thing';
    }

    public function newBlock()
    {
        $this->currentBlock = [];
        $this->creatingNewBlock = true;
    }

    public function newBlockType($type)
    {
        $this->currentBlock['type'] = $type;
        $this->value = '';
        $this->creatingNewBlock = false;
        $this->editingNewBlock = true;
    }

    public function save()
    {
        $this->currentBlock['value'] = $this->value;
        $this->blocks[] = $this->currentBlock;
        $this->reset();
    }

    public function deleteBlock($i)
    {
        if(count($this->blocks) == 1){
            $this->blocks = [];
        }
        unset($this->blocks[$i - 1]);
    }

    public function moveBlockUp($i)
    {
        $i = $i - 1;
        $item = array_splice($this->blocks, $i, 1);
        array_splice($this->blocks, $i-1, 0, $item);
    }

    public function moveBlockDown($i)
    {
        $i = $i - 1;

        $item = array_splice($this->blocks, $i, 1);
        array_splice($this->blocks, $i+1, 0, $item);
    }

    private function reset()
    {
        $this->currentBlock = [];
        $this->creatingNewBlock = false;
        $this->editingNewBlock = false;
    }

    public function savePost()
    {
        if (empty($this->postId)) {
            $post = new \App\Post;
        }else{
            $post = \App\Post::find($this->postId);
        }

        $post->blocks = json_encode($this->blocks);
        $post->title = $this->title;
        $post->author = Auth::user()->id;
        $post->save();

        $this->redirect('/posts');
    }

    public function mount($id)
    {
        // if $id is null, new Post
        if (!$id) {
            $this->postId = null;
        } else {
            $this->postId = $id;
            $post = \App\Post::find($id);

            $blocks = json_decode($post->blocks, true);

            $this->blocks = $blocks;
            $this->title = $post->title;
        }
    }
}
