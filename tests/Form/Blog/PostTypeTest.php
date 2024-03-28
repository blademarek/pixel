<?php

namespace App\Tests\Form\Blog;

use App\Entity\Blog\Post;
use App\Form\Blog\PostType;
use Symfony\Component\Form\Test\TypeTestCase;

class PostTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'title' => 'test',
            'description' => 'test',
            'author' => 'test'
        ];

        $model = new Post();
        $form = $this->factory->create(PostType::class, $model);

        $expected = new Post();
        $expected->setTitle('test');
        $expected->setDescription('test');
        $expected->setAuthor('test');

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);
    }
}