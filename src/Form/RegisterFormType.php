<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname' , TextType::class,
            [
                'label' => 'Nom de famille'
            ])

            ->add('lastname' , TextType::class,
            [
                'label' => 'Prénom'
            ])

            ->add('email', EmailType::class, 
            [
                'label' => 'Entrez votre adresse E-mail.'
            ])

            ->add('password', PasswordType::class,
            [
                'label' => 'Veuillez saisir votre mot de passe.'
            ])

            ->add('submit', SubmitType::class, 
            [
                'label' => "S'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class
        ]);
    }
}
