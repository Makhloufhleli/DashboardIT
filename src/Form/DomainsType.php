<?php

namespace App\Form;

use App\Entity\Domains;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use App\Entity\AccountsManagers;
use App\Repository\AccountsManagersRepository;

class DomainsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('creationDate', DateType::class, [
                    'widget' => 'single_text',
                    // adds a class that can be selected in JavaScript
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('registrAr')
                ->add('registrAnt')
                ->add('ns1')
                ->add('ns2')
                ->add('project')
                ->add('adminManager', EntityType::class, [
                    'class' => AccountsManagers::class,
                    'query_builder' => function (AccountsManagersRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.function = :val')
                                ->setParameter('val', 'adminManager');
                    },
                ])
                ->add('technicalManager', EntityType::class, [
                    'class' => AccountsManagers::class,
                    'query_builder' => function (AccountsManagersRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.function = :val')
                                ->setParameter('val', 'technicalManager');
                    },
                ])
                ->add('billingManager', EntityType::class, [
                    'class' => AccountsManagers::class,
                    'query_builder' => function (AccountsManagersRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.function = :val')
                                ->setParameter('val', 'billingManager');
                    },
                ])
                ->add('client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Domains::class,
        ]);
    }

}
