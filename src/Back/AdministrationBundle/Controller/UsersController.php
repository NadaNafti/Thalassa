<?php

namespace Back\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Back\UserBundle\Entity\User;
use Back\UserBundle\Entity\Group;
use Back\UserBundle\Form\GroupType;
use Back\UserBundle\Form\RegistrationFormType;

class UsersController extends Controller
{

    public function groupAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id))
        {
            $group=new Group();
            $group->setRoles(array());
        }
        else
            $group=$em->getRepository("BackUserBundle:Group")->find($id);
        $groups=$em->getRepository("BackUserBundle:Group")->findAll();
        $form=$this->createForm(new GroupType(), $group);
        $form->add('roles', 'choice', array( 'choices' =>
            array(
                'ROLE_SUPER_ADMIN'=>'SUPER ADMIN',
                'ROLE_ADMIN'      =>'ADMIN',
            ),
            'required'=>true,
            'expanded'=>true,
            'multiple'=>true
        ));
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $group=$form->getData();
                $em->persist($group);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre groupe a été traité avec succées ");
                return $this->redirect($this->generateUrl("group"));
            }
        }
        return $this->render('BackAdministrationBundle:users:group.html.twig', array(
                    'groups'=>$groups,
                    'group' =>$group,
                    'form'  =>$form->createView()
        ));
    }

    public function deleteGroupAction(Group $group)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        try
        {
            $em->remove($group);
            $em->flush();
            $session->getFlashBag()->add('success', "Votre groupe a été supprimé avec succées");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', 'Votre groupe a été utilisé dans une autre table');
        }
        return $this->redirect($this->generateUrl("group"));
    }

    public function userAction($id, $password)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if(is_null($id))
            $user=new User();
        else
            $user=$em->getRepository("BackUserBundle:User")->find($id);
        $users=$em->getRepository("BackUserBundle:User")->findAll();
        $form=$this->createForm(new RegistrationFormType(), $user);
        if($id != NULL && $password == NULL)
            $form->remove("plainPassword");
        elseif($id != NULL)
            $form->remove("groups")->remove("email");
        if($this->getRequest()->isMethod("POST"))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $user=$form->getData();
                $em->persist($user);
                $em->flush();
                $session->getFlashBag()->add('success', " Votre utilisateur a été traité avec succées ");
                return $this->redirect($this->generateUrl("user"));
            }
        }
        return $this->render('BackAdministrationBundle:users:user.html.twig', array(
                    'users'=>$users,
                    'user' =>$user,
                    'form' =>$form->createView()
        ));
    }

    public function deleteUserAction(User $user)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        try
        {
            $em->remove($user);
            $em->flush();
            $session->getFlashBag()->add('success', "Votre utilisateur a été supprimé avec succées");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', 'Votre utilisateur a été utilisé dans une autre table');
        }
        return $this->redirect($this->generateUrl("user"));
    }

    public function enableUserAction(User $user)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($user->isEnabled())
            $user->setEnabled(false);
        else
            $user->setEnabled(true);
        $em->persist($user);
        $em->flush();
        $session->getFlashBag()->add('success', "Votre utilisateur a été modifié avec succées");
        return $this->redirect($this->generateUrl("user"));
    }

}
