<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment->load('user', 'post'); // eager load relationships
    }

    /**
     * The channel the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return ['public-events']; // public channel for global notifications
    }

    /**
     * Optional: set the event name for frontend listeners
     */
    public function broadcastAs(): string
    {
        return 'comment.created';
    }
}
