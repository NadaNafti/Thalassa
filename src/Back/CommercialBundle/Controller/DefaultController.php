<?php

namespace Back\CommercialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BackCommercialBundle:Default:index.html.twig', array('name' => $name));
    }
}
