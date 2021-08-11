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

class CertificatesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('creationDate', DateType::class, [
                    'widget' => 'single_text',
                    // adds a class that can be selected in JavaScript
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('renewalDate', DateType::class, [
                    'widget' => 'single_text',
                    // adds a class that can be selected in JavaScript
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('renewalMode', ChoiceType::class, [
                    'choices' => [
                        '--Select renewal mode--'=>'',
                        'Auto' => 'auto',
                        'Manual' => 'manual'
                    ],
                    'label' => FALSE
                ])
                ->add('owner')
                ->add('issuer')
                ->add('domain', EntityType::class, [
                    'class' => Domains::class,
                    'query_builder' => function (DomainsRepository $er) {
                        return $er->createQueryBuilder('d')
                                ->andWhere('d.hasCertificate = :val')
                                ->setParameter('val', false);
                    },
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Certificates::class,
        ]);
    }

}
