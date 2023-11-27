<?php

namespace App\Controller\Admin;

use App\Entity\ShopCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShopCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopCategory::class;
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
        yield AssociationField::new('items')
            ->autocomplete();
        yield AssociationField::new('parent')
            ->autocomplete();
        yield BooleanField::new('cumulative')
            ->setLabel('Cumulate this category')
            ->renderAsSwitch()
            ->hideOnIndex()
            ->setHelp('Cumulate the purchases inside of this category so customers only pay the difference when purchasing a higher priced item.');
        yield BooleanField::new('cumulativeDisableLower')
            ->renderAsSwitch()
            ->hideOnIndex()
            ->setLabel('Disable lower priced items')
            ->setHelp('Disable cumulative packages that have a lower price than the current purchased package.');
        yield ColorField::new('color');
        yield TextEditorField::new('description')
            ->hideOnIndex();
        yield TextEditorField::new('overview')
            ->hideOnIndex();
        yield BooleanField::new('grid')
            ->renderAsSwitch()
            ->hideOnIndex()
            ->setLabel('Display items as grid');
        yield BooleanField::new('orderByPrice')
            ->renderAsSwitch()
            ->hideOnIndex()
            ->setHelp('Order items by price instead of by name');
        yield BooleanField::new('showInDropdown')
            ->renderAsSwitch()
            ->hideOnIndex()
            ->setHelp('Show this category in the dropdown menu of its parent category');
        yield DateTimeField::new('updatedAt');
        yield DateTimeField::new('createdAt');
    }

}
