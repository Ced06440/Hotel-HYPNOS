<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom de l\'hotel'),
            TextField::new('adress', 'Adresse'),
            TextField::new('city', 'Ville'),
            IntegerField::new('zipcode', 'Code postal'),
            IntegerField::new('phoneNumber'),
            TextareaField::new('description', 'Description'),
            ImageField::new('photoBandeau')
                ->setBasePath('assets/')
                ->setUploadDir('public/assets')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}
