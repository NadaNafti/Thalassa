<?php
    namespace Front\ConfigBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Front\ConfigBundle\Entity\Slider;
    use Front\ConfigBundle\Form\SliderType;

    class AccueilController extends Controller
    {
        public function sliderAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            if(is_null($id))
                $slider = new Slider();
            else
                $slider = $em->getRepository('FrontConfigBundle:Slider')->find($id);
            $sliders = $em->getRepository('FrontConfigBundle:Slider')->findBy(array(),array('ordre' => 'asc'));
            $form = $this->createForm(new SliderType(),$slider);
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $slider = $form->getData();
                    $em->persist($slider);
                    $em->flush();
                    $session->getFlashBag()->add('success',"Votre slider a été mise a jour avec succès ");
                    return $this->redirect($this->generateUrl("config_front_accueil_slider"));
                }
            }
            return $this->render('FrontConfigBundle:Accueil:slider.html.twig',array(
                'sliders' => $sliders,
                'form'    => $form->createView(),
            ));
        }

        public function deleteSliderAction(Slider $slider)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($slider);
            $em->flush();
            $session->getFlashBag()->add('success'," Votre slider a été supprimé avec succées ");
            return $this->redirect($this->generateUrl('config_front_accueil_slider'));
        }

    }
