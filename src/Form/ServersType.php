<?php

namespace App\Form;

use App\Entity\Servers;
use App\Entity\AccountsManagers;
use App\Repository\AccountsManagersRepository;
use App\Entity\Projects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ServersType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('identifier')
                ->add('name')
                ->add('type')
                ->add('ipAdress')
                ->add('projectPublicCloud')
                ->add('model')
                ->add('region')
                ->add('dataCenter')
                ->add('subscription')
                ->add('operatingSystem')
                ->add('cpu')
                ->add('ram')
                ->add('discSpace')
                ->add('extraDisc')
                ->add('apache_nginx', ChoiceType::class, [
                    'choices' => [
                        'Apache' => 'apache',
                        'Nginx' => 'nginx'
                    ],
                    'label' => FALSE,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ])
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
            'data_class' => Servers::class,
        ]);
    }

}
