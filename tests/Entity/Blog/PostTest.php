<?php

namespace App\Tests\Entity\Blog;

use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testSetTitle()
    {
        $post = new Post();
        $post->setTitle('Test Title');

        $this->assertEquals('Test Title', $post->getTitle());
    }

    public function testSetDescription()
    {
        $post = new Post();
        $post->setDescription('Test Description');

        $this->assertEquals('Test Description', $post->getDescription());
    }

    public function testSetAuthor()
    {
        $post = new Post();
        $post->setAuthor('Test Author');

        $this->assertEquals('Test Author', $post->getAuthor());
    }

    public function testSetDate()
    {
        $date = new \DateTime();
        $post = new Post();
        $post->setDate($date);

        $this->assertEquals($date, $post->getDate());
    }

    public function testSetDefaultDate()
    {
        $post = new Post();
        $post->setDefaultDate();
        $this->assertInstanceOf(\DateTimeImmutable::class, $post->getDate());
    }

    public function testAddComments()
    {
        $post = new Post();

        $comment1 = new Comment();
        $comment1->setContent('Comment 1');

        $comment2 = new Comment();
        $comment2->setContent('Comment 2');

        $post->addComment($comment1);
        $post->addComment($comment2);

        $comments = $post->getComments();

        $this->assertCount(2, $comments);
        $this->assertContains($comment1, $comments);
        $this->assertContains($comment2, $comments);
    }
}