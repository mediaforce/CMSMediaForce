<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="corretores")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\CorretorRepository")
 */

class Corretor 
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
    protected $nome;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $area;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $cargo;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $enderecoFoto;
    
    /**
     * @ORM\ManyToMany(targetEntity="CmsMediaForce\Entity\Telefone")
     * @ORM\JoinTable(name="corretor_telefones",
     *      joinColumns={@ORM\JoinColumn(name="id_corretor", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_telefone", referencedColumnName="id", unique=true)}
     *      )
     **/
    protected $telefones;    
    
    public function __construct($options = array())
    {
		$this->telefones = new \Doctrine\Common\Collections\ArrayCollection();
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    public function toArray()
    {   
        $tels = array();

        foreach ($this->telefones as $tel) {
            array_push( $tels, $tel->toArray());
        }

        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'area' => $this->area,
            'cargo' => $this->cargo,
            'email' => $this->email,
            'foto' => $this->enderecoFoto,
            'telefones' => $tels
        ];
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
     * Gets the value of nome.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param string $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    /**
     * Gets the value of area.
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Sets the value of area.
     *
     * @param string $area the area
     *
     * @return self
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Gets the value of cargo.
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Sets the value of cargo.
     *
     * @param string $cargo the cargo
     *
     * @return self
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param string $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of enderecoFoto.
     *
     * @return string
     */
    public function getEnderecoFoto()
    {
        return $this->enderecoFoto;
    }

    /**
     * Sets the value of enderecoFoto.
     *
     * @param string $enderecoFoto the endereco foto
     *
     * @return self
     */
    public function setEnderecoFoto($enderecoFoto)
    {
        $this->enderecoFoto = $enderecoFoto;

        return $this;
    }

    /**
     * Gets the value of telefones.
     *
     * @return mixed
     */
    public function getTelefones()
    {
        return $this->telefones;
    }

    /**
     * Sets the value of telefones.
     *
     * @param mixed $telefones the telefones
     *
     * @return self
     */
    public function addTelefone(Telefone $telefone)
    {
        $this->telefones[] = $telefone;

        return $this;
    }

    public function removeTelefone(Telefone $telefone) {
        $this->telefones->removeElement($telefone);
    }

    public function removeAllTelefones() {
        foreach( $this->telefones as $telefone) {
            $this->removeTelefone($telefone);
        }
    }

}
