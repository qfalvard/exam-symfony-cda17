<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        for ($k = 0; $k < 5; $k++) {
            $post = new Post();
            $post->setTitle('title' . $k);
            $post->setContent('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores error ipsa laudantium maiores, quasi recusandae totam. Magni natus nihil nisi quam, quas ratione rem, totam unde velit vero voluptate voluptatum.');
            $post->setUpdatedAt(new \DateTime());
            $post->setCreatedAt(new \DateTime());
            $post->setPublished(true);
            for ($i = 0; $i < 3; $i++) {
                $tag = new Tag();
                $tag->setName('tag' . $i);
                $post->addTag($tag);
                $manager->persist($tag);
            }

            for ($j = 0; $j < 2; $j++) {
                $comment = new Comment();
                $comment->setTitle('comment' . $j);
                $comment->setContent("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores error ipsa laudantium maiores, quasi recusandae totam.");
                $comment->setCreatedAt(new \DateTime());
                $comment->setPost($post);
                $manager->persist($comment);
            }
            $manager->persist($post);
        }
        $manager->flush();
    }
}
