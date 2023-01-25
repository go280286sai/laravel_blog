<?php

namespace Tests\Feature;

use Database\Factories\CommentFactory;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function test_comments()
    {
        $comment = CommentFactory::new()->make();
        $this->assertEquals(0, $comment->status);
        $comment->toggleStatus();
        $this->assertEquals(1, $comment->status);
        $comment->toggleStatus();
        $this->assertEquals(0, $comment->status);
    }
}
