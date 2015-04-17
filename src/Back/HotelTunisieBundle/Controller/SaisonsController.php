<?php

namespace Back\HotelTunisieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;
use Back\HotelTunisieBundle\Entity\Hotel;
use Back\HotelTunisieBundle\Form\HotelType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Back\HotelTunisieBundle\Entity\Media;
use Back\HotelTunisieBundle\Form\MediaType;
use Back\HotelTunisieBundle\Entity\StopSales;
use Back\HotelTunisieBundle\Form\StopSalesType;
use Back\HotelTunisieBundle\Entity\HotelRepository;
use Back\HotelTunisieBundle\Entity\FicheTechnique;
use Back\HotelTunisieBundle\Form\FicheTechniqueType;
use Back\HotelTunisieBundle\Entity\Saison;
use Back\HotelTunisieBundle\Form\SaisonType;
use Back\HotelTunisieBundle\Form\SaisonCType;
use Back\HotelTunisieBundle\Entity\SaisonChambre;
use Back\HotelTunisieBundle\Form\SaisonChambreType;
use Back\HotelTunisieBundle\Entity\SaisonReduc;
use Back\HotelTunisieBundle\Form\SaisonReducType;
use Back\HotelTunisieBundle\Entity\SaisonArrangement;
use Back\HotelTunisieBundle\Form\SaisonAType;
use Back\HotelTunisieBundle\Entity\SaisonSuppChambre;
use Back\HotelTunisieBundle\Form\SaisonSType;
use Back\HotelTunisieBundle\Entity\SaisonVue;
use Back\HotelTunisieBundle\Form\SaisonVType;
use Back\HotelTunisieBundle\Entity\SaisonSupp;
use Back\HotelTunisieBundle\Form\SaisonSuppType;
use Back\HotelTunisieBundle\Entity\SaisonWeekend;
use Back\HotelTunisieBundle\Form\SaisonWeekendType;
use Back\HotelTunisieBundle\Entity\SaisonAutreSupp;
use Back\HotelTunisieBundle\Form\SaisonAutreSuppType;
use Back\HotelTunisieBundle\Entity\SaisonAutreReduc;
use Back\HotelTunisieBundle\Form\SaisonAutreReducType;

class SaisonsController extends Controller
{

    public function GenererAction(Hotel $hotel)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $data=array();
        $form=$this->createFormBuilder()
                        ->add('saisons', 'entity', array(
                            'class'        =>'BackHotelTunisieBundle:Saison',
                            'query_builder'=>function(EntityRepository $er) use ($hotel){
                                return $er->createQueryBuilder('s')
                                        ->where('s.hotel = :id')
                                        ->setParameter('id', $hotel->getId());
                                ;
                            },
                            'required'   =>false,
                            'empty_value'=>'Saison de base',
                            'empty_data' =>null
                        ))->getForm();
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->submit($request);
            if($data['saisons']== NULL)
                $saison=$hotel->getSaisonBase();
            else
                $saison=$data['saisons'];
        }
        return $this->render('BackHotelTunisieBundle:Saisons:generer.html.twig', array(
                    'hotel'=>$hotel,
                    'form' =>$form->createView()
        ));
    }

}
