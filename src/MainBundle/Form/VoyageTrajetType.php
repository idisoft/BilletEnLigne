<?php

namespace MainBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageTrajetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbrePlaceInit',IntegerType::class,array(
            'label'=>'Nombre de place à vendre'
        ))
                ->add('trajet', EntityType::class,array(
                    'label'=>'Trajet',
                    'class'=>'MainBundle\Entity\Trajet',
                    'required'=>false,
                    'placeholder'=>'Selectionnez un trajet',
                    'choice_label'=>'trajet',
                ))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\VoyageTrajet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_voyagetrajet';
    }


}
