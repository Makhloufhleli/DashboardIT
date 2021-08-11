<?php

namespace App\Form;

use App\Entity\Certificates;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CertificatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projects')
            ->add('creationDate')
            ->add('renewalDate')
            ->add('renewalMode')
            ->add('owner')
            ->add('issuer')
            ->add('domain')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Certificates::class,
        ]);
    }
}
