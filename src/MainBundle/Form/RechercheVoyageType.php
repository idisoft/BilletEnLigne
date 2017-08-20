<?php

namespace MainBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheVoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('compagnie',EntityType::class,array(
                'label'=>'Compagnie',
                'class'=>'MainBundle\Entity\Compagnie',
                'choice_label'=>'nomComp',
                'required'=>false,
                'attr'=>array(
                    'id'=>'select',
                    'name'=>'select'
                )
            ))
            ->add('source',EntityType::class,array(
                'label'=>'Vous Quittez',
                'class'=> 'MainBundle\Entity\Gare',
                'choice_label'=>'nomGare',
                'required'=>false
            ))
            ->add('destination',EntityType::class,array(
                'label'=>'Pour aller à',
                'class'=> 'MainBundle\Entity\Gare',
                'choice_label'=>'nomGare',
                'required'=>false
            ))
            ->add('dateDepart',DateTimeType::class,array(
                'label'=>'Date Depart',
                'required'=>true,
                'widget' => 'single_text',
                'format'=>'yyyy/MM/dd',
                'html5'=>false,
                'attr'=>array(
                    'type'=>'date'
                )
            ))
            ->add('submit', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-info sub')))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'main_bundle_recherche_voyage';
    }
}
