<?php

namespace Back\HotelTunisieBundle\Controller;

use Back\HotelTunisieBundle\Entity\ConfigurationPayement;
use Back\HotelTunisieBundle\Form\ConfigurationPayementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Back\HotelTunisieBundle\Entity\ConfigurationVoucher;
use Back\HotelTunisieBundle\Form\ConfigurationVoucherType;

class ConfigurationController extends Controller
{

    public function voucherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $config = $em->getRepository("BackHotelTunisieBundle:ConfigurationVoucher")->find(1);
        if (!$config)
            $config = new ConfigurationVoucher ();
        $form = $this->createForm(new ConfigurationVoucherType(), $config);
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $config = $form->getData();
                $em->persist($config);
                $em->flush();
                $session->getFlashBag()->add('success', '  Votre Voucher  a été modifié avec succées');
                return $this->redirect($this->generateUrl("sht_connfiguration_voucher"));
            }
        }
        return $this->render('BackHotelTunisieBundle:Configuration:voucher.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function payementAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $request = $this->getRequest();
        $config = $em->find('BackHotelTunisieBundle:ConfigurationPayement',1);
        if (!$config)
            $config = new ConfigurationPayement() ;
        $form = $this->createForm(new ConfigurationPayementType(), $config);
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $config = $form->getData();
                $em->persist($config);
                $em->flush();
                $session->getFlashBag()->add('success', '  Votre payement  a été modifié avec succées');
                return $this->redirect($this->generateUrl("sht_connfiguration_payement"));
            }
        }
        return $this->render('BackHotelTunisieBundle:Configuration:payement.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
