<?php

namespace App\Form;

use App\Entity\RoomsParis;
use App\Entity\BookingParis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookingParisType extends AbstractType
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
            'class' => RoomsParis::class,
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
            'data_class' => BookingParis::class,
        ]);
    }
}
