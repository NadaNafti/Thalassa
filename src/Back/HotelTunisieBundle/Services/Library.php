<?php

namespace Back\HotelTunisieBundle\Services;

class Library
{

    public function getDatesBetween($dStart, $dEnd)
    {
        $iStart=strtotime($dStart);
        $iEnd=strtotime($dEnd);
        if(false === $iStart || false === $iEnd)
        {
            return false;
        }
        $aStart=explode('-', $dStart);
        $aEnd=explode('-', $dEnd);
        if(count($aStart) !== 3 || count($aEnd) !== 3)
        {
            return false;
        }
        if(false === checkdate($aStart[1], $aStart[2], $aStart[0]) || false === checkdate($aEnd[1], $aEnd[2], $aEnd[0]) || $iEnd < $iStart)
        {
            return false;
        }
        for($i=$iStart; $i < $iEnd + 86400; $i=strtotime('+1 day', $i))
        {
            $sDateToArr=strftime('%Y-%m-%d', $i);
            $sYear=substr($sDateToArr, 0, 4);
            $sMonth=substr($sDateToArr, 5, 2);
            //$aDates[$sYear][$sMonth][]=$sDateToArr;
            $aDates[]=$sDateToArr;
        }
        if(isset($aDates) && !empty($aDates))
        {
            return $aDates;
        }
        else
        {
            return false;
        }
    }

    public function verifSuppReducDate($suppReduc, $date1, $date2)
    {
        $dates=$this->getDatesBetween($date1->format('Y-m-d'), $date2->format('Y-m-d'));
        $dates2=$this->getDatesBetween($date1->format('Y').'-'.$suppReduc->getMoisDebut().'-'.$suppReduc->getJourDebut(), $date1->format('Y').'-'.$suppReduc->getMoisFin().'-'.$suppReduc->getJourFin());
        foreach($dates as $date)
        {
            foreach($dates2 as $date2)
            {
                if($date == $date2)
                    return true;
            }
        }
        return false;
    }

    public function verifIntersectionDate($date, $dateDebut, $dateFin)
    {
        foreach($this->getDatesBetween($dateDebut, $dateFin) as $d)
        {
            if($d == $date)
                return true;
        }
        return false;
    }

    public function getNbrNuittes($debutRes, $finRes, $debut, $fin)
    {
        $i=0;
        foreach($this->getDatesBetween($debutRes, $finRes) as $date)
        {
            if($this->verifIntersectionDate($date, $debut, $fin))
                $i++;
        }
        return $i;
    }

}
