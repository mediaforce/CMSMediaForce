<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="links")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\ArquivoTextoRepository")
 */

class Link 
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
     * @ORM\Column(type="string")
     * @var string
     */
    protected $href;

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
    protected function setId($id)
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
    protected function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Gets the value of href.
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Sets the value of href.
     *
     * @param string $href the href
     *
     * @return self
     */
    protected function setHref($href)
    {
        $this->href = $href;

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
    protected function setDadosCad($dadosCad)
    {
        $this->dadosCad = $dadosCad;

        return $this;
    }
}



