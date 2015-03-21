<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontGeneralBundle:Default:index.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('FrontGeneralBundle:Default:contact.html.twig');
    }
}
