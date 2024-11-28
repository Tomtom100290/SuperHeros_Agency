<?php

namespace App\Form;

use App\Entity\SuperHeros;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SuperHerosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('AlterEgo')
            ->add('Disponible')
            ->add('Energie')
            ->add('Biographie')
            ->add('ImageName')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de profil',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SuperHeros::class,
        ]);
    }
}
