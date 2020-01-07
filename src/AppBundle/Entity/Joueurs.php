<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Joueurs
 *
 * @ORM\Table(name="joueurs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JoueursRepository")
 */
class Joueurs
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
     * @ORM\ManyToOne(targetEntity="Position")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    private $position;

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
     * @ORM\JoinTable(name="competences_joueurs",
     *      joinColumns={@ORM\JoinColumn(name="joueur_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="competence_id", referencedColumnName="id")}
     *      )
     */
    private $competences;

    /**
     * @var int|null
     *
     * @ORM\Column(name="XP", type="integer", nullable=true)
     */
    private $xP;

    /**
     * @var int
     *
     * @ORM\Column(name="Valeur", type="integer")
     */
    private $valeur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Persistantes", type="integer", nullable=true)
     */
    private $persistantes;

    /**
     * @var bool
     *
     * @ORM\Column(name="RLPM", type="boolean")
     */
    private $rLPM;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
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
     * Set name.
     *
     * @param string $name
     *
     * @return Joueurs
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set m.
     *
     * @param int $m
     *
     * @return Joueurs
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
     * @return Joueurs
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
     * @return Joueurs
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
     * @return Joueurs
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
     * Set xP.
     *
     * @param int|null $xP
     *
     * @return Joueurs
     */
    public function setXP($xP = null)
    {
        $this->xP = $xP;

        return $this;
    }

    /**
     * Get xP.
     *
     * @return int|null
     */
    public function getXP()
    {
        return $this->xP;
    }

    /**
     * Set valeur.
     *
     * @param int $valeur
     *
     * @return Joueurs
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur.
     *
     * @return int
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set persistantes.
     *
     * @param int|null $persistantes
     *
     * @return Joueurs
     */
    public function setPersistantes($persistantes = null)
    {
        $this->persistantes = $persistantes;

        return $this;
    }

    /**
     * Get persistantes.
     *
     * @return int|null
     */
    public function getPersistantes()
    {
        return $this->persistantes;
    }

    /**
     * Set rLPM.
     *
     * @param bool $rLPM
     *
     * @return Joueurs
     */
    public function setRLPM($rLPM)
    {
        $this->rLPM = $rLPM;

        return $this;
    }

    /**
     * Get rLPM.
     *
     * @return bool
     */
    public function getRLPM()
    {
        return $this->rLPM;
    }

    /**
     * Set position.
     *
     * @param \AppBundle\Entity\Position|null $position
     *
     * @return Joueurs
     */
    public function setPosition(\AppBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return \AppBundle\Entity\Position|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add competence.
     *
     * @param \AppBundle\Entity\Competences $competence
     *
     * @return Joueurs
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
}
