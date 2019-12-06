<?php

namespace AppBundle\Form;

use AppBundle\Entity\Rencontre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tableaumatch =  $builder->getData();
        $matches = [];
        $match_joue = [];
        // formattage du select
        foreach ($tableaumatch as $key_journee => $journee) {
            foreach ($journee as $key => $match) {
                $matches[$key_journee . ' - ' . $match->getCoach1()->getName() . ' vs ' . $match->getCoach2()->getName() 
                            . ' - ' . ($match->getEnregistre() ?'Enregistre':'Non Enregistre')] = $key;
            }
        }

        $builder
            ->add('match', ChoiceType::class, [
                'choices' => $matches,
                'choice_attr' => function($choice,$key,$value){
                    if(strstr($key,'Non Enregistre')){
                        return ['class' => 'match_non_joue'];
                    }
                    else {
                        return ['class' => 'match_joue'];
                    }
                },
            ])
            ->add('score_coach1', IntegerType::class)
            ->add('score_coach2', IntegerType::class)
            ->add('sorties_coach1', IntegerType::class)
            ->add('sorties_coach2', IntegerType::class)
            ->add('validate', SubmitType::class, ['label' => 'Enregistrer le match'])
            ;
        
    }

}