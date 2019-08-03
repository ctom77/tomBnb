<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller{

    /**
     * @Route("/hello/{prenom}", name="hello")
     *
     * @return void
     */
    public function hello($prenom = ""){
        return new Response("bonjour " . $prenom);
    }
    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        return $this->render(
            'home.html.twig',
            [
                'title' => "Bonjour à touti",
                'age' => "10"
            ]
        );
    }
}

?>