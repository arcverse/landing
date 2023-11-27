<?php

namespace App\Controller\Admin;

use App\Entity\ShopOrder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShopOrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopOrder::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add('email')
            ->add('minecraftName')
            ->add('ref');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnDetail();
        yield TextField::new('orderId')
            ->setDisabled()
            ->hideOnForm();
        yield EmailField::new('email');
        yield CountryField::new('country')
            ->hideOnIndex()
            ->showName(false);
        yield TextField::new('ref')
            ->hideOnIndex();
        yield TextField::new('aff')
            ->hideOnIndex();
        yield TextField::new('minecraftName');
        yield TextField::new('giftToMinecraftName');
        yield AssociationField::new('soldItems')
            ->hideOnIndex()
            ->setDisabled()
            ->autocomplete();
        yield MoneyField::new('gross')
            ->setCurrency('EUR')
            ->setStoredAsCents();
        yield MoneyField::new('net')
            ->setCurrency('EUR')
            ->setDisabled()
            ->setStoredAsCents()
            ->hideOnForm();
        yield AssociationField::new('payments')
            ->hideOnIndex()
            ->autocomplete();
        yield AssociationField::new('pendingMinecraftActions')
            ->hideOnIndex()
            ->autocomplete();
        yield TextEditorField::new('note')
            ->hideOnIndex();
        yield DateTimeField::new('updatedAt');
        yield DateTimeField::new('createdAt');
    }
}
