<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Reservation;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_commande')
           ->add('prix')
            ->add('code_promo')
            ->add('type_paiement')
            ->add('email')
            
            ->add('date_commande', DateType::class, [
                'label' => 'date_commande',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('reservation', EntityType::class, [
                'class'=> Reservation::class,
                'choice_label'=> 'nom_client'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
