<?php

namespace App\Controller\Blog;

use App\Entity\Blog\Comment;
use App\Entity\Blog\Post;
use App\Form\Blog\CommentType;
use App\Form\Blog\PostType;
use App\Repository\Blog\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 2;

        $posts = $this->entityManager->getRepository(Post::class)->findPaginated($page, $limit);


        return $this->render('Blog/Post/index.html.twig', [
            'posts' => $posts,
            'page' => $page,
            'limit' => $limit
        ]);
    }

    #[Route('post/add', name: 'post_add')]
    public function add(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setDefaultDate();
            $this->entityManager->persist($post);
            $this->entityManager->flush();

            $this->addFlash('success', 'Your message here');
            return $this->redirectToRoute('home');
        }

        return $this->render('Blog/Post/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('post/{id}', name: 'post_show')]
    public function show(Request $request, PostRepository $postRepository): Response
    {
        $post = $postRepository->find($request->get('id'));

        $comment = new Comment();
        $comment->setPost($post);

        $commentForm = $this->createForm(CommentType::class, $comment);

        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setDefaultDate();
            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('Blog/Post/show.html.twig', [
            'post' => $post,
            'form' => $commentForm->createView()
        ]);
    }
}