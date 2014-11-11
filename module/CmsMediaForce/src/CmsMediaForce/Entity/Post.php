<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\PostRepository")
 */

class Post 
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
    protected $titulo;
    
    /**
     * @ORM\Column(type="text")
     * @var boolean
     */
    protected $conteudo;

    /**
     * @ORM\OneToOne(targetEntity="CmsMediaForce\Entity\DadosCadConteudo")
     * @ORM\JoinColumn(name="dados_cad_id", referencedColumnName="id")
     */
    protected $dadosCad;
    
    public function __construct($options = array())
    {
		
        (new Hydrator\ClassMethods)->hydrate($options, $this);

    }

    public function toArray()
    {
        $dadosCad = $this->getDadosCad()->toArray();

        return array(
            'id' => $this->id,
            'categoria' => $dadosCad['categoria'],
            'conteudo' => $this->conteudo,
            'titulo' => $this->titulo,
            'criado_em' => $dadosCad['created_at'],
            'atualizado_em' => $dadosCad['updated_at'],
            'criado_por' => $dadosCad['criado_por'],
            'expirar' => $dadosCad['is_expired'],
            'expiresAt' => $dadosCad['expira_em'],
        );
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
     * Gets the value of titulo.
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Sets the value of titulo.
     *
     * @param string $titulo the titulo
     *
     * @return self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Gets the value of conteudo.
     *
     * @return boolean
     */
    public function getConteudo()
    {
        return $this->conteudo;
    }

    /**
     * Sets the value of conteudo.
     *
     * @param boolean $conteudo the conteudo
     *
     * @return self
     */
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;

        return $this;
    }

    /**
     * Gets the value of dadosCad.
     *
     * @return mixed
     */
    public function getDadosCad()
    {
        return $this->dadosCad;
    }

    /**
     * Sets the value of dadosCad.
     *
     * @param mixed $dadosCad the dados cad
     *
     * @return self
     */
    public function setDadosCad($dadosCad)
    {
        $this->dadosCad = $dadosCad;

        return $this;
    }
}


