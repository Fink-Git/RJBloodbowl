<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametres
 *
 * @ORM\Table(name="parametres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametresRepository")
 */
class Parametres
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
     * @var int
     *
     * @ORM\Column(name="saisonCourante", type="integer")
     */
    private $saisonCourante;

    /**
     * @var int
     *
     * @ORM\Column(name="ptVictoire", type="integer")
     */
    private $ptVictoire;

    /**
     * @var int
     *
     * @ORM\Column(name="ptDefaite", type="integer")
     */
    private $ptDefaite;

    /**
     * @var int
     *
     * @ORM\Column(name="ptNul", type="integer")
     */
    private $ptNul;

    /**
     * @var int|null
     *
     * @ORM\Column(name="TresorerieInitiale", type="bigint", nullable=true)
     */
    private $tresorerieInitiale;


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
     * Set saisonCourante.
     *
     * @param int $saisonCourante
     *
     * @return Parametres
     */
    public function setSaisonCourante($saisonCourante)
    {
        $this->saisonCourante = $saisonCourante;

        return $this;
    }

    /**
     * Get saisonCourante.
     *
     * @return int
     */
    public function getSaisonCourante()
    {
        return $this->saisonCourante;
    }

    /**
     * Set ptVictoire.
     *
     * @param int $ptVictoire
     *
     * @return Parametres
     */
    public function setPtVictoire($ptVictoire)
    {
        $this->ptVictoire = $ptVictoire;

        return $this;
    }

    /**
     * Get ptVictoire.
     *
     * @return int
     */
    public function getPtVictoire()
    {
        return $this->ptVictoire;
    }

    /**
     * Set ptDefaite.
     *
     * @param int $ptDefaite
     *
     * @return Parametres
     */
    public function setPtDefaite($ptDefaite)
    {
        $this->ptDefaite = $ptDefaite;

        return $this;
    }

    /**
     * Get ptDefaite.
     *
     * @return int
     */
    public function getPtDefaite()
    {
        return $this->ptDefaite;
    }

    /**
     * Set ptNul.
     *
     * @param int $ptNul
     *
     * @return Parametres
     */
    public function setPtNul($ptNul)
    {
        $this->ptNul = $ptNul;

        return $this;
    }

    /**
     * Get ptNul.
     *
     * @return int
     */
    public function getPtNul()
    {
        return $this->ptNul;
    }

    /**
     * Set tresorerieInitiale.
     *
     * @param int|null $tresorerieInitiale
     *
     * @return Parametres
     */
    public function setTresorerieInitiale($tresorerieInitiale = null)
    {
        $this->tresorerieInitiale = $tresorerieInitiale;

        return $this;
    }

    /**
     * Get tresorerieInitiale.
     *
     * @return int|null
     */
    public function getTresorerieInitiale()
    {
        return $this->tresorerieInitiale;
    }
}
