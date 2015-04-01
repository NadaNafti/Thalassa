<?php
namespace Back\GeneralBundle\Twig\Extension;

class InterfacesExtension extends \Twig_Extension
{
    /*
     * Twig va exécuter cette méthode pour savoir quelle(s) fonction(s) ajoute notre service
     */

    public function getFunctions()
    {
        return array(
            'getStars' => new \Twig_Function_Method($this, 'getStars'),
            'functionTeste' => new \Twig_Function_Method($this, 'getTeste'),
            'functionTeste2' => new \Twig_Function_Method($this, 'getTeste2'),
            );
    }
    
    public function getStars($num)
    {
        if(is_numeric($num))
        {
            $stars="";
            for($i=1;$i<=$num;$i++)
                $stars.='<i class="fa fa-star fa fa-white"></i>';
            return $stars;
        }
        else
            return "";
    }

    public function getTeste()
    {
        return 'Teste ...';
    }
    
    public function getTeste2()
    {
        return 'Teste2 ...';
    }

    public function getName()
    {
        return 'SdzAntispam';
    }

    // …
}
