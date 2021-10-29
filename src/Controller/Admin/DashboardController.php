<?php

namespace App\Controller\Admin;

use App\Entity\Carrier;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use http\Client\Curl\User;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La Boutique Francaise');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', \App\Entity\User::class);
        yield MenuItem::linkToCrud('Categories','fa fa-list',Category::class);
        yield MenuItem::linkToCrud('Produits','fa fa-tag',Product::class);
        yield MenuItem::linkToCrud('Carriers','fa fa-truck',Carrier::class);

    }
}
