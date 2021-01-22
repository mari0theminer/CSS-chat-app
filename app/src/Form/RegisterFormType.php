<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                "label"=>false,
                'attr' => array(
                    'placeholder' => 'Username '
                )
            ])
            ->add('email',EmailType::class,[
                "label"=>false,
                'attr' => array(
                    'placeholder' => 'Email'
                )
            ])
            ->add('password',PasswordType::class,[
                "label"=>false,
                'attr' => array(
                    'placeholder' => 'Password'
                )
            ])
            ->add('submit',SubmitType::class,[
                'label'=>"Register",
                "attr"=>array(
                    "class"=>"signUpButton"
                )

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
