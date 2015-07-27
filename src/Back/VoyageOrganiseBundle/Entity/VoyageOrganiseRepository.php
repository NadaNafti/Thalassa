<?php

namespace Back\VoyageOrganiseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VoyageOrganiseRepository extends EntityRepository
{

    public function filtre($themes='all',$destination='all',$pays='all',$name='all',$orderBy='v.libelle',$direction='asc')
    {
	$query = $this->createQueryBuilder('v');
	$query->join('v.pays', 'p');
	$query->join('v.themes', 't');
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
	if ($themes != 'all')
	{
	    $orX = $query->expr()->orX();
	    $themes = explode(',', $themes);
	    foreach ($themes as $theme)
		$orX->add($query->expr()->eq("t.id", $theme));
	    $query->andWhere($orX);
	}
	if ($pays != 'all')
	{
	    $orX = $query->expr()->orX();
	    $pays = explode(',', $pays);
	    foreach ($pays as $pay)
		$orX->add($query->expr()->eq("p.id", $pay));
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
	$query->orderBy($orderBy, $direction);
	return $query->getQuery()->getResult();
    }

}
