<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Services\DiceThrower;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     * @param PostRepository $postRepository
     * @param DiceThrower $diceThrower
     * @return Response
     */
    public function index(PostRepository $postRepository, DiceThrower $diceThrower): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/blog/new", name="blog_new", methods={"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post, [
            'method' => 'POST',
            'action' => $this->generateUrl('blog_new'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setCreatedAt(new \DateTime());
            $post->setUpdatedAt(new \DateTime());
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_post")
     * @param int $id
     * @return Response
     */
    public function post(int $id) {
        return $this->render('blog/post.html.twig', [
            'id' => $id
        ]);
    }
}
