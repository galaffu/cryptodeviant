<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use App\Controller\Admin\UserCrudController;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
         AdminUrlGenerator $adminUrlGenerator
    ){    
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
       
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cryptodeviant.com');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);


        yield MenuItem::section('Articles');
        yield MenuItem::linkToCrud('Articles', 'fas fa-fill-drip', Post::class);


        // yield MenuItem::section('Back To The Books');
        // yield MenuItem::linkToCrud('Back To The Books', 'fas fa-book', BackToTheBooks::class);

        // yield MenuItem::section('Blog');
        // yield MenuItem::linkToCrud('News', 'fas fa-blog', News::class);

        // yield MenuItem::section('Année');
        // yield MenuItem::linkToCrud('Année', 'fas fa-calendar', Year::class);
    }

}
