<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
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
                'label' => 'Entrez votre adresse E-mail'
            ])
            ->add('phoneNumber', TelType::class,
            [
                'label' => 'Votre numéros de téléphone'
            ])

            ->add('selection', ChoiceType::class,
            [
                'choices' => [
                    'Je souhaite poser une réclamation.' => 'Je souhaite poser une réclamation.',
                    'Je souhaite commander un service supplémentaire.' => 'Je souhaite commander un service supplémentaire.',
                    'Je souhaite en savoir plus sur une suite.' => 'Je souhaite en savoir plus sur une suite.',
                    'j\'ai un soucis avec cette application.' => 'j\'ai un soucis avec cette application.'
                ],
            ])

            ->add('message', TextareaType::class, 
            [
                'label' => 'Laissez-nous votre message'
            ])

            ->add('submit', SubmitType::class, 
        [
            'label' => "Laissez votre message"
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
