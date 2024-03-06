<?php

namespace App\Form;

use App\Entity\Vol;
use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



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
            ->add('escale')
            ->add('image', TextType::class, [
                'label' => 'Image',
                'required' => false,
                'constraints' => [
                    new Url([
                        'message' => 'Veuillez entrer une URL valide.',

                    ]),
                ],
            ])
            ->add('classe', ChoiceType::class, [
                'choices' => [
                    'Business Class' => 'Business Class',
                    'Economic Class' => 'Economic Class',
                    'First Class' => 'First Class',
                ],
                'placeholder' => 'Choisir une classe',
                'required' => true,
            ])
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
