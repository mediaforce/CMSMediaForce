<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="telefones")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\TelefoneRepository")
 */

class Telefone 
{
    protected $tiposPermitidos = array('telefone', 'celular', 'fax');

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
    protected $numero;
    
    /** @ORM\Column(type="string", columnDefinition="ENUM('telefone', 'celular', 'fax')") */
    protected $tipo;

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
     * Gets the value of numero.
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Sets the value of numero.
     *
     * @param string $numero the numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Gets the value of tipo.
     *
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Sets the value of tipo.
     *
     * @param mixed $tipo the tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        if (!in_array($tipo, array('telefone', 'celular', 'fax'))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->tipo = $tipo;

        return $this;
    }

    public function getTiposPermitidos() {
        return $this->tiposPermitidos;
    }
}
