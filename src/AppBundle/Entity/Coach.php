<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Coach
 *
 * @ORM\Table(name="coach")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoachRepository")
 */
class Coach
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Saison", mappedBy="participants")
     */
    private $saisons;

    /**
     * @ORM\ManyToMany(targetEntity="Rencontre", inversedBy="coachs")
     * @ORM\JoinTable(name="coach_rencontres")
     */
    private $rencontres;

    public function __construct()
    {
        $this->saisons = new ArrayCollection();
        $this->rencontres = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Coach
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add saison
     *
     * @param \AppBundle\Entity\Saison $saison
     *
     * @return Coach
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

    /**
     * Get saisons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSaisons()
    {
        return $this->saisons;
    }

    /**
     * Get the value of rencontres
     */ 
    public function getRencontres()
    {
        return $this->rencontres;
    }

    /**
     * Set the value of rencontres
     *
     * @return  self
     */ 
    public function setRencontres($rencontres)
    {
        $this->rencontres = $rencontres;

        return $this;
    }

    /**
     * Add rencontre
     *
     * @param \AppBundle\Entity\Rencontre $rencontre
     *
     * @return Coach
     */
    public function addRencontre(\AppBundle\Entity\Rencontre $rencontre)
    {
        $this->rencontres[] = $rencontre;

        return $this;
    }

    /**
     * Remove rencontre
     *
     * @param \AppBundle\Entity\Rencontre $rencontre
     */
    public function removeRencontre(\AppBundle\Entity\Rencontre $rencontre)
    {
        $this->rencontres->removeElement($rencontre);
    }
}
