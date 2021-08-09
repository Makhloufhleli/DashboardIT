<?php

namespace App\Form;

use App\Entity\Domains;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DomainsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('creationDate')
            ->add('registrAr')
            ->add('registrAnt')
            ->add('ns1')
            ->add('ns2')
            ->add('project')
            ->add('adminManager')
            ->add('technicalManager')
            ->add('billingManager')
            ->add('client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Domains::class,
        ]);
    }
}
