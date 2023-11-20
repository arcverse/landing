<?php

namespace App\Controller\Admin;

use App\Entity\BlogCategory;
use App\Entity\BlogPost;
use App\Entity\Job;
use App\Entity\JobApplication;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->generateRelativeUrls(true)
            ->setTitle('Landing');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);

        yield MenuItem::section('Blog');
        yield MenuItem::linkToCrud('BlogCategories', 'fa fa-tags', BlogCategory::class);
        yield MenuItem::linkToCrud('BlogPosts', 'fa fa-file-text', BlogPost::class);

        yield MenuItem::section('Jobs');
        yield MenuItem::linkToCrud('Jobs', 'fa fa-tags', Job::class);
        yield MenuItem::linkToCrud('JobApplications', 'fa fa-person', JobApplication::class);

        yield MenuItem::section("Quick Links");
        yield MenuItem::linkToUrl('Homepage', 'fas fa-home', $this->generateUrl('app_homepage'));
    }
}
