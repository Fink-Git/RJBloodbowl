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
     * @ORM\OneToMany(targetEntity="Equipe", mappedBy="coach") 
     */
    private $equipes;

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
     * Constructor
     */
    public function __construct()
    {
        $this->saisons = new ArrayCollection();
        $this->equipes = new ArrayCollection();
    }


    /**
     * Add equipe.
     *
     * @param \AppBundle\Entity\Equipe $equipe
     *
     * @return Coach
     */
    public function addEquipe(\AppBundle\Entity\Equipe $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe.
     *
     * @param \AppBundle\Entity\Equipe $equipe
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEquipe(\AppBundle\Entity\Equipe $equipe)
    {
        return $this->equipes->removeElement($equipe);
    }

    /**
     * Get equipes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipes()
    {
        return $this->equipes;
    }
}
