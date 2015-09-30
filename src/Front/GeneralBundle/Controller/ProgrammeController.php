<?php
    namespace Front\GeneralBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Back\UserBundle\Form\ClientType;
    use Back\ProgrammeBundle\Entity\Periode;
    use Doctrine\ORM\EntityRepository;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Back\ProgrammeBundle\Entity\Reservation;

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

        public function listeAction($page,$themes,$sort,$direction,$name)
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
            $programmes = $em->getRepository('BackProgrammeBundle:Programme')->filtre($themes,$name,$sort,$direction);
            $paginator = $this->get('knp_paginator');
            $programmes = $paginator->paginate($programmes,$page,9);
            return $this->render('FrontGeneralBundle:programme\liste:liste.html.twig',array(
                'programmes' => $programmes,
                'themes'     => $listeThemes,
                'motcle'     => urldecode($name),
            ));
        }

        public function sortAction( $themes, $name)
        {
            $request = $this->getRequest();
            if ($request->isMethod('POST')) {
                $arrays = array();
                $arrays['themes'] = $themes;
                $arrays['name'] = $name;
                if($request->get('direction')!='')
                {
                    $arrays['direction'] = $request->get('direction');
                    $arrays['sort'] = $request->get('sort');
                }
                return $this->redirect($this->generateUrl('front_programme_liste', $arrays));
            }
        }

        public function detailsAction($slug)
        {
            $em = $this->getDoctrine()->getManager();
            $programme = $em->getRepository('BackProgrammeBundle:Programme')->findOneBy(array('slug' => $slug));
            return $this->render('FrontGeneralBundle:programme/details:details.html.twig',array(
                'programme' => $programme,
            ));
        }

        public function reservationAction($slug,Periode $periode)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            $user = $this->get('security.context')->getToken()->getUser();
            if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') && !is_null($user->getClient()))
                $client = $user->getClient();
            else
                $client = $this->container->get('users')->getPassager();
            $form = $this->createFormBuilder()
                ->add("client",new ClientType(),array('data' => $client))
                ->getForm();
            if($request->isMethod('POST')){
                $form->submit($request);
                $data = $request->request->all();
                return $this->redirect($this->generateUrl('front_programme_thankyou',array(
                    'slug'        => $slug,
                    'reservation' => $this->container->get('reservationPR')->saveReservation($periode,$client,$data,'frontoffice'),
                )));
            }
            return $this->render('FrontGeneralBundle:programme:reservation.html.twig',array(
                'form'       => $form->createView(),
                'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate'),
                'periode'    => $periode,
            ));
        }

        public function successAction(Reservation $reservation)
        {
            return $this->render('FrontGeneralBundle:programme:success.html.twig',array('reservation' => $reservation));
        }
    }
