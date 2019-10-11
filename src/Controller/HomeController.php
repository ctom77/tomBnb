<?php
namespace App\Controller;
use App\Controller\HomeController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    /**
     * @Route("/", name="homepage")
     */
    public function showHomePage(){
    return $this->render('home.html.twig');
    }

}