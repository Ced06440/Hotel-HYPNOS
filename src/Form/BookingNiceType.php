<?php

namespace App\Form;

use App\Entity\RoomsNice;
use App\Entity\BookingNice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookingNiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('startDate', DateType::class, 
        [
            'label' => 'Arrivée le : ',
            'widget' => 'single_text',
            'attr' => [
                'class' => 'bookingDate'
            ]
        ])
        
        ->add('endDate', DateType::class, 
        [
            'label'=>'Départ le :',
            'widget' => 'single_text',
            'attr' => [
                'class' => 'bookingDate'
            ]
        ])
        
        ->add('rooms', EntityType::class, 
        [
            'expanded' => true,
            'class' => RoomsNice::class,
            'multiple' => false
        ])

        ->add('submit', SubmitType::class, 
        [
            'label' => "Réserver"
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookingNice::class,
        ]);
    }
}
