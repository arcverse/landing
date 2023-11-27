<?php

namespace App\Controller\Admin;

use App\Controller\Shop\ShopPaymentProvider;
use App\Controller\Shop\ShopPaymentStatus;
use App\Entity\ShopPayment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShopPaymentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopPayment::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnDetail();
        yield ChoiceField::new('provider')
            ->setChoices(ShopPaymentProvider::choices())
            ->renderAsBadges();
        yield TextField::new('paymentId');
        yield MoneyField::new('amount')
            ->setCurrency('EUR')
            ->setStoredAsCents();
        yield AssociationField::new('orderRef')
            ->autocomplete();
        yield ChoiceField::new('status')
            ->renderAsBadges()
            ->setChoices(ShopPaymentStatus::choices());
        yield DateTimeField::new('paidAt');
        yield DateTimeField::new('updatedAt');
        yield DateTimeField::new('createdAt');
    }
}
