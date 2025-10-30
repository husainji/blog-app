<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post->load('author');
    }

    public function broadcastOn()
    {
        return ['public-events'];
    }

    public function broadcastAs()
    {
        return 'post.created';
    }
}
