<?php

namespace App\Form;

use App\Entity\Vol;
use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compagnieA')
            ->add('num_vol')
            ->add('aeroportDepart')
            ->add('aeroportArrivee')
            ->add('dateDepart')
            ->add('dateArrivee')
            ->add('duree_vol')
            ->add('tarif')
            ->add('destination', EntityType::class, [
                'class' => Destination::class,
                'choice_label' => function (Destination $destination) {
                    return $destination->getPays() . ' - ' . $destination->getVille();
                },
                'placeholder' => 'Choisir une destination',
                'required' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
