<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rencontre
 *
 * @ORM\Table(name="rencontre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RencontreRepository")
 */
class Rencontre
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
     * @ORM\ManyToOne(targetEntity="Journee", inversedBy="rencontres")
     * @ORM\JoinColumn(name="journee_id", referencedColumnName="id")
     */
    private $journee;

    /**
     * @ORM\ManyToOne(targetEntity="Coach")
     * @ORM\JoinColumn(name="coach1_id", referencedColumnName="id")
     */
    private $coach1;

    /**
     * @ORM\ManyToOne(targetEntity="Coach")
     * @ORM\JoinColumn(name="coach2_id", referencedColumnName="id")
     */
    private $coach2;

    /**
     * @var int
     *
     * @ORM\Column(name="score_coach1", type="integer")
     */
    private $score_coach1 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="score_coach2", type="integer")
     */
    private $score_coach2 = 0;

    /**
     * @var int
     *journee_id
     * @ORM\Column(name="sorties_coach1", type="integer")
     */
    private $sorties_coach1 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="sorties_coach2", type="integer")
     */
    private $sorties_coach2 = 0;

    /**
     * @var bool
     * 
     * @ORM\Column(name="enregistre", type="boolean")
     */
    private $enregistre = false;

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of journee
     */ 
    public function getJournee()
    {
        return $this->journee;
    }

    /**
     * Set the value of journee
     *
     * @return  self
     */ 
    public function setJournee($journee)
    {
        $this->journee = $journee;

        return $this;
    }

    /**
     * Set scoreCoach1
     *
     * @param integer $scoreCoach1
     *
     * @return Rencontre
     */
    public function setScoreCoach1($scoreCoach1)
    {
        $this->score_coach1 = $scoreCoach1;

        return $this;
    }

    /**
     * Get scoreCoach1
     *
     * @return integer
     */
    public function getScoreCoach1()
    {
        return $this->score_coach1;
    }

    /**
     * Set scoreCoach2
     *
     * @param integer $scoreCoach2
     *
     * @return Rencontre
     */
    public function setScoreCoach2($scoreCoach2)
    {
        $this->score_coach2 = $scoreCoach2;

        return $this;
    }

    /**
     * Get scoreCoach2
     *
     * @return integer
     */
    public function getScoreCoach2()
    {
        return $this->score_coach2;
    }

    /**
     * Set sortiesCoach1
     *
     * @param integer $sortiesCoach1
     *
     * @return Rencontre
     */
    public function setSortiesCoach1($sortiesCoach1)
    {
        $this->sorties_coach1 = $sortiesCoach1;

        return $this;
    }

    /**
     * Get sortiesCoach1
     *
     * @return integer
     */
    public function getSortiesCoach1()
    {
        return $this->sorties_coach1;
    }

    /**
     * Set sortiesCoach2
     *
     * @param integer $sortiesCoach2
     *
     * @return Rencontre
     */
    public function setSortiesCoach2($sortiesCoach2)
    {
        $this->sorties_coach2 = $sortiesCoach2;

        return $this;
    }

    /**
     * Get sortiesCoach2
     *
     * @return integer
     */
    public function getSortiesCoach2()
    {
        return $this->sorties_coach2;
    }

    /**
     * Set enregistre
     *
     * @param boolean $enregistre
     *
     * @return Rencontre
     */
    public function setEnregistre($enregistre)
    {
        $this->enregistre = $enregistre;

        return $this;
    }

    /**
     * Get enregistre
     *
     * @return boolean
     */
    public function getEnregistre()
    {
        return $this->enregistre;
    }

    /**
     * Set coach1
     *
     * @param \AppBundle\Entity\Coach $coach1
     *
     * @return Rencontre
     */
    public function setCoach1(\AppBundle\Entity\Coach $coach1 = null)
    {
        $this->coach1 = $coach1;

        return $this;
    }

    /**
     * Get coach1
     *
     * @return \AppBundle\Entity\Coach
     */
    public function getCoach1()
    {
        return $this->coach1;
    }

    /**
     * Set coach2
     *
     * @param \AppBundle\Entity\Coach $coach2
     *
     * @return Rencontre
     */
    public function setCoach2(\AppBundle\Entity\Coach $coach2 = null)
    {
        $this->coach2 = $coach2;

        return $this;
    }

    /**
     * Get coach2
     *
     * @return \AppBundle\Entity\Coach
     */
    public function getCoach2()
    {
        return $this->coach2;
    }
}
