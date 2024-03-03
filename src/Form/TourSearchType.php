<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la tournée',
                'required' => false,
            ])
            
            ->add('dateDebut', DateType::class, [
                'label' => 'dateDebut',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée',
                'required' => false,
            ])
            ->add('tarif', MoneyType::class, [
                'label' => 'Tarif',
                'required' => false,
            ]);
        // Ajoutez d'autres champs de recherche si nécessaire
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configurez les données à envoyer à la vue
            'data_class' => null,
        ]);
    }
}
