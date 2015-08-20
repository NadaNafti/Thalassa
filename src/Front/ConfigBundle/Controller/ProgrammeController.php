<?php
    namespace Front\ConfigBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Front\ConfigBundle\Entity\SliderPR;
    use Front\ConfigBundle\Form\SliderPRType;
    use Front\ConfigBundle\Entity\BlockMetroPR;
    use Front\ConfigBundle\Form\BlockMetroPRType;
    use Front\ConfigBundle\Entity\TopProgramme;
    use Front\ConfigBundle\Form\TopProgrammeType;

    class ProgrammeController extends Controller
    {
        public function sliderAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            if(is_null($id))
                $slider = new SliderPR();
            else
                $slider = $em->getRepository('FrontConfigBundle:SliderPR')->find($id);
            $sliders = $em->getRepository('FrontConfigBundle:SliderPR')->findBy(array(),array('ordre' => 'asc'));
            $form = $this->createForm(new SliderPRType(),$slider);
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $slider = $form->getData();
                    $em->persist($slider);
                    $em->flush();
                    $session->getFlashBag()->add('success',"Votre slider a été mise a jour avec succès ");
                    return $this->redirect($this->generateUrl("front_config_programme_slider"));
                }
            }
            return $this->render('FrontConfigBundle:Programme:slider.html.twig',array(
                'sliders' => $sliders,
                'form'    => $form->createView(),
            ));
        }

        public function deleteSliderAction(SliderPR $slider)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($slider);
            $em->flush();
            $session->getFlashBag()->add('success'," Votre slider a été supprimé avec succées ");
            return $this->redirect($this->generateUrl('front_config_programme_slider'));
        }

        public function blockMetroAction()
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $blockMetro = $em->getRepository('FrontConfigBundle:BlockMetroPR')->find(1);
            if(!$blockMetro)
                $blockMetro = new BlockMetroPR();
            $form = $this->createForm(new BlockMetroPRType(),$blockMetro);
            $request = $this->getRequest();
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $blockMetro = $form->getData();
                    $em->persist($blockMetro);
                    $em->flush();
                    $session->getFlashBag()->add('success',"Votre Block metro a été mise a jour avec succès ");
                    return $this->redirect($this->generateUrl("front_config_programme_blockmetro"));
                }
            }
            return $this->render('FrontConfigBundle:Programme:blockMetro.html.twig',array(
                'form'       => $form->createView(),
                'blockMetro' => $blockMetro,
            ));
        }

        public function showBlockMetroAction()
        {
            $em = $this->getDoctrine()->getManager();
            $blockMetro = $em->getRepository('FrontConfigBundle:BlockMetroPR')->find(1);
            return $this->render('FrontConfigBundle:Programme:showBlockMetro.html.twig',array(
                'blockMetro' => $blockMetro,
            ));
        }

        public function showTopThemeAction()
        {
            $em = $this->getDoctrine()->getManager();
            $topProgrammes = $em->getRepository('FrontConfigBundle:TopProgramme')->findAll();
            return $this->render('FrontConfigBundle:Programme:showTopTheme.html.twig',array(
                'topProgrammes' => $topProgrammes,
            ));
        }

        public function topProgrammeAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $request = $this->getRequest();
            if(is_null($id))
                $topProgramme = new TopProgramme();
            else
                $topProgramme = $em->getRepository('FrontConfigBundle:TopProgramme')->find($id);
            $topProgrammes = $em->getRepository('FrontConfigBundle:TopProgramme')->findBy(array(),array('id' => 'asc'));
            $form = $this->createForm(new TopProgrammeType(),$topProgramme);
            if($request->isMethod('POST')){
                $form->submit($request);
                if($form->isValid()){
                    $slider = $form->getData();
                    $em->persist($topProgramme);
                    $em->flush();
                    $session->getFlashBag()->add('success',"Votre Top Programme a été mise a jour avec succès ");
                    return $this->redirect($this->generateUrl("front_config_programme_topprogramme"));
                }
            }
            return $this->render('FrontConfigBundle:Programme:topProgramme.html.twig',array(
                'topProgrammes' => $topProgrammes,
                'form'          => $form->createView(),
            ));
        }

        public function topProgrammeDeleteAction(TopProgramme $topProgramme)
        {
            $em = $this->getDoctrine()->getManager();
            $session = $this->getRequest()->getSession();
            $em->remove($topProgramme);
            $em->flush();
            $session->getFlashBag()->add('success'," Votre Top Programme a été supprimé avec succées ");
            return $this->redirect($this->generateUrl('front_config_programme_topprogramme'));
        }
    }
