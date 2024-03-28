<?php

namespace App\Tests\Entity\Blog;

use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function testSetContent()
    {
        $comment = new Comment();
        $comment->setContent('Test Content');
        $this->assertEquals('Test Content', $comment->getContent());
    }

    public function testSetAuthor()
    {
        $comment = new Comment();
        $comment->setAuthor('Test Author');
        $this->assertEquals('Test Author', $comment->getAuthor());
    }

    public function testSetDate()
    {
        $date = new \DateTime();
        $comment = new Comment();
        $comment->setDate($date);
        $this->assertEquals($date, $comment->getDate());
    }

    public function testSetDefaultDate()
    {
        $comment = new Comment();
        $comment->setDefaultDate();
        $this->assertInstanceOf(\DateTimeImmutable::class, $comment->getDate());
    }

    public function testSetPost()
    {
        $post = new Post();
        $comment = new Comment();
        $comment->setPost($post);
        $this->assertEquals($post, $comment->getPost());
    }
}