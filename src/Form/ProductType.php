<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', CategoryType::class, ['label' => ' '])
            ->add('name', TextType::class, [
                'label'     =>  'Nom',
                'attr' => ['placeholder' => 'Entrez le nom du produit']
            ])
            ->add('brand', TextType::class, [
                'label'     =>  'Marque',
                'attr' => [
                    'placeholder' => 'Entrez la marque du produit',
                    'class'   => 'ProductBrand'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label'     =>  'Description',
                'attr' => ['placeholder' => 'Entrez la description du produit']
            ])
            ->add('properties', CollectionType::class, array(
                'entry_type'    => ProductPropertyType::class,
                'entry_options' => ['label' => false],
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false,
                'prototype'     => true,
                'required'      => false,
                'label'         => ' '
            ))
            ->add('stock', IntegerType::class, [
                'label'     =>  'Quantité',
                'attr' => ['placeholder' => 'Entrez la quantité en stock']
            ])
            ->add('price', MoneyType::class, [
                'label'     =>  'Prix',
                'attr' => ['placeholder' => 'Entrez le prix TTC']
            ])
            ->add('discountPrice', MoneyType::class, [
                'label'     =>  'Promotion',
                'required'  => false,
                'attr' => ['placeholder' => 'Entrez le prix TTC de la promo']
            ])
            ->add('reference', TextType::class, [
                'label'     =>  'Reference',
                'attr' => ['placeholder' => 'Entrez la référence du produit']
            ])
        ;
        /*$builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($options){
                $form = $event->getForm();
                $check = $form->get('newBrand')->getViewData();
                dump($check);
                /*if ($check == null) {
                    $form->remove('brand');
                } else {
                    $form->add('brand', EntityType::class, [
                        "class"         => "App:Brand",
                        'label'     =>  'Marque',
                        'attr' => ['placeholder' => 'Entrez la marque du produit'],
                        "required"      => false,
                    ]);
                }
            }
        );
*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }
}
