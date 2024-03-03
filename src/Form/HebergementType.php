<?php

namespace App\Form;

use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Entity\CategorieH;

class HebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomH', TextType::class, [
                'label' => 'Name', 
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Image', 
                'required' => false,
                'constraints' => [
                    new Url([
                        'message' => 'Please enter a valid URL.', 
                    ]),
                ],
            ])
            ->add('nbrEtoile', TextType::class, [
                'label' => 'Star Rating', 
            ])
            ->add('capacite', TextType::class, [
                'label' => 'Capacity', 
            ])
            ->add('tarifParNuit', TextType::class, [
                'label' => 'Nightly Rate', 
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                'label' => 'User', 
            ])
            ->add('categorieH', EntityType::class,[
                'class' => CategorieH::class,
                'choice_label' => 'type',
                'label' => 'Category', 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hebergement::class,
        ]);
    }
}
