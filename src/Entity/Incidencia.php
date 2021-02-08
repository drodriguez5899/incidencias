<?php

namespace App\Entity;

use App\Repository\IncidenciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IncidenciaRepository::class)
 */
class Incidencia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @ORM\Column(type="time")
     */
    private $fecha_creacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="cliente")
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity=LineasDeIncidencia::class, mappedBy="incidencia")
     */
    private $lineasDeIncidencia;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="incidencia")
     */
    private $usuario;

    public function __construct()
    {
        $this->lineasDeIncidencia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha_creacion): self
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|LineasDeIncidencia[]
     */
    public function getLineasDeIncidencia(): Collection
    {
        return $this->lineasDeIncidencia;
    }

    public function addLineasDeIncidencium(LineasDeIncidencia $lineasDeIncidencium): self
    {
        if (!$this->lineasDeIncidencia->contains($lineasDeIncidencium)) {
            $this->lineasDeIncidencia[] = $lineasDeIncidencium;
            $lineasDeIncidencium->setIncidencia($this);
        }

        return $this;
    }

    public function removeLineasDeIncidencium(LineasDeIncidencia $lineasDeIncidencium): self
    {
        if ($this->lineasDeIncidencia->removeElement($lineasDeIncidencium)) {
            // set the owning side to null (unless already changed)
            if ($lineasDeIncidencium->getIncidencia() === $this) {
                $lineasDeIncidencium->setIncidencia(null);
            }
        }

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
