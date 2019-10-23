<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AccountType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, $this->getConfiguration('Prénom', 'Modifiez votre prénom'))
        ->add('lastname', TextType::class, $this->getConfiguration('Nom', 'Modifiez votre nom'))
        ->add('email', EmailType::class, $this->getConfiguration('Email', 'Modifiez votre adresse email'))
        ->add('introduction', TextType::class, $this->getConfiguration('Introduction', 'Modifiez votre introduction'))
        ->add('description', TextType::class, $this->getConfiguration('Description', 'Modifiez votre présentation'))
        ->add('picture', UrlType::class, $this->getConfiguration('Photo de profil', 'Modifiez votre photo de profil'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
