<?php

namespace App\Form;

use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class DestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pays')
            ->add('ville')
            ->add('description')
            ->add('attractions')
            ->add('accomodation')
            ->add('devise')
            ->add('multimedia', TextType::class, [
                'label' => 'Multimedia',
                'required' => false,
                'constraints' => [
                    new Url([
                        'message' => 'Veuillez entrer une URL valide.',

                    ]),
                ],
            ])

            ->add('accessibilite', ChoiceType::class, [
                'label' => 'Accessibilité',
                'placeholder' => 'Choisissez une option',
                'choices' => [
                    'Accessible' => true,
                    'Inaccessible' => false,
                ],
                'expanded' => false,
                'required' => true,
            ])
            ->add('cuisine_locale')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Destination::class,
        ]);
    }
}
