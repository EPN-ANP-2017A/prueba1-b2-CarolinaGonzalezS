<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PedidoRepository")
 */
class Pedido
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;


    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="pedidos")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="Plato", inversedBy="pedidos")
     * @ORM\JoinColumn(name="plato_id", referencedColumnName="id")
     */
    private $plato;


    /**
     * Get cliente
     *
     * @return int
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set cliente
     *
     * @param \int $cliente
     *
     * @return Pedido
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }


    /**
     * Get plato
     *
     * @return int
     */
    public function getPlato()
    {
        return $this->plato;
    }

    /**
     * Set plato
     *
     * @param \int $plato
     *
     * @return Pedido
     */
    public function setPlato($plato)
    {
        $this->plato = $plato;

        return $this;
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Pedido
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}

