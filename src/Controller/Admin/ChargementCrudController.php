<?php

namespace App\Controller\Admin;

use App\Entity\Chargement;
use App\Form\Admin\ChargementProduitEmbeddedType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChargementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chargement::class;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')
                ->hideOnForm();
            yield AssociationField::new('client');
            yield AssociationField::new('transporteur');
            yield CollectionField::new('chargementProduits', "Produits")
                // ->useEntryCrudForm(ChargementProduitCrudController::class)
                ->setEntryType(ChargementProduitEmbeddedType::class)
                ->allowAdd(true)
                ->allowDelete(true)
                ->setFormTypeOption('by_reference', false)
                ->hideOnIndex();
            yield DateField::new('createdAt')
                ->setFormat('dd/M/Y') 
                ->onlyOnIndex();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->add(Crud::PAGE_NEW, Action::INDEX)
            ->setPermission(Action::EDIT, 'ROLE_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ->setPermission(Action::NEW, 'ROLE_USER')
            ->setPermission(Action::DETAIL, 'ROLE_USER')
            ;
    }
}
