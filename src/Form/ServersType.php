<?php

namespace App\Form;

use App\Entity\Servers;
use App\Entity\AccountsManagers;
use App\Repository\AccountsManagersRepository;
use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
                    'placeholder'=>'Choose Web server',
                    'required'=>true,
                    'choices' => [
                        'Apache' => 'apache',
                        'Nginx' => 'nginx'
                    ],
                    'label' => FALSE,
                ])
                ->add('adminManager', EntityType::class, [
                    'class' => AccountsManagers::class,
                    'placeholder'=>'Choose Admin',
                    'required'=>true,
                    'query_builder' => function (AccountsManagersRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.function = :val')
                                ->setParameter('val', 'adminManager');
                    },
                ])
                ->add('technicalManager', EntityType::class, [
                    'class' => AccountsManagers::class,
                    'placeholder'=>'Choose Technical manager',
                    'required'=>true,
                    'query_builder' => function (AccountsManagersRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.function = :val')
                                ->setParameter('val', 'technicalManager');
                    },
                ])
                ->add('billingManager', EntityType::class, [
                    'class' => AccountsManagers::class,
                    'placeholder'=>'Choose Billing manager',
                    'required'=>true,
                    'query_builder' => function (AccountsManagersRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.function = :val')
                                ->setParameter('val', 'billingManager');
                    },
                ])
                ->add('client', EntityType::class, [
                    'class' => Clients::class,
                    'placeholder'=>'Choose Client',
                    'required'=>true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Servers::class,
        ]);
    }

}
