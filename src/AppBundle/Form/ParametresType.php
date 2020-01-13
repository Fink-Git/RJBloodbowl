<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ParametresType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('saisonCourante', EntityType::class, [
                'class' => 'AppBundle:Saison',
                'choice_label' => 'name',
                ])
            ->add('ptVictoire', IntegerType::class)
            ->add('ptDefaite', IntegerType::class)
            ->add('ptNul', IntegerType::class)
            ->add('tresorerieInitiale', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'Enregistrer']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Parametres'
        ));
    }


}
