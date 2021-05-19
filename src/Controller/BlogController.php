<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_post")
     * @param String $id
     * @return Response
     */
    public function post(String $id) {
        return $this->render('blog/post.html.twig', [
            'id' => $id
        ]);
    }
}
