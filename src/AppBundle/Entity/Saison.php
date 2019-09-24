<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saison
 *
 * @ORM\Table(name="saison")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SaisonRepository")
 */
class Saison
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Cycle", inversedBy="saisons")
     * @ORM\JoinColumn(name="cycle_id", referencedColumnName="id")
     */
    private $cycle;

    /**
     * @ORM\OneToMany(targetEntity="Journee", mappedBy="saison")
     */
    private $journees;

    /**
     * ORM\ManyToMany(targetEntity="Coach", inversedBy="saisons")
     * @ORM\JoinTable(name="participants_saisons")
     */
    //TODO :  terminer la liaison many to many
    private $participants;

    // IMPORTANT pour les relations bi-directionnelles
    public function __construct()
    {
        $this->journees = new ArrayCollection();
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
     * @return Saison
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
     * Get the value of cycle
     */ 
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set the value of cycle
     *
     * @return  self
     */ 
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }
}

