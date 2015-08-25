<?php
    namespace Front\ConfigBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Front\ConfigBundle\Entity\SliderSHT;
    use Front\ConfigBundle\Form\SliderSHTType;
    use Front\ConfigBundle\Entity\BlockMetroSHT;
    use Front\ConfigBundle\Form\BlockMetroSHTType;

    class HotelTunisieController extends Controller
    {
        public function sliderAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            if(is_null($id))
                $slider = new SliderSHT();
            else
                $slider = $em->getRepository('FrontConfigBundle:SliderSHT')->find($id);
            $sliders = $em->getRepository('FrontConfigBundle:SliderSHT')->findBy(array(),array('ordre' => 'asc'));
            $form = $this->createForm(new SliderSHTType(),$slider);
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $slider = $form->getData();
                    $em->persist($slider);
                    $em->flush();
                    $session->getFlashBag()->add('success',"Votre slider a été mise a jour avec succès ");
                    return $this->redirect($this->generateUrl("config_front_hoteltunisie_slider"));
                }
            }
            return $this->render('FrontConfigBundle:HotelTunisie:slider.html.twig',array(
                'sliders' => $sliders,
                'form'    => $form->createView(),
            ));
        }

        public function deleteSliderAction(SliderSHT $slider)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($slider);
            $em->flush();
            $session->getFlashBag()->add('success'," Votre slider a été supprimé avec succées ");
            return $this->redirect($this->generateUrl('config_front_hoteltunisie_slider'));
        }

        public function showTopPromoAction()
        {
            $em = $this->getDoctrine()->getManager();
            $hotels = $em->getRepository('BackHotelTunisieBundle:Hotel')->filtreFrontOfficePlus();
            $hotels = $this->removeInvalideHotel($hotels,TRUE);
            return $this->render('FrontConfigBundle:HotelTunisie:showTopPromo.html.twig',array(
                'hotels' => $hotels,
            ));
        }

        public function removeInvalideHotel($hotels,$topPromo = FALSE)
        {
            $newHotels = array();
            foreach($hotels as $hotel){
                if(!is_null($hotel->getSaisonBase()) && $hotel->getSaisonBase()->isValidSaisonBase() && !$hotel->isInStopSales() && $hotel->getEtat() == 1){
                    if(!$topPromo || ($this->get('kernel')->getEnvironment()=='prod' &&  $hotel->getSaisonPromotionByDate(date('Y-m-d'))->getType() == 2))
                        $newHotels[] = $hotel;
                }
            }
            return $newHotels;
        }

        public function blockMetroAction()
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $blockMetro = $em->getRepository('FrontConfigBundle:BlockMetroSHT')->find(1);
            if(!$blockMetro)
                $blockMetro = new BlockMetroSHT();
            $form = $this->createForm(new BlockMetroSHTType(),$blockMetro);
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $blockMetro = $form->getData();
                    $em->persist($blockMetro);
                    $em->flush();
                    $session->getFlashBag()->add('success',"Votre Block metro a été mise a jour avec succès ");
                    return $this->redirect($this->generateUrl("config_front_hoteltunisie_blockmetro"));
                }
            }
            return $this->render('FrontConfigBundle:HotelTunisie:blockMetro.html.twig',array(
                'form'       => $form->createView(),
                'blockMetro' => $blockMetro,
            ));
        }

        public function showBlockMetroAction()
        {
            $em = $this->getDoctrine()->getManager();
            $blockMetro = $em->getRepository('FrontConfigBundle:BlockMetroSHT')->find(1);
            return $this->render('FrontConfigBundle:HotelTunisie:showBlockMetro.html.twig',array(
                'blockMetro' => $blockMetro,
            ));
        }
    }
