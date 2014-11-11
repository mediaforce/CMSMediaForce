<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="categorias")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\CategoriaRepository")
 */

class Categoria 
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
     * @ORM\OneToOne(targetEntity="CmsMediaForce\Entity\Categoria")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id",  nullable=true)
     */
    protected $parent;
    
    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var boolean
     */
    protected $isFile;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var boolean
     */
    protected $isPost;
    
    
    public function __construct($options = array())
    {
		
        (new Hydrator\ClassMethods)->hydrate($options, $this);

        $this->isFile = false;
        $this->isPost = false;
    }
    


    public function toArray()
    {
        return array(
			'id' => $this->id,
			'nome' => $this->nome,
			'parente' => $this->parent->getId(),
			'is_file'=>$this->isFile
        );
    }
    
    public function __toString() {
        if (is_null($this->nome)) {
            return 'NULL';
        }
        return $this->nome;
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
     * Gets the value of parent.
     *
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the value of parent.
     *
     * @param mixed $parent the parent
     *
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Gets the value of isFile.
     *
     * @return boolean
     */
    public function isFile()
    {
        return $this->isFile;
    }

    /**
     * Sets the value of isFile.
     *
     * @param boolean $isFile the is file
     *
     * @return self
     */
    public function setIsFile($isFile)
    {
        $this->isFile = $isFile;

        return $this;
    }

    /**
     * Gets the value of isPost.
     *
     * @return boolean
     */
    public function isPost()
    {
        return $this->isPost;
    }

    /**
     * Sets the value of isPost.
     *
     * @param boolean $isPost the is post
     *
     * @return self
     */
    public function setIsPost($isPost)
    {
        $this->isPost = $isPost;

        return $this;
    }
}
