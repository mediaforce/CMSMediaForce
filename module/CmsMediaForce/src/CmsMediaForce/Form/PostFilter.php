<?php

namespace CmsMediaForce\Form;

use Zend\InputFilter\InputFilter;

class PostFilter  extends InputFilter
{
    
    public function __construct() 
    {
        
        $this->add(array(
           'name'=>'titulo',
            'required'=>true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim'),
            ),
            'validators' => array(
                array('name'=>'NotEmpty','options'=>array('messages'=>array('isEmpty'=>'Não pode estar em branco')))
            )
        ));

        $this->add(array(
           'name'=>'conteudo',
            'required'=>true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim'),
            ),
            'validators' => array(
                array('name'=>'NotEmpty','options'=>array('messages'=>array('isEmpty'=>'Não pode estar em branco')))
            )
        ));

        $this->add(array(
            'name'=>'expiresAt',
            'required'=>false
        ));
        
    }
    
}
