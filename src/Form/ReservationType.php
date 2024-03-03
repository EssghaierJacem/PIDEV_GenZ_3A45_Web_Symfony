<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Entity\Commande;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_client')
            ->add('prenom_client')
            ->add('num_tel')
            ->add('quantite')
            ->add('date_reservation')
       
            ->add('user', EntityType::class, [
            'class'=> User::class,
            'choice_label'=> 'username'
            ]
            )
            ->add('commande', EntityType::class, [
                'class'=> Commande::class,
                'choice_label'=> 'num_commande'
                ]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
