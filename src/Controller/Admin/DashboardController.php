<?php

namespace App\Controller\Admin;

use App\Entity\BlogCategory;
use App\Entity\BlogPost;
use App\Entity\Job;
use App\Entity\JobApplication;
use App\Entity\ShopCategory;
use App\Entity\ShopItem;
use App\Entity\ShopMinecraftAction;
use App\Entity\ShopMinecraftServer;
use App\Entity\ShopOrder;
use App\Entity\ShopPayment;
use App\Entity\ShopPendingMinecraftAction;
use App\Entity\ShopSoldItem;
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

        yield MenuItem::section('Shop');
        yield MenuItem::linkToCrud('Categories', 'fa fa-compass', ShopCategory::class);
        yield MenuItem::linkToCrud('Items', 'fa fa-cubes', ShopItem::class);
        yield MenuItem::linkToCrud('Minecraft Servers', 'fa fa-server', ShopMinecraftServer::class);
        yield MenuItem::linkToCrud('Minecraft Actions', 'fa fa-terminal', ShopMinecraftAction::class);
        yield MenuItem::linkToCrud('Orders', 'fa fa-shopping-cart', ShopOrder::class);
        yield MenuItem::linkToCrud('Payments', 'fa fa-credit-card', ShopPayment::class);
        yield MenuItem::linkToCrud('Sold Items', 'fa fa-box-open', ShopSoldItem::class);
        yield MenuItem::linkToCrud('Pending Minecraft Actions', 'fa fa-clock', ShopPendingMinecraftAction::class);

        yield MenuItem::section("Quick Links");
        yield MenuItem::linkToUrl('Homepage', 'fas fa-home', $this->generateUrl('app_homepage'));
    }
}
