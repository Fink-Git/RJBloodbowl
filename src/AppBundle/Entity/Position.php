<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PositionRepository")
 */
class Position
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
     * @ORM\ManyToOne(targetEntity="Roster", inversedBy="positions")
     * @ORM\JoinColumn(name="roster_id", referencedColumnName="id")
     */
    private $roster;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="NbMax", type="integer")
     */
    private $nbMax;

    /**
     * @var int
     *
     * @ORM\Column(name="Cout", type="integer")
     */
    private $cout;

    /**
     * @var int
     *
     * @ORM\Column(name="M", type="integer")
     */
    private $m;

    /**
     * @var int
     *
     * @ORM\Column(name="F", type="integer")
     */
    private $f;

    /**
     * @var int
     *
     * @ORM\Column(name="AG", type="integer")
     */
    private $aG;

    /**
     * @var int
     *
     * @ORM\Column(name="VA", type="integer")
     */
    private $vA;

    /** 
     * @ORM\ManyToMany(targetEntity="Competences")
     * @ORM\JoinTable(name="competences_positions",
     *      joinColumns={@ORM\JoinColumn(name="position_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="competence_id", referencedColumnName="id")}
     *      )
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity="TypeCompetence")
     * @ORM\JoinTable(name="progressionsSimple_positions",
     *      joinColumns={@ORM\JoinColumn(name="position_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="progression_id", referencedColumnName="id")}
     *      ) 
     */
    private $progressionsSimple;

    /**
     * @ORM\ManyToMany(targetEntity="TypeCompetence")
     * @ORM\JoinTable(name="progressionsDouble_positions",
     *      joinColumns={@ORM\JoinColumn(name="position_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="progression_id", referencedColumnName="id")}
     *      ) 
     */
    private $progressionsDouble;

    public function __construct()
    {
       $this->competences = new ArrayCollection();
       $this->progressionsDouble = new ArrayCollection();
       $this->progressionsSimple = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre.
     *
     * @param string $titre
     *
     * @return Position
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set nbMax.
     *
     * @param int $nbMax
     *
     * @return Position
     */
    public function setNbMax($nbMax)
    {
        $this->nbMax = $nbMax;

        return $this;
    }

    /**
     * Get nbMax.
     *
     * @return int
     */
    public function getNbMax()
    {
        return $this->nbMax;
    }

    /**
     * Set cout.
     *
     * @param int $cout
     *
     * @return Position
     */
    public function setCout($cout)
    {
        $this->cout = $cout;

        return $this;
    }

    /**
     * Get cout.
     *
     * @return int
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * Set m.
     *
     * @param int $m
     *
     * @return Position
     */
    public function setM($m)
    {
        $this->m = $m;

        return $this;
    }

    /**
     * Get m.
     *
     * @return int
     */
    public function getM()
    {
        return $this->m;
    }

    /**
     * Set f.
     *
     * @param int $f
     *
     * @return Position
     */
    public function setF($f)
    {
        $this->f = $f;

        return $this;
    }

    /**
     * Get f.
     *
     * @return int
     */
    public function getF()
    {
        return $this->f;
    }

    /**
     * Set aG.
     *
     * @param int $aG
     *
     * @return Position
     */
    public function setAG($aG)
    {
        $this->aG = $aG;

        return $this;
    }

    /**
     * Get aG.
     *
     * @return int
     */
    public function getAG()
    {
        return $this->aG;
    }

    /**
     * Set vA.
     *
     * @param int $vA
     *
     * @return Position
     */
    public function setVA($vA)
    {
        $this->vA = $vA;

        return $this;
    }

    /**
     * Get vA.
     *
     * @return int
     */
    public function getVA()
    {
        return $this->vA;
    }

    /**
     * Set roster.
     *
     * @param \AppBundle\Entity\Roster|null $roster
     *
     * @return Position
     */
    public function setRoster(\AppBundle\Entity\Roster $roster = null)
    {
        $this->roster = $roster;

        return $this;
    }

    /**
     * Get roster.
     *
     * @return \AppBundle\Entity\Roster|null
     */
    public function getRoster()
    {
        return $this->roster;
    }

    /**
     * Add competence.
     *
     * @param \AppBundle\Entity\Competences $competence
     *
     * @return Position
     */
    public function addCompetence(\AppBundle\Entity\Competences $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence.
     *
     * @param \AppBundle\Entity\Competences $competence
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCompetence(\AppBundle\Entity\Competences $competence)
    {
        return $this->competences->removeElement($competence);
    }

    /**
     * Get competences.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Add progressionsSimple.
     *
     * @param \AppBundle\Entity\TypeCompetence $progressionsSimple
     *
     * @return Position
     */
    public function addProgressionsSimple(\AppBundle\Entity\TypeCompetence $progressionsSimple)
    {
        $this->progressionsSimple[] = $progressionsSimple;

        return $this;
    }

    /**
     * Remove progressionsSimple.
     *
     * @param \AppBundle\Entity\TypeCompetence $progressionsSimple
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProgressionsSimple(\AppBundle\Entity\TypeCompetence $progressionsSimple)
    {
        return $this->progressionsSimple->removeElement($progressionsSimple);
    }

    /**
     * Get progressionsSimple.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProgressionsSimple()
    {
        return $this->progressionsSimple;
    }

    /**
     * Add progressionsDouble.
     *
     * @param \AppBundle\Entity\TypeCompetence $progressionsDouble
     *
     * @return Position
     */
    public function addProgressionsDouble(\AppBundle\Entity\TypeCompetence $progressionsDouble)
    {
        $this->progressionsDouble[] = $progressionsDouble;

        return $this;
    }

    /**
     * Remove progressionsDouble.
     *
     * @param \AppBundle\Entity\TypeCompetence $progressionsDouble
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProgressionsDouble(\AppBundle\Entity\TypeCompetence $progressionsDouble)
    {
        return $this->progressionsDouble->removeElement($progressionsDouble);
    }

    /**
     * Get progressionsDouble.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProgressionsDouble()
    {
        return $this->progressionsDouble;
    }
}
