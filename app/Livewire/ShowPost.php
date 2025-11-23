<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{    
    public $postId ;
    public $post ;
    public function mount($postId)
    {
        $this->postId = $postId;
        $this->post = Post::find($postId);  // هي أهم خطوة

    }
    public $showDiv = false; // 🟢 هذا يتحكم بالظهور

    public function show($postId)
    {
        
        $this->showDiv = true; 
    }

    public function hideDiv()
    {
        $this->showDiv = false; // لإخفاء الديف إذا حبيت زر الإغلاق
    }

    public function render()
    {
        return view('livewire.show-post');
    }
}
