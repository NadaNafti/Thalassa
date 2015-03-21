<?php
namespace Back\GeneralBundle\Twig\Extension;

class PriceExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('price', array($this,'getPrice')));
    }
    
    function getPrice($prix)
    {
        return number_format($prix, 3, '.', '').' TND' ;
    }
    
    public function getName()
    {
        return 'price_extension';
    }
}