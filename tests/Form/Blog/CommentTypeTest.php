<?php

namespace App\Tests\Form\Blog;

use App\Entity\Blog\Comment;
use App\Form\Blog\CommentType;
use Symfony\Component\Form\Test\TypeTestCase;

class CommentTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'content' => 'test',
            'author' => 'test'
        ];

        $model = new Comment();
        $form = $this->factory->create(CommentType::class, $model);

        $expected = new Comment();
        $expected->setContent('test');
        $expected->setAuthor('test');

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);
    }
}