<?php
namespace Back\GeneralBundle\Twig\Extension;

class PriceExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this,'getPrice')),
            new \Twig_SimpleFilter('show', array($this,'isExist')),
        );
    }
    
    function getPrice($prix)
    {
        return number_format($prix, 3, '.', '').' TND' ;
    }

    public function isExist($var)
    {
        if(!is_array($var))
            return $var;
        return null;
    }
    
    public function getName()
    {
        return 'price_extension';
    }
}