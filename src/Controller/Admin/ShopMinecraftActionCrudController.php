<?php

namespace App\Controller\Admin;

use App\Controller\Shop\ShopActionTrigger;
use App\Entity\ShopMinecraftAction;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShopMinecraftActionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopMinecraftAction::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('item')
            ->autocomplete();
        yield ChoiceField::new('trigger')
            ->renderAsBadges()
            ->setChoices(ShopActionTrigger::choices());
        yield TextField::new('value')
            ->setLabel('Command')
            ->setHelp('The command to execute when the action is triggered');
        yield AssociationField::new('minecraftServers')
            ->autocomplete();
        yield BooleanField::new('requirePlayerOnline')
            ->renderAsSwitch();
        yield IntegerField::new('requiredInventorySlots');
    }
}
