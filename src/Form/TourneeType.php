<?php

namespace App\Form;

use App\Entity\Tournee;
use App\Entity\Destination;
use App\Entity\Guide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class TourneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            
            ->add('dateDebut', DateType::class, [
                'label' => 'dateDebut',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('duree')
            ->add('description')
            ->add('tarif')
            ->add('monuments')
            ->add('trancheAge')
            ->add('moyenTransport')
            ->add('destination', EntityType::class,[
                'class'=> Destination::class,
                'choice_label' => 'pays',
                'placeholder' => 'Sélectionner une destination'
            ])
            ->add('guide', EntityType::class,[
                'class'=> Guide::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionner une Guide'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournee::class,
        ]);
    }
}
