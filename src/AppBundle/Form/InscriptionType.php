<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coach', EntityType::class, [
                'class' => 'AppBundle:Coach',
                'choice_label' => 'name',
            ])
            ->add('saison', EntityType::class, [
                'class' => 'AppBundle:Saison',
                'choice_label' => 'name',
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }
}