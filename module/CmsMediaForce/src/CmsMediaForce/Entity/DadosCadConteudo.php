<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="dados_cad_conteudo")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\DadosCadConteudoRepository")
 */

class DadosCadConteudo 
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;

    /**
     * @ORM\ManyToOne(targetEntity="CmsMediaForce\Entity\Categoria")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     */
    protected $categoria;

    /**
     * @ORM\ManyToOne(targetEntity="CmsMediaForce\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $criadoPor;

   /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="datetime", name="expires_at", nullable=true)
     */
    protected $expiresAt;

    /**
     * @ORM\Column(type="boolean", name="is_expired")
     */
    protected $isExpired;
    

    public function __construct($options = array())
    {
		
        (new Hydrator\ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        $this->isExpired = false;

    }

    public function toArray()
    {
        return array(
			'id' => $this->id,
			'slug' => $this->slug,
			'categoria' => $this->categoria,
			'criado_por'=>$this->criadoPor,
            'created_at'=> $this->createdAt,
            'updated_at'=> $this->updatedAt,
            'is_expired' => $this->isExpired,
            'expira_em' => $this->expiresAt,
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
     * Gets the value of slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the value of slug.
     *
     * @param mixed $slug the slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Gets the value of categoria.
     *
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Sets the value of categoria.
     *
     * @param mixed $categoria the categoria
     *
     * @return self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Gets the value of criadoPor.
     *
     * @return mixed
     */
    public function getCriadoPor()
    {
        return $this->criadoPor;
    }

    /**
     * Sets the value of criadoPor.
     *
     * @param mixed $criadoPor the criado por
     *
     * @return self
     */
    public function setCriadoPor($criadoPor)
    {
        $this->criadoPor = $criadoPor;

        return $this;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    /**
     * Gets the value of expiresAt.
     *
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Sets the value of expiresAt.
     *
     * @param mixed $expiresAt the expires at
     *
     * @return self
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Gets the value of isExpired.
     *
     * @return mixed
     */
    public function isExpired()
    {
        return $this->isExpired;
    }

    /**
     * Sets the value of isExpired.
     *
     * @param mixed $isExpired the is expired
     *
     * @return self
     */
    public function setIsExpired($isExpired)
    {
        $this->isExpired = $isExpired;

        return $this;
    }
}
