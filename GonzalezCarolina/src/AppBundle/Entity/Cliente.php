<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClienteRepository")
 */
class Cliente
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
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=10, unique=true)
     */
    private $cedula;


    /**
     * @var string
     *
     * @ORM\Column(name="fechaNa", type="string")
     */
    private $fechaNa;

    /**
     * @ORM\OneToMany(targetEntity="Pedido", mappedBy="cliente")
     */
    private $pedidos;


    public function __construct()
    {
        $this->pedidos=new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Cliente
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }


    /**
     * Set fechaNa
     *
     * @param string $fechaNa
     *
     * @return Cliente
     */
    public function setFechaNa($fechaNa)
    {
        $this->fechaNa = $fechaNa;

        return $this;
    }

    /**
     * Get fechaNa
     *
     * @return string
     */
    public function getFechaNa()
    {
        return $this->fechaNa;
    }
}

