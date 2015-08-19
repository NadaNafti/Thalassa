<?php
    namespace Back\ProgrammeBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Back\ProgrammeBundle\Entity\Programme;
    use Back\ProgrammeBundle\Form\ProgrammeType;
    use Back\ProgrammeBundle\Entity\Description;
    use Back\ProgrammeBundle\Form\DescriptionType;
    use Back\ProgrammeBundle\Entity\Photo;
    use Back\ProgrammeBundle\Form\PhotoType;
    use Back\ProgrammeBundle\Entity\Periode;
    use Back\ProgrammeBundle\Form\PeriodeType;

    class ProgrammeController extends Controller
    {
        public function listeAction($page)
        {
            $em = $this->getDoctrine()->getManager();
            $programmes = $em->getRepository("BackProgrammeBundle:Programme")->findAll();
            $paginator = $this->get('knp_paginator');
            $programmes = $paginator->paginate($programmes,$page,20);
            return $this->render("BackProgrammeBundle:programme:liste.html.twig",array('programmes' => $programmes));
        }

        public function programmeAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if(is_null($id))
                $programme = new Programme();
            else
                $programme = $em->getRepository('BackProgrammeBundle:Programme')->find($id);
            $form = $this->createForm(new ProgrammeType(),$programme);
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $programme = $form->getData();
                    $em->persist($programme);
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre programme a été traité avec succées ");
                    return $this->redirect($this->generateUrl('back_programme_liste'));
                }
            }
            return $this->render('BackProgrammeBundle:programme:programme.html.twig',array(
                'form'      => $form->createView(),
                'programme' => $programme,
            ));
        }

        public function deleteAction(Programme $programme)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($programme);
            $em->flush();
            $session->getFlashBag()->add('success'," Votre programme a été supprimé avec succées ");
            return $this->redirect($this->generateUrl('back_programme_liste'));
        }

        public function descriptionAction(Programme $programme,$id)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if(is_null($id))
                $description = new Description();
            else
                $description = $em->getRepository('BackProgrammeBundle:Description')->find($id);
            $form = $this->createForm(new DescriptionType(),$description);
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $description = $form->getData();
                    $em->persist($description->setProgramme($programme));
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre déscription a été traité avec succées ");
                    return $this->redirect($this->generateUrl('back_programme_description',array('programme' => $programme->getId())));
                }
            }
            return $this->render('BackProgrammeBundle:programme:description.html.twig',array(
                'form'      => $form->createView(),
                'programme' => $programme,
            ));
        }

        public function descriptionDeleteAction(Description $description)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($description);
            $em->flush();
            $session->getFlashBag()->add('success'," Votre description a été supprimé avec succées ");
            return $this->redirect($this->generateUrl('back_programme_description',array('programme' => $description->getProgramme()->getId())));
        }

        public function photoAction(Programme $programme)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $photo = new Photo();
            $form = $this->createForm(new PhotoType(),$photo);
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                $photo = $form->getData();
                $em->persist($photo->setProgramme($programme));
                $em->flush();
                $session->getFlashBag()->add('success'," Votre photo a été traité avec succées ");
                return $this->redirect($this->generateUrl('back_programme_photo',array(
                    'programme' => $programme->getId(),
                )));
            }
            return $this->render('BackProgrammeBundle:programme:photo.html.twig',array(
                'form'      => $form->createView(),
                'programme' => $programme,
            ));
        }

        public function photoDeleteAction(Photo $photo)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($photo);
            $em->flush();
            $session->getFlashBag()->add('success'," Votre photo a été supprimé avec succées ");
            return $this->redirect($this->generateUrl('back_programme_photo',array('programme' => $photo->getProgramme()->getId())));
        }

        public function periodeAction(Programme $programme,$id)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            if(is_null($id))
                $periode = new Periode();
            else
                $periode = $em->getRepository('BackProgrammeBundle:Periode')->find($id);
            $form = $this->createForm(new PeriodeType(),$periode);
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $periode = $form->getData();
                    $em->persist($periode->setProgramme($programme));
                    $em->flush();
                    $session->getFlashBag()->add('success'," Votre déscription a été traité avec succées ");
                    return $this->redirect($this->generateUrl('back_programme_periode',array('programme' => $programme->getId())));
                }
            }
            return $this->render('BackProgrammeBundle:programme:periode.html.twig',array(
                'form'      => $form->createView(),
                'programme' => $programme,
            ));
        }
    }
