<?php

 function autoload_314e0f5eab9b30c729bae00afc4a3e98($class)
{
    $classes = array(
        'ResabookingService' => __DIR__ .'/ResabookingService.php',
        'ArrayOfroom' => __DIR__ .'/ArrayOfroom.php',
        'ArrayOfTraveller' => __DIR__ .'/ArrayOfTraveller.php',
        'Traveller' => __DIR__ .'/Traveller.php',
        'room' => __DIR__ .'/room.php',
        'rooms' => __DIR__ .'/rooms.php',
        'reponse' => __DIR__ .'/reponse.php',
        'ArrayOfhot' => __DIR__ .'/ArrayOfhot.php',
        'ArrayOfchambres' => __DIR__ .'/ArrayOfchambres.php',
        'ArrayOfchambre' => __DIR__ .'/ArrayOfchambre.php',
        'ArrayOfliste_suplement_obligatoire' => __DIR__ .'/ArrayOfliste_suplement_obligatoire.php',
        'liste_suplement_obligatoire' => __DIR__ .'/liste_suplement_obligatoire.php',
        'ArrayOfchamb' => __DIR__ .'/ArrayOfchamb.php',
        'ArrayOfpromotion' => __DIR__ .'/ArrayOfpromotion.php',
        'promotion' => __DIR__ .'/promotion.php',
        'chamb' => __DIR__ .'/chamb.php',
        'chambre' => __DIR__ .'/chambre.php',
        'chambres' => __DIR__ .'/chambres.php',
        'ArrayOfpolicy' => __DIR__ .'/ArrayOfpolicy.php',
        'ArrayOftype_arrangement' => __DIR__ .'/ArrayOftype_arrangement.php',
        'type_arrangement' => __DIR__ .'/type_arrangement.php',
        'policy' => __DIR__ .'/policy.php',
        'hot' => __DIR__ .'/hot.php',
        'hotelliste' => __DIR__ .'/hotelliste.php',
        'ArrayOfequipement' => __DIR__ .'/ArrayOfequipement.php',
        'equipement' => __DIR__ .'/equipement.php',
        'ficheproduit' => __DIR__ .'/ficheproduit.php',
        'chambs' => __DIR__ .'/chambs.php',
        'ArrayOfoption' => __DIR__ .'/ArrayOfoption.php',
        'option' => __DIR__ .'/option.php',
        'options' => __DIR__ .'/options.php',
        'booking' => __DIR__ .'/booking.php',
        'Travellers' => __DIR__ .'/Travellers.php',
        'vol' => __DIR__ .'/vol.php',
        'info_agence' => __DIR__ .'/info_agence.php',
        'book' => __DIR__ .'/book.php',
        'destock' => __DIR__ .'/destock.php',
        'bookingcancel' => __DIR__ .'/bookingcancel.php',
        'comfirmbookingcancel' => __DIR__ .'/comfirmbookingcancel.php',
        'ArrayOfdetail_chambres' => __DIR__ .'/ArrayOfdetail_chambres.php',
        'ArrayOfenfant_age' => __DIR__ .'/ArrayOfenfant_age.php',
        'enfant_age' => __DIR__ .'/enfant_age.php',
        'detail_chambres' => __DIR__ .'/detail_chambres.php',
        'ArrayOfinfo_pass' => __DIR__ .'/ArrayOfinfo_pass.php',
        'info_pass' => __DIR__ .'/info_pass.php',
        'detailreservation' => __DIR__ .'/detailreservation.php',
        'ArrayOfdetailresa' => __DIR__ .'/ArrayOfdetailresa.php',
        'detailresa' => __DIR__ .'/detailresa.php',
        'resbooking' => __DIR__ .'/resbooking.php',
        'reglement_commande' => __DIR__ .'/reglement_commande.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_314e0f5eab9b30c729bae00afc4a3e98');

// Do nothing. The rest is just leftovers from the code generation.
{
}
