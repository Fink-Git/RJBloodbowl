<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Roster
 *
 * @ORM\Table(name="roster")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RosterRepository")
 */
class Roster
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
     * @var bool
     *
     * @ORM\Column(name="apothicaire", type="boolean")
     */
    private $apothicaire;

    /**
     * @var int
     *
     * @ORM\Column(name="cout_relance", type="integer")
     */
    private $coutRelance;

    /**
     * @ORM\OneToMany(targetEntity="Position", mappedBy="roster")
     */
    private $positions;

    /**
     * @ORM\OneToMany(targetEntity="Equipe", mappedBy="roster")
     */
    private $equipes;

    public function __construct()
    {
        $this->positions = new ArrayCollection();
        $this->equipes = new ArrayCollection();
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
     * @return Roster
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
     * Set apothicaire.
     *
     * @param bool $apothicaire
     *
     * @return Roster
     */
    public function setApothicaire($apothicaire)
    {
        $this->apothicaire = $apothicaire;

        return $this;
    }

    /**
     * Get apothicaire.
     *
     * @return bool
     */
    public function getApothicaire()
    {
        return $this->apothicaire;
    }

    /**
     * Set coutRelance.
     *
     * @param int $coutRelance
     *
     * @return Roster
     */
    public function setCoutRelance($coutRelance)
    {
        $this->coutRelance = $coutRelance;

        return $this;
    }

    /**
     * Get coutRelance.
     *
     * @return int
     */
    public function getCoutRelance()
    {
        return $this->coutRelance;
    }

    /**
     * Add position.
     *
     * @param \AppBundle\Entity\Position $position
     *
     * @return Roster
     */
    public function addPosition(\AppBundle\Entity\Position $position)
    {
        $this->positions[] = $position;

        return $this;
    }

    /**
     * Remove position.
     *
     * @param \AppBundle\Entity\Position $position
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePosition(\AppBundle\Entity\Position $position)
    {
        return $this->positions->removeElement($position);
    }

    /**
     * Get positions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Add equipe.
     *
     * @param \AppBundle\Entity\Equipe $equipe
     *
     * @return Roster
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
