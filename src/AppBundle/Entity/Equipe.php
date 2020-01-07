<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipeRepository")
 */
class Equipe
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
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\ManyToOne(targetEntity="Coach", inversedBy="equipes")
     * @ORM\JoinColumn(name="coach_id", referencedColumnName="id")
     */
    private $coach;

    /**
     * @ORM\ManyToOne(targetEntity="Roster", inversedBy="equipes")
     * @ORM\JoinColumn(name="roster_id", referencedColumnName="id")
     */
    private $roster;

    /** 
     * @ORM\ManyToMany(targetEntity="Joueurs")
     * @ORM\JoinTable(name="joueurs_equipes",
     *      joinColumns={@ORM\JoinColumn(name="equipe_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="joueur_id", referencedColumnName="id")}
     *      )
     */
    private $joueurs;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Relances", type="integer", nullable=true)
     */
    private $relances;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Popularite", type="integer", nullable=true)
     */
    private $popularite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Assistants", type="integer", nullable=true)
     */
    private $assistants;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PomPom", type="integer", nullable=true)
     */
    private $pomPom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Tresorerie", type="bigint", nullable=true)
     */
    private $tresorerie;

    /**
     * @var bool
     *
     * @ORM\Column(name="Apothicaire", type="boolean")
     */
    private $apothicaire;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
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
     * @return Equipe
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
     * Set relances.
     *
     * @param int|null $relances
     *
     * @return Equipe
     */
    public function setRelances($relances = null)
    {
        $this->relances = $relances;

        return $this;
    }

    /**
     * Get relances.
     *
     * @return int|null
     */
    public function getRelances()
    {
        return $this->relances;
    }

    /**
     * Set popularite.
     *
     * @param int|null $popularite
     *
     * @return Equipe
     */
    public function setPopularite($popularite = null)
    {
        $this->popularite = $popularite;

        return $this;
    }

    /**
     * Get popularite.
     *
     * @return int|null
     */
    public function getPopularite()
    {
        return $this->popularite;
    }

    /**
     * Set assistants.
     *
     * @param int|null $assistants
     *
     * @return Equipe
     */
    public function setAssistants($assistants = null)
    {
        $this->assistants = $assistants;

        return $this;
    }

    /**
     * Get assistants.
     *
     * @return int|null
     */
    public function getAssistants()
    {
        return $this->assistants;
    }

    /**
     * Set pomPom.
     *
     * @param int|null $pomPom
     *
     * @return Equipe
     */
    public function setPomPom($pomPom = null)
    {
        $this->pomPom = $pomPom;

        return $this;
    }

    /**
     * Get pomPom.
     *
     * @return int|null
     */
    public function getPomPom()
    {
        return $this->pomPom;
    }

    /**
     * Set tresorerie.
     *
     * @param int|null $tresorerie
     *
     * @return Equipe
     */
    public function setTresorerie($tresorerie = null)
    {
        $this->tresorerie = $tresorerie;

        return $this;
    }

    /**
     * Get tresorerie.
     *
     * @return int|null
     */
    public function getTresorerie()
    {
        return $this->tresorerie;
    }

    /**
     * Set apothicaire.
     *
     * @param bool $apothicaire
     *
     * @return Equipe
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
     * Set coach.
     *
     * @param \AppBundle\Entity\Coach|null $coach
     *
     * @return Equipe
     */
    public function setCoach(\AppBundle\Entity\Coach $coach = null)
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * Get coach.
     *
     * @return \AppBundle\Entity\Coach|null
     */
    public function getCoach()
    {
        return $this->coach;
    }

    /**
     * Set roster.
     *
     * @param \AppBundle\Entity\Roster|null $roster
     *
     * @return Equipe
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
     * Add joueur.
     *
     * @param \AppBundle\Entity\Joueurs $joueur
     *
     * @return Equipe
     */
    public function addJoueur(\AppBundle\Entity\Joueurs $joueur)
    {
        $this->joueurs[] = $joueur;

        return $this;
    }

    /**
     * Remove joueur.
     *
     * @param \AppBundle\Entity\Joueurs $joueur
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeJoueur(\AppBundle\Entity\Joueurs $joueur)
    {
        return $this->joueurs->removeElement($joueur);
    }

    /**
     * Get joueurs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }

    /**
     * Set logo.
     *
     * @param string $logo
     *
     * @return Equipe
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
