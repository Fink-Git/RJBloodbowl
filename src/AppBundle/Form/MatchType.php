<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //affichage en 2 temps
        // 1 - Affichage de tous les matchs de la saison dans un select dont la valeur serait JX : Coach1 - Coach2
        // 2 - Une fois le match validé/selectionné, affichage du formulaire de match pour les scores et les sorties
    }
}