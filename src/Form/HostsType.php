<?php

namespace App\Form;

use App\Entity\Hosts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phpVersion')
            ->add('discSpace')
            ->add('certificate')
            ->add('cdn')
            ->add('sites', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => [
                    'attr' => ['class' => 'form-control'],
                ],
            ])
            ->add('databasesLinks')

            ->add('backups')
            ->add('apache_nginx')
            ->add('adminManager')
            ->add('technicalManager')
            ->add('billingManager')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hosts::class,
        ]);
    }
}
