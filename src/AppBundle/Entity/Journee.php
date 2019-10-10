<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Journee
 *
 * @ORM\Table(name="journee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JourneeRepository")
 */
class Journee
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Saison", inversedBy="journees")
     * @ORM\JoinColumn(name="saison_id", referencedColumnName="id")
     */
    private $saison;

    /**
     * @ORM\OneToMany(targetEntity="Rencontre", mappedBy="journee")
     */
    private $rencontres;

    public function __construct()
    {
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
     * @return Journee
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
     * Get the value of saison
     */ 
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set the value of saison
     *
     * @return  self
     */ 
    public function setSaison($saison)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Add rencontre
     *
     * @param \AppBundle\Entity\Rencontre $rencontre
     *
     * @return Journee
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
