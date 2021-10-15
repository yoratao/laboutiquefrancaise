<?php
namespace App\Form;

use App\Classe\search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class searchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string',TextType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Votre recherche...'
                ]
            ])
                    ->add('categories',EntityType::class,[
                        'label'=>false,
                        'required'=>false,
                        'class'=>Category::class,
                        'multiple'=>true,
                        'expanded'=>true
                    ])
            ->add('submit',SubmitType::class,[
                'label'=>'Filtrer',
                'attr'=>[
                    'class'=> 'btn-block btn-info'
            ]
        ])
        ;


    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => search::class,
            'method'=>'GET',
            'crsf_protection'=>false,

        ]);
    }
        public function getBlockPrefix()
        {
            return '';
        }


}