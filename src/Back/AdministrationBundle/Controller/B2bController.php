<?php

namespace Back\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\AdministrationBundle\Entity\Amicale;
use Back\AdministrationBundle\Form\AmicaleType;
use Back\AdministrationBundle\Entity\Convention;
use Back\AdministrationBundle\Form\ConventionType;
use Back\UserBundle\Entity\Client;
use Back\UserBundle\Form\ClientType;
use Symfony\Component\Form\FormError;

class B2bController extends Controller
{

    public function amicaleAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id))
        {
            $amicale=new Amicale();
            $amicale->setMontant(0);
        }
        else
            $amicale=$em->getRepository("BackAdministrationBundle:Amicale")->find($id);
        $form=$this->createForm(new AmicaleType(), $amicale);
        $amicales=$em->getRepository("BackAdministrationBundle:Amicale")->findAll();
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $amicale=$form->getData();
                $em->persist($amicale);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre amicale a été traité avec succées ");
                return $this->redirect($this->generateUrl("amicale"));
            }
        }
        return $this->render('BackAdministrationBundle:b2b:amicale.html.twig', array(
                    'amicales'=>$amicales,
                    'amicale' =>$amicale,
                    'form'    =>$form->createView()
        ));
    }

    public function deleteAmicaleAction(Amicale $amicale)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($amicale);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre amicale a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("amicale"));
    }

    public function clientsAction(Amicale $amicale, $id2)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id2))
            $client=new Client();
        else
            $client=$em->getRepository("BackUserBundle:Client")->find($id2);
        $form=$this->createForm(new ClientType(), $client);
        if(is_null($id2))
            $form->add('user', new \Back\UserBundle\Form\RegistrationFormType() );
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                if(is_null($id2))
                {
                    $client=$form->getData();
                    $user=$client->getUser();
                    $verif1=$em->getRepository("BackUserBundle:User")->findBy(array( 'username'=>$user->getUsername() ));
                    $verif2=$em->getRepository("BackUserBundle:User")->findBy(array( 'email'=>$user->getEmail() ));
                    if(count($verif2) > 0)
                        $form->get('user')->get('email')->addError(new FormError("E-mail  ".$user->getEmail()." existe dejà dans la base "));
                    elseif(count($verif1) > 0)
                        $form->get('user')->get('username')->addError(new FormError("Nom d'utilisateur  ".$user->getUsername()." existe dejà dans la base "));
                    else
                    {
                        $em->persist($client->setAmicale($amicale)->setUser(NULL));
                        $em->persist($user->setClient($client)->setEnabled(1));
                        $em->flush();
                        $session->getFlashBag()->add('success', " Votre client a été traité avec succées ");
                        return $this->redirect($this->generateUrl("amicale_client", array( 'id'=>$amicale->getId() )));
                    }
                }
                else
                {
                    $em->persist($client->setAmicale($amicale));
                    $em->flush();
                    $session->getFlashBag()->add('success', " Votre client a été traité avec succées ");
                    return $this->redirect($this->generateUrl("amicale_client", array( 'id'=>$amicale->getId() )));
                }
            }
        }
        return $this->render('BackAdministrationBundle:b2b:client.html.twig', array(
                    'client' =>$client,
                    'amicale'=>$amicale,
                    'form'   =>$form->createView()
        ));
    }

    public function deleteClientAction(Client $client)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $em->remove($client);
        $em->flush();
        $session->getFlashBag()->add('success', " Votre client a été supprimé avec succées ");
        return $this->redirect($this->generateUrl("amicale_client", array( 'id'=>$client->getAmicale()->getId() )));
    }

}
