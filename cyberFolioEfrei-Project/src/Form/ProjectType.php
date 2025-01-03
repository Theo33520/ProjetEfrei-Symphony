<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Technology;
use App\Entity\UserEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('screenshot')
            ->add('user', EntityType::class, [
                'class' => UserEntity::class,
                'choice_label' => 'id',
            ])
            ->add('technologies', EntityType::class, [
                'class' => Technology::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
