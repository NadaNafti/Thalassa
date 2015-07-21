<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VoyageOrganiseRepository extends EntityRepository
{

    public function filtre($destination='all',$name='all')
    {
	$query = $this->createQueryBuilder('v');
	$query->where('v.finInscription >= :date')->setParameter('date', date('Y-m-d'));
	$query->andWhere('v.nbrInscriptions < v.nbrInscriptionsMax');
	if ($destination != 'all')
	{
	    $orX = $query->expr()->orX();
	    $destinations = explode(',', $destination);
	    foreach ($destinations as $dest)
		$orX->add($query->expr()->eq("v.destination", $dest));
	    $query->andWhere($orX);
	}
	if ($name != 'all')
	{
	    $orX = $query->expr()->andX();
	    $name = explode('+', $name);
	    foreach ($name as $mot)
	    {
		if($mot!='')
		    $orX->add( $query->expr()->like("UPPER(v.libelle)", "UPPER('%" . $mot . "%')"));
	    }
	    $query->andWhere($orX);
	}
	$query->orderBy("v.libelle", 'asc');
	return $query->getQuery()->getResult();
    }

}
