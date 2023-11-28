<?php

namespace App\Controller\Admin;

use App\Entity\ShopItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ShopItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopItem::class;
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
        yield SlugField::new('slug')->setTargetFieldName('name');
        yield AssociationField::new('category')
            ->autocomplete();
        yield ColorField::new('color');
        yield ImageField::new('image')
            ->setUploadDir('public/uploads/shop/images')
            ->setBasePath('uploads/shop/images')
            ->setUploadedFileNamePattern('[uuid].[extension]')
            ->hideOnIndex();
        yield TextEditorField::new('description')
            ->hideOnIndex();
        yield MoneyField::new('price')
            ->setCurrency('EUR')
            ->setNumDecimals(2)
            ->setStoredAsCents();
        yield TimeField::new('removeAfter')
            ->hideOnIndex();
        yield IntegerField::new('globalLimit')
            ->hideOnIndex();
        yield BooleanField::new('onePerUser')
            ->hideOnIndex()
            ->renderAsSwitch();
        yield AssociationField::new('requiredItems')
            ->hideOnIndex()
            ->autocomplete();
        yield BooleanField::new('requireOnlyOne')
            ->hideOnIndex()
            ->renderAsSwitch();
        yield BooleanField::new('allowQuantity')
            ->hideOnIndex()
            ->renderAsSwitch();
        yield DateTimeField::new('publishFrom')
            ->hideOnIndex();
        yield DateTimeField::new('publishTill')
            ->hideOnIndex();
        yield BooleanField::new('hideOnLogout')
            ->hideOnIndex()
            ->renderAsSwitch();
        yield AssociationField::new('minecraftServers')
            ->autocomplete();
        yield AssociationField::new('minecraftActions')
            ->autocomplete();
        yield DateTimeField::new('updatedAt');
        yield DateTimeField::new('createdAt');
    }
}
