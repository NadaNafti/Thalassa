<?php
namespace Back\GeneralBundle\Twig\Extension;

class TesteExtension extends \Twig_Extension
{
    /*
     * Twig va exécuter cette méthode pour savoir quelle(s) fonction(s) ajoute notre service
     */

    public function getFunctions()
    {
        return array(
            'functionTeste' => new \Twig_Function_Method($this, 'getTeste'),
            'functionTeste2' => new \Twig_Function_Method($this, 'getTeste2'),
            );
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
