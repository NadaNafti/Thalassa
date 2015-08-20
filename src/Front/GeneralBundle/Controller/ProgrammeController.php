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
    }
