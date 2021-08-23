<?php

namespace App\Form;

use App\Entity\Certificates;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\DomainsRepository;
use App\Entity\Domains;

use App\Entity\Hosts;
use App\Repository\HostsRepository;

class CertificatesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('creationDate', DateType::class, [
                    'widget' => 'single_text',
                    // adds a class that can be selected in JavaScript
                    'attr' => ['class' => 'form-control'],
                    'data' => new \DateTime("now"),
                ])
                ->add('renewalDate', DateType::class, [
                    'widget' => 'single_text',
                    // adds a class that can be selected in JavaScript
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('renewalMode', ChoiceType::class, [
                    'placeholder'=>'Choose renewal mode',
                    'required'=>true,
                    'choices' => [
                        'Auto' => 'auto',
                        'Manual' => 'manual'
                    ],
                    'label' => FALSE
                ])
                ->add('owner')
                ->add('issuer')
                ->add('domain', EntityType::class, [
                    'class' => Domains::class,
                    'placeholder'=>'Choose domain',
                    'required'=>false,
                    'query_builder' => function (DomainsRepository $er) {
                        return $er->createQueryBuilder('d')
                                ->andWhere('d.hasCertificate = :val')
                                ->setParameter('val', false);
                    },
                ])
                ->add('host', EntityType::class, [
                    'class' => Hosts::class,
                    'placeholder'=>'Choose host name',
                    'required'=>false,
                    'query_builder' => function (HostsRepository $er) {
                        return $er->createQueryBuilder('h')
                                ->andWhere('h.hasCertificate = :val')
                                ->setParameter('val', false);
                    },
                ])
                ->add('sshKey')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Certificates::class,
        ]);
    }

}
