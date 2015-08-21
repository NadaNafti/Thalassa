<?php
    namespace Front\GeneralBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Back\UserBundle\Form\ClientType;
    use Back\VoyageOrganiseBundle\Form\ReservationType;
    use Back\VoyageOrganiseBundle\Entity\Periode;
    use Back\VoyageOrganiseBundle\Entity\Pack;
    use Doctrine\ORM\EntityRepository;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Back\VoyageOrganiseBundle\Entity\Reservation;
    use Back\VoyageOrganiseBundle\Entity\ReservationChambre;
    use Back\VoyageOrganiseBundle\Entity\ReservationLigne;
    use Back\VoyageOrganiseBundle\Entity\ReservationPersonne;

    class ProgrammeController extends Controller
    {
        public function accueilAction()
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            $sliders = $em->getRepository('FrontConfigBundle:SliderPR')->findBy(array(),array('ordre' => 'asc'));
            $themes = $em->getRepository('BackProgrammeBundle:Theme')->findBy(array(),array('libelle' => 'asc'));
            if($request->isMethod('POST')){
                return $this->redirect($this->generateUrl('front_programme_liste',array(
                    'themes' => $request->get('themes'),
                    'name'   => urlencode($request->get('motcles')),
                )));
            }
            return $this->render('FrontGeneralBundle:programme:accueil.html.twig',array(
                'themes'  => $themes,
                'sliders' => $sliders,
            ));
        }

        public function listeAction($page,$themes,$name)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            $listeThemes = $em->getRepository('BackProgrammeBundle:Theme')->findBy(array(),array('libelle' => 'asc'));
            if($request->isMethod('POST')){
                $themesArray = array();
                $arrays = array();
                foreach($listeThemes as $th){
                    if($request->get('themes_' . $th->getId()))
                        $themesArray[] = $th->getId();
                }
                if(count($themesArray) == 0)
                    $arrays['themes'] = 'all';
                else
                    $arrays['themes'] = implode(',',$themesArray);
                $arrays['name'] = urlencode($request->get('motclesSearch'));
                return $this->redirect($this->generateUrl('front_programme_liste',$arrays));
            }
            $programmes = $em->getRepository('BackProgrammeBundle:Programme')->filtre($themes,$name);
            $paginator = $this->get('knp_paginator');
            $programmes = $paginator->paginate($programmes,$page,9);
            return $this->render('FrontGeneralBundle:programme\liste:liste.html.twig',array(
                'programmes' => $programmes,
                'themes'     => $listeThemes,
                'motcle'     => urldecode($name),
            ));
        }

        public function detailsAction($slug)
        {
            $em = $this->getDoctrine()->getManager();
            $programme = $em->getRepository('BackProgrammeBundle:Programme')->findOneBy(array('slug' => $slug));
            return $this->render('FrontGeneralBundle:programme/details:details.html.twig',array(
                'programme' => $programme,
            ));
        }
    }
