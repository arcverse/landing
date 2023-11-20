<?php

namespace App\Controller;

use App\Repository\BlogCategoryRepository;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(BlogPostRepository $blogPostRepository): Response
    {
        $blogPosts = $blogPostRepository->findAll();
        if(empty($blogPosts)) {
            return $this->redirectToRoute('app_homepage');
        }
        usort($blogPosts, function ($a, $b) {
            return $b->getCreatedAt() <=> $a->getCreatedAt();
        });
        return $this->render('blog/index.html.twig', [
            'blogPosts' => $blogPosts
        ]);
    }

    #[Route('/blog/{category}/{slug}', name: 'app_blog_read')]
    public function read(string $category, string $slug, BlogPostRepository $blogPostRepository, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $category = $blogCategoryRepository->findOneBy(['slug' => $category]);
        $blogPost = $blogPostRepository->findOneBy(['slug' => $slug, 'category' => $category->getId()]);
        return $this->render('blog/read.html.twig', [
            'post' => $blogPost
        ]);
    }
}
