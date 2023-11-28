<?php

namespace App\Controller\Admin;

use App\Entity\ShopMinecraftServer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShopMinecraftServerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopMinecraftServer::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnDetail();
        yield TextField::new('name');
        yield TextField::new('secret')
            ->setDisabled()
            ->setHelp("Use the command '/shop secret [secret]' ingame to connect your server")
            ->onlyOnDetail();
        yield AssociationField::new('items')
            ->autocomplete();
        yield DateTimeField::new('updatedAt');
        yield DateTimeField::new('createdAt');
    }
}
