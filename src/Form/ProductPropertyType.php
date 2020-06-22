<?php

namespace App\Form;

use App\Entity\ProductProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductPropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'     =>  'Nom',
                'attr' => [
                    'placeholder' => 'Entrez le nom de la propriété',
                    'class'   => 'ProductPropertyName'
                ]
            ])
            ->add('value', TextType::class, [
                'label'     =>  'Valeur',
                'attr' => [
                    'placeholder' => 'Entrez la valeur de la propriété',
                    'class'   => 'ProductPropertyValue'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductProperty::class,
        ]);
    }
}
