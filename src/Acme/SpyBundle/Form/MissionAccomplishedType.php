<?php

namespace Acme\SpyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MissionAccomplishedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('longitude')
            ->add('latitude')
            ->add('info')
            ->add('status')
            ->add('files')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\SpyBundle\Entity\MissionAccomplished',
            'csrf_protection' => false
        ));
    }

    public function getName()
    {
        return 'complet';
    }
}
