<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\AdController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        //$repo = $this->getDoctrine()->getRepository(Ad::class);
        $ads = $repo->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * Permet de créer une annnonce
     *@Route("/ads/new", name="ads_create")
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $ad = new Ad();



        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //$manager = $this->getDoctrine()->getManager();
            foreach($ad->getImages() as $image){
                $image->setAd($ad);
                $manager->persist($image);
            }
            $ad->setAuthor($this->getUser());
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' =>$ad->getSlug()
            ]);

            if (!isValid()){

                    $this->addFlash(
                        'danger',
                        "Remplissez correctement touts les champs du formulaire !"
                    );
                
            }
        }

        return $this->render('ad/new.html.twig',
    [
        'form' => $form->createView()
    ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition'
     * @Route("/ads/{slug}/edit", name = "ads_edit")
     * @return void
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager){
        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //$manager = $this->getDoctrine()->getManager();
            foreach($ad->getImages() as $image){
                $image->setAd($ad);
                $manager->persist($image);
            }
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications ont bien été enregistrées !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' =>$ad->getSlug()
            ]);

            if (!isValid()){

                    $this->addFlash(
                        'danger',
                        "Remplissez correctement touts les champs du formulaire !"
                    );
                
            }
        }


        return $this->render('ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad
        ]);

    }

    /**
     * Permet d'afficher une seule annonce
     * @Route("/ads/{slug}", name = "ads_show")
     * 
     */
    public function show(Ad $ad){
        // Je récupère l'annonce qui correspond au slug
        //$ad = $repo->findOneBySlug($slug);

        return $this->render('ad/show.html.twig',
        [
            'ad' => $ad
        ]);


    }

}