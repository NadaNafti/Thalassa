<?php

namespace Back\BilletterieMaritimeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BackBilletterieMaritimeBundle:Default:index.html.twig', array('name' => $name));
    }
}
