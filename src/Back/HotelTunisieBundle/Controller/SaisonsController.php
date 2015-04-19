<?php

namespace Back\HotelTunisieBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Session\Session ;
use Doctrine\ORM\EntityRepository ;
use Back\HotelTunisieBundle\Entity\Hotel ;
use Back\HotelTunisieBundle\Form\HotelType ;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ;
use Back\HotelTunisieBundle\Entity\Media ;
use Back\HotelTunisieBundle\Form\MediaType ;
use Back\HotelTunisieBundle\Entity\StopSales ;
use Back\HotelTunisieBundle\Form\StopSalesType ;
use Back\HotelTunisieBundle\Entity\HotelRepository ;
use Back\HotelTunisieBundle\Entity\FicheTechnique ;
use Back\HotelTunisieBundle\Form\FicheTechniqueType ;
use Back\HotelTunisieBundle\Entity\Saison ;
use Back\HotelTunisieBundle\Form\SaisonType ;
use Back\HotelTunisieBundle\Form\SaisonCType ;
use Back\HotelTunisieBundle\Entity\SaisonChambre ;
use Back\HotelTunisieBundle\Form\SaisonChambreType ;
use Back\HotelTunisieBundle\Entity\SaisonReduc ;
use Back\HotelTunisieBundle\Form\SaisonReducType ;
use Back\HotelTunisieBundle\Entity\SaisonArrangement ;
use Back\HotelTunisieBundle\Form\SaisonAType ;
use Back\HotelTunisieBundle\Entity\SaisonSuppChambre ;
use Back\HotelTunisieBundle\Form\SaisonSType ;
use Back\HotelTunisieBundle\Entity\SaisonVue ;
use Back\HotelTunisieBundle\Form\SaisonVType ;
use Back\HotelTunisieBundle\Entity\SaisonSupp ;
use Back\HotelTunisieBundle\Form\SaisonSuppType ;
use Back\HotelTunisieBundle\Entity\SaisonWeekend ;
use Back\HotelTunisieBundle\Form\SaisonWeekendType ;
use Back\HotelTunisieBundle\Entity\SaisonAutreSupp ;
use Back\HotelTunisieBundle\Form\SaisonAutreSuppType ;
use Back\HotelTunisieBundle\Entity\SaisonAutreReduc ;
use Back\HotelTunisieBundle\Form\SaisonAutreReducType ;

class SaisonsController extends Controller
{

    public function GenererAction(Hotel $hotel)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        $data = array () ;
        $form = $this->createFormBuilder()
                        ->add('libelle' , 'text')
                        ->add('type' , 'choice' , array (
                            'choices' => array ('1' => 'Saison' , '2' => 'Promotion') ,
                            'required' => true ,
                            'empty_value' => 'Type de saison' ,
                            'empty_data' => null
                        ))
                        ->add('saisons' , 'entity' , array (
                            'class' => 'BackHotelTunisieBundle:Saison' ,
                            'query_builder' => function(EntityRepository $er) use ($hotel)
                    {
                        return $er->createQueryBuilder('s')
                                ->where('s.hotel = :id')
                                ->setParameter('id' , $hotel->getId()) ;
                        ;
                    } ,
                            'required' => false ,
                            'empty_value' => 'Saison de base' ,
                            'empty_data' => null
                        ))->getForm() ;
        $request = $this->getRequest() ;
        if ($request->isMethod("POST"))
        {
            $form->submit($request) ;
            $data=$form->getData();
            if ($data['saisons'] == NULL)
                $Saison = $hotel->getSaisonBase() ;
            else
                $Saison = $data['saisons'] ;
            
            $newSaison= clone  $Saison ;
            $newSaison->setHotelBase(NULL);
            $newSaison->setHotel($hotel);
            $newSaison->setLibelle($data['libelle']);
            $newSaison->setType($data['type']);

            $em->persist($newSaison);
            $em->flush();
//            if ($Saison->getSaisonReduc() != null)
//            {
//                $saisonReduc=$Saison->getSaisonReduc()->clearId();
//                $em->persist($saisonReduc);
//                $newSaison->setSaisonReduc($saisonReduc);
//            }
//            if($Saison->getSaisonSupp()!=null)
//            {
//                $saisonSupp=$Saison->getSaisonSupp()->clearId();
//                $em->persist($saisonSupp);
//                $newSaison->setSaisonSupp($saisonSupp);
//            }
//            if($Saison->getSaisonWeekend()!=null)
//            {
//                $saisonWeekend=$Saison->getSaisonWeekend()->clearId();
//                $em->persist($saisonWeekend);
//                $newSaison->setSaisonWeekend($saisonWeekend);
//            }
//            foreach ($Saison->getArrangements() as $entity)
//                $em->persist($entity->clearId()->setSaison($newSaison));
//            foreach ($Saison->getAutresReductions() as $entity)
//                $em->persist($entity->clearId()->setSaison($newSaison));
//            foreach ($Saison->getAutresSupplements() as $entity)
//                $em->persist($entity->clearId()->setSaison($newSaison));
//            foreach ($Saison->getChambres() as $entity)
//                $em->persist($entity->clearId()->setSaison($newSaison));
//            foreach ($Saison->getSuppChambres() as $entity)
//                $em->persist($entity->clearId()->setSaison($newSaison));
//            foreach ($Saison->getVues() as $entity)
//                $em->persist($entity->clearId()->setSaison($newSaison));
            
            
        }
        return $this->render('BackHotelTunisieBundle:Saisons:generer.html.twig' , array (
                    'hotel' => $hotel ,
                    'form' => $form->createView()
                )) ;
    }

}
