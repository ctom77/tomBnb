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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, $this->getConfiguration('Prénom', 'Votre prénom'))
            ->add('lastname', TextType::class, $this->getConfiguration('Nom', 'Votre nom'))
            ->add('email', EmailType::class, $this->getConfiguration('Email', 'Votre email'))
            ->add('hash', PasswordType::class, $this->getConfiguration('Mot de passe', 'Choisissez un mot de passe sécuritaire'))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration('Confirmation de mot de passe', 'Veuillez confirmé la saisie de votre mot de passe'))
            ->add('introduction', TextType::class, $this->getConfiguration('Introduction', 'Présentez vous brièvement'))
            ->add('description', TextType::class, $this->getConfiguration('Description', 'Comment vous décririez vous ?'))
            ->add('picture', UrlType::class, $this->getConfiguration('Photo de profil', 'Votre photo de profil'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
