<?php

namespace App\Controller\Admin;

use App\Entity\RoomsChamonix;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RoomsChamonixCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomsChamonix::class;
    }

    public function configureFields(string $pageName): iterable
    {
    return [
        TextField::new('name'),
        ImageField::new('image')
            ->setBasePath('assets/')
            ->setUploadDir('public/assets')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
        TextareaField::new('description'),
        MoneyField::new('price')->setCurrency('EUR'),
    ];
    }
}
