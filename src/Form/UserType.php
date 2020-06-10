<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'     =>  'Email',
                'attr' => ['placeholder' => 'Entrez votre adresse email']
            ])
            ->add('firstname', TextType::class, [
                'label'     =>  'Prénom',
                'attr' => ['placeholder' => 'Entrez votre prénom']
            ])
            ->add('lastname', TextType::class, [
                'label'     =>  'Nom',
                'attr' => ['placeholder' => 'Entrez votre nom']
            ])
            ->add('birthdate', BirthdayType::class, [
                'label'     =>  'Date de naissance',
                'attr' => ['placeholder' => 'Entrez votre date de naissance']
            ])
            ->add('password', PasswordType::class, [
                'label'     =>  'Mot de passe',
                'attr' => ['placeholder' => 'Entrez votre mot de passe']
            ])
            ->add('repeatPassword', PasswordType::class, [
                'label'     =>  'Confirmation mot de passe',
                'attr' => ['placeholder' => 'Repetez le mot de passe']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
