<?php

namespace App\Controller\Admin;

use App\Entity\Tattoo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TattooCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tattoo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TimeField::new('realisationTime', 'Temps'),
            MoneyField::new('price', 'prix')->setCurrency('EUR'),
            DateTimeField::new('made_on', 'réalisé le '),
            TextareaField::new('posterFile')->setFormType(VichFileType::class),
        ];
    }
}
