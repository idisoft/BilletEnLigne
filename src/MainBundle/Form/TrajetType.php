<?php

namespace MainBundle\Form;

use MainBundle\Repository\TrajetRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrajetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('distance',IntegerType::class,array(
            'attr'=>array(
                'placeholder'=>'Distance entre la source et cette destination'
            )
        ))
            ->add('prixTrajet', MoneyType::class, array(
                'label'=>'Prix du trajet ',
                'currency'=>'XOF'
            ))
            ->add('source', EntityType::class,array(
                'label'=>'Gare de depart',
                'class'=>'MainBundle\Entity\Gare',
                'choice_label'=>'nomGare',
            ))
            ->add('destination', EntityType::class,array(
                'label'=>'Gare de destination',
                'class'=>'MainBundle\Entity\Gare',
                'choice_label'=>'nomGare',
            ))
            ->add('trajetParent', EntityType::class,array(
                'label'=>'Trajet Parent',
                'class'=>'MainBundle\Entity\Trajet',
                'required'=>false,
                'placeholder'=>'Selectionnez Trajet Parent',
                'choice_label'=>'trajet',
                'query_builder'=>(function(TrajetRepository $rp){
                    return $rp->findTrajetsParents();
                })
            ))       ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Trajet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_trajet';
    }


}
