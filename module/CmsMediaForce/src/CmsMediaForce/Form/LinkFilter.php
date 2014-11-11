<?php

namespace CmsMediaForce\Form;

use Zend\InputFilter\InputFilter;

class LinkFilter  extends InputFilter
{
    
    public function __construct() 
    {
        
        $this->add(array(
           'name'=>'descricao',
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
           'name'=>'href',
            'required'=>true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim'),
            ),
            'validators' => array(
                array('name'=>'NotEmpty','options'=>array('messages'=>array('isEmpty'=>'Não pode estar em branco')))
            )
        ));
        
    }
    
}
