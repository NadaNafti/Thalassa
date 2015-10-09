<?php

namespace Back\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\UserBundle\Entity\Client;
use Back\UserBundle\Form\ClientType;
use Back\UserBundle\Entity\User;
use Back\UserBundle\Form\RegistrationFormType;
use Symfony\Component\Form\FormError;

class ClientController extends Controller
{

//    public function listeAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//        $clients = $em->getRepository("BackUserBundle:Client")->findBy(array(), array('id' => 'desc'));
//        $paginator = $this->get('knp_paginator');
//        $clients = $paginator->paginate($clients, $this->getRequest()->query->get('page', 1), 10);
//        return $this->render('BackAdministrationBundle:client:liste.html.twig', array(
//                    'clients' => $clients,
//        ));
//    }
//
//    public function addUserAction(Client $client)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//        if (is_null($client->getUser()))
//        {
//            $user = new User ();
//            $user->setEmail($client->getEmail());
//        }
//        else
//            $user = $client->getUser();
//        $form = $this->createForm(new RegistrationFormType(), $user)->remove('groups');
//        if (!is_null($client->getUser()))
//            $form->remove('plainPassword');
//        if ($this->getRequest()->isMethod('POST'))
//        {
//            $form->submit($this->getRequest());
//            if ($form->isValid())
//            {
//                $user = $form->getData();
//                if (is_null($client->getUser()))
//                {
//                    $verif1 = $em->getRepository("BackUserBundle:User")->findBy(array('username' => $user->getUsername()));
//                    $verif2 = $em->getRepository("BackUserBundle:User")->findBy(array('email' => $user->getEmail()));
//                    if (count($verif2) > 0)
//                        $form->get('email')->addError(new FormError("E-mail  " . $user->getEmail() . " existe dejà dans la base "));
//                    elseif (count($verif1) > 0)
//                        $form->get('username')->addError(new FormError("Nom d'utilisateur  " . $user->getUsername() . " existe dejà dans la base "));
//                    else
//                    {
//                        $em->persist($user->setEnabled(TRUE)->setClient($client));
//                        $em->flush();
//                        $session->getFlashBag()->add('success', " Votre Client a été traité avec succées ");
//                        return $this->redirect($this->generateUrl('user_client', array('id' => $client->getId())));
//                    }
//                }
//                $em->persist($user->setEnabled(TRUE)->setClient($client));
//                $em->flush();
//                $session->getFlashBag()->add('success', " Votre Client a été traité avec succées ");
//                return $this->redirect($this->generateUrl('user_client', array('id' => $client->getId())));
//            }
//        }
//        return $this->render('BackAdministrationBundle:client:user.html.twig', array(
//                    'form' => $form->createView(),
//                    'client' => $client,
//        ));
//    }
//
//    public function ajouterAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//        if (is_null($id))
//            $client = new Client ();
//        else
//            $client = $em->getRepository("BackUserBundle:Client")->find($id);
//        $form = $this->createForm(new ClientType(), $client)->remove('responsable')->add('amicale');
//        if (is_null($id))
//            $form->add('user', new \Back\UserBundle\Form\RegistrationFormType());
//        if ($this->getRequest()->isMethod('POST'))
//        {
//            $form->submit($this->getRequest());
//            if ($form->isValid())
//            {
//                if (is_null($id))
//                {
//                    $client = $form->getData();
//                    $user = $client->getUser();
//                    $verif1 = $em->getRepository("BackUserBundle:User")->findBy(array('username' => $user->getUsername()));
//                    $verif2 = $em->getRepository("BackUserBundle:User")->findBy(array('email' => $user->getEmail()));
//                    if (count($verif2) > 0)
//                        $form->get('user')->get('email')->addError(new FormError("E-mail  " . $user->getEmail() . " existe dejà dans la base "));
//                    elseif (count($verif1) > 0)
//                        $form->get('user')->get('username')->addError(new FormError("Nom d'utilisateur  " . $user->getUsername() . " existe dejà dans la base "));
//                    else
//                    {
//                        $em->persist($client->setUser(null));
//                        $em->persist($user->setClient($client)->setEnabled(1));
//                        $em->flush();
//                        $session->getFlashBag()->add('success', " Votre Client a été traité avec succées ");
//                        return $this->redirect($this->generateUrl('liste_client'));
//                    }
//                }
//                else
//                {
//                    $em->persist($client);
//                    $em->flush();
//                    $session->getFlashBag()->add('success', " Votre Client a été traité avec succées ");
//                    return $this->redirect($this->generateUrl('liste_client'));
//                }
//            }
//        }
//        return $this->render('BackAdministrationBundle:client:ajouter.html.twig', array(
//                    'form' => $form->createView(),
//                    'client' => $client,
//        ));
//    }
//
//    public function supprimerAction(Client $client)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//        try
//        {
//            $em->remove($client);
//            $em->flush();
//            $session->getFlashBag()->add('success', " Votre Client a été supprimé avec succées ");
//        } catch (\Exception $ex)
//        {
//            $session->getFlashBag()->add('danger', 'Votre Client est utilisé dans une autre table');
//        }
//        return $this->redirect($this->generateUrl('liste_client'));
//    }

}
