<?php

namespace Back\VoyageOrganiseBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class VoyageOrganiseRepository extends EntityRepository
{

    public function filtre($themes='all',$destination='all',$pays='all',$name='all',$sort='v.libelle',$direction='asc')
    {
	$query = $this->createQueryBuilder('v');
	$query->where($query->expr()->isNotNull('v.id'));
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
		$query->join('v.themes', 't');
	    $orX = $query->expr()->orX();
	    $themes = explode(',', $themes);
	    foreach ($themes as $theme)
		$orX->add($query->expr()->eq("t.id", $theme));
	    $query->andWhere($orX);
	}
	if ($pays != 'all')
	{
		$query->join('v.pays', 'p');
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
	$query->orderBy($sort, $direction);
	return $query->getQuery()->getResult();
    }

}
