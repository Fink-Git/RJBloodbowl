<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class TirageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('saison', EntityType::class, [
                'class' => 'AppBundle:Saison',
                'choice_label' => 'name',
            ])
            ->add('nbPoule', IntegerType::class, [
                'label' => 'Nombre de poule',
                'empty_data' => 1
            ])
            ->add('nbQualif', IntegerType::class, [
                'label' => 'Nombre de journées de qualification'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Effectuer le tirage'
            ])
        ;
    }
}