<?php

namespace App\Form;

use App\Entity\AccountsManagers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AccountsManagersType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name')
            ->add('function', ChoiceType::class, [
                'choices' => [
                    '-- Select function --' => '',
                    'Admin' => 'adminManager',
                    'Technique' => 'technicalManager',
                    'Billing' => 'billingManager',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => AccountsManagers::class,
        ]);
    }

}
