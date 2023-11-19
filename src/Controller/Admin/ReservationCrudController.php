<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Doctrine\ORM\QueryBuilder; // Certifique-se de adicionar esta linha
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('utilisateur'),
            AssociationField::new('seance')
                ->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                    $dataDesejada = new \DateTime('now');

                    return $queryBuilder
                        ->andWhere('entity.dateHeure > :dataDesejada')
                        ->setParameter('dataDesejada', $dataDesejada);
                }),
            ChoiceField::new('nombreDePlaces')
                ->setChoices([
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ]),
            DateField::new('dateReservation')
                ->setFormTypeOptions([
                    'data' => new \DateTime('now'),
                ])
        ];
    }
}
