<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class AnnonceType extends AbstractType
{

    /**
     * Permet d'avoir la configuration de base d'un champs de mon formulaire
     *
     * @param [string] $label
     * @param [string] $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder, $options = []){

        return array_merge([
            'label' => $label,
                'attr' => [
                    'placeholder' => $placeholder
            ]
        ], $options);
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration('Titre', 'tapez un super titre pour votre annonce !'))
            ->add('slug', TextType::class, $this->getConfiguration('Url', 'Adresse Web (Automatique)', ['required' => false]))
            ->add('coverImage', UrlType::class, $this->getConfiguration("Url de l'image principale", "Donnez l'adresse d'une image qui donne vraiment envie"))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Donnez une description globale de l'annonce"))
            ->add('content', TextareaType::class, $this->getConfiguration("Description détaillée", "Tapez une description détaillée de votre bien"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Indiquez le nombre de chambre que dispose votre locatioon"))
            ->add('price', MoneyType::class, $this->getConfiguration('Prix par nuit', 'Indiquez le prix que vous voulez pour une nuit'))
            ->add ('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer l\'annonce',
                'attr' =>[
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
