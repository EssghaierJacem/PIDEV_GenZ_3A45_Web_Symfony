<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut pas être vide']),
                    new Length(['min' => 3, 'minMessage' => 'Minimum 3 caractères']),
                ],
            ])
            ->add('dateDebut', DateType::class, [
                'label' => 'Date Début',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut pas être vide']),
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date doit être supérieure ou égale à aujourd\'hui.',
                    ]),
                ],
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Date Fin',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut pas être vide']),
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date doit être supérieure ou égale à aujourd\'hui.',
                    ]),
                ],
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut pas être vide']),
                    new Length(['min' => 4, 'minMessage' => 'Minimum 4 caractères']),
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut pas être vide']),
                    new Length(['min' => 4, 'minMessage' => 'Minimum 4 caractères']),
                ],
            ])
            ->add('organisateur', TextType::class, [
                'label' => 'Organisateur',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut pas être vide']),
                    new Length(['min' => 4, 'minMessage' => 'Minimum 4 caractères']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
