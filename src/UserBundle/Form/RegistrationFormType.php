<?php

namespace UserBundle\Form;

use Doctrine\DBAL\Types\ArrayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles',ChoiceType::class,array(
            'label'=>'Rôle',
            'multiple'=>true,
            'choices'=>array(
                'Vendeur'=>'ROLE_SELLER',
                'Administrateur'=>'ROLE_ADMIN',
                'SU'=>'ROLE_SUPER_ADMIN'
            )
        ))
            ->add('compagnie', EntityType::class,array(
                'label'=>'Compagnie',
                'class'=>"MainBundle\Entity\Compagnie",
                'choice_label'=>'nomComp',
                'required'=>false
                )
            )        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'my_user_registration';
    }


}
