<?php

namespace App\Form;

use App\Entity\ProfileEntity;
use App\Entity\UserEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address')
            ->add('phone')
            ->add('country')
            ->add('city')
            ->add('zipCode')
            ->add('user', EntityType::class, [
                'class' => UserEntity::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfileEntity::class,
        ]);
    }
}
