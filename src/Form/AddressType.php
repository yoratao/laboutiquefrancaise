<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Quel nom voulez donner a votre adresse ?',
                'attr'=>[
                    'placeholder'=>'Nomez votre adresse'
                ]
            ])
            ->add('firstname',TextType::class,[
                'label'=>'Votre nom',
                'attr'=>[
                    'placeholder'=>'saisir votre nom'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=>'Votre prenom',
                'attr'=>[
                    'placeholder'=>'Saisir votre prenom'
                ]
            ])
            ->add('compagny',TextType::class,[
                'label'=>'Quel nom voulez donner a votre compagnie ?',
                'required'=> false,
                'attr'=>[
                    'placeholder'=>'Nomez votre compagnie'
                ]
            ])
            ->add('address',TextType::class,[
                'label'=>'Quel est votre adresse ?',
                'attr'=>[
                    'placeholder'=>'saisir votre adresse'
                ]
            ])
            ->add('postal',TextType::class,[
                'label'=>'code postal ',
                'attr'=>[
                    'placeholder'=>'saisir votre code postal'
                ]
            ])
            ->add('city',TextType::class,[
                'label'=>'ville',
                'attr'=>[
                    'placeholder'=>'saisir votre ville'
                ]
            ])
            ->add('country',CountryType::class,[
                'label'=>'Quel est le nom de votre pays ?',
                'attr'=>[
                    'placeholder'=>'saisir votre pays'
                ]
            ])
            ->add('phone',TelType::class,[
                'label'=>'Quel est votre numeros de telephone ?',
                'attr'=>[
                    'placeholder'=>'saisir votre numeros de telephone'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label'=>"Valider",
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
