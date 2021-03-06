<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="arquivos_texto")
 * @ORM\Entity(repositoryClass="CmsMediaForce\Entity\ArquivoTextoRepository")
 */

class ArquivoTexto 
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
    protected $endereco;

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
            'descricao' => $this->descricao,
            'endereco' => $this->endereco,
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


