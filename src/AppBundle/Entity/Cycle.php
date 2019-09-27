<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CycleRepository")
 * @UniqueEntity("name");
 */
class Cycle
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Saison", mappedBy="cycle")
     */
    private $saisons;

    public function __construct()
    {
        // IMPORTANT: pour les relations bi-directionnelles
        $this->saisons = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of saisons
     */ 
    public function getSaisons()
    {
        return $this->saisons;
    }

    /**
     * Set the value of saisons
     *
     * @return  self
     */ 
    public function setSaisons($saisons)
    {
        $this->saisons = $saisons;

        return $this;
    }

    /**
     * Add saison
     *
     * @param \AppBundle\Entity\Saison $saison
     *
     * @return Cycle
     */
    public function addSaison(\AppBundle\Entity\Saison $saison)
    {
        $this->saisons[] = $saison;

        return $this;
    }

    /**
     * Remove saison
     *
     * @param \AppBundle\Entity\Saison $saison
     */
    public function removeSaison(\AppBundle\Entity\Saison $saison)
    {
        $this->saisons->removeElement($saison);
    }
}
