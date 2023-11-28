<?php

namespace App\Controller\Admin;

use App\Controller\Shop\ShopActionStatus;
use App\Entity\ShopPendingMinecraftAction;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ShopPendingMinecraftActionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopPendingMinecraftAction::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnDetail();
        yield ChoiceField::new('status')
            ->setChoices(ShopActionStatus::choices());
        yield AssociationField::new('orderRef')
            ->autocomplete();
        yield AssociationField::new('minecraftAction')
            ->autocomplete();
        yield DateTimeField::new('executedAt');
        yield DateTimeField::new('createdAt');
    }
}
