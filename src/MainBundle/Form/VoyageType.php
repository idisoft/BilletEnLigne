<?php

namespace MainBundle\Form;

use MainBundle\Repository\AutoBusRepository;
use MainBundle\Repository\TrajetRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;

class VoyageType extends AbstractType
{

    protected $requestStack;


    public function __construct(RequestStack $reqStack)
    {
        $this->requestStack=$reqStack;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateVoyage',DateType::class,array(
            'label'=>'Date Départ',
            'widget'=>'single_text',
        ))
            ->add('heureDepart',TimeType::class,array(
                'label'=>'Heure Depart',
                'required'=>true,
                'widget' => 'single_text',
            ))
            ->add('autoBus',EntityType::class, array(
                'label'=>'L\'AutoBus',
                'class'=>'MainBundle\Entity\AutoBus',
                'choice_label'=>'Code',
                'query_builder'=>(function(AutoBusRepository $rp){
                        $idCompagnie=$this->requestStack->getCurrentRequest()->getSession()->get('idCompagnie');
                        return $rp->findByCurrentCompagnie($idCompagnie);
                })
            ))
            ->add('statusVoyage',ChoiceType::class, array(
                'label'=>'Status',
                'choices'=>array(
                    'Voyage ouvert'=>'open',
                    'Fermé'=>'close'
                )
            )) ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Voyage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_parcours';
    }


}
