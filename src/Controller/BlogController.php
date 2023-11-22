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
    public function index(BlogPostRepository $blogPostRepository, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $blogPosts = $blogPostRepository->findAll();
        if(empty($blogPosts)) {
            return $this->redirectToRoute('app_homepage');
        }
        usort($blogPosts, function ($a, $b) {
            return $b->getCreatedAt() <=> $a->getCreatedAt();
        });
        $blogCategories = $blogCategoryRepository->findAll();
        return $this->render('blog/index.html.twig', [
            'blogPosts' => $blogPosts,
            'blogCategories' => $blogCategories,
            'selectedCategory' => -1
        ]);
    }

    #[Route('/blog/{category}', name: 'app_blog_category')]
    public function category(string $category, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $category = $blogCategoryRepository->findOneBy(['slug' => $category]);
        $blogCategories = $blogCategoryRepository->findAll();
        return $this->render('blog/index.html.twig', [
            'blogPosts' => $category->getBlogPosts(),
            'blogCategories' => $blogCategories,
            'selectedCategory' => $category->getId()
        ]);
    }

    #[Route('/blog/{category}/{post}', name: 'app_blog_read')]
    public function read(string $category, string $post, BlogPostRepository $blogPostRepository, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $category = $blogCategoryRepository->findOneBy(['slug' => $category]);
        $blogPost = $blogPostRepository->findOneBy(['slug' => $post, 'category' => $category->getId()]);
        return $this->render('blog/read.html.twig', [
            'post' => $blogPost
        ]);
    }
}
