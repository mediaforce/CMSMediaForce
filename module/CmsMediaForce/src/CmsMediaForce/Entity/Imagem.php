<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="imagens")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\ImagemRepository")
 */

class Imagem 
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $descricao;
    
    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    protected $endereco;

    /**
     * @ORM\OneToOne(targetEntity="CmsMediaForce\Entity\Galeria")
     * @ORM\JoinColumn(name="galeria_id", referencedColumnName="id")
     */
    protected $galeria;
    
    public function __construct($options = array())
    {

        (new Hydrator\ClassMethods)->hydrate($options, $this);

    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods)->extract($this);
    }

    


    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of descricao.
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Sets the value of descricao.
     *
     * @param string $descricao the descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Gets the value of endereco.
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Sets the value of endereco.
     *
     * @param string $endereco the endereco
     *
     * @return self
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Gets the value of galeria.
     *
     * @return mixed
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /**
     * Sets the value of galeria.
     *
     * @param mixed $galeria the galeria
     *
     * @return self
     */
    protected function setGaleria($galeria)
    {
        $this->galeria = $galeria;

        return $this;
    }
}


