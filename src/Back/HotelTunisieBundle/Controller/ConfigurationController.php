<?php

namespace Back\HotelTunisieBundle\Controller;

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
        $ConfigVoucher = $em->getRepository("BackHotelTunisieBundle:ConfigurationVoucher")->find(1);
        if (!$ConfigVoucher)
            $ConfigVoucher = new ConfigurationVoucher ();
        $form = $this->createForm(new ConfigurationVoucherType(), $ConfigVoucher);
        if ($request->isMethod('POST'))
        {
            $form->submit($request);
            if ($form->isValid())
            {
                $ConfigVoucher = $form->getData();
                $em->persist($ConfigVoucher);
                $em->flush();
                $session->getFlashBag()->add('success', '  Votre Voucher  a été modifié avec succées');
                return $this->redirect($this->generateUrl("sht_connfiguration_voucher"));
            }
        }
        return $this->render('BackHotelTunisieBundle:Configuration:voucher.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
