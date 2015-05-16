<?php

namespace Back\HotelTunisieBundle\Services ;

class Library
{

    public function getDatesBetween($dStart , $dEnd)
    {
        $iStart = strtotime($dStart) ;
        $iEnd = strtotime($dEnd) ;
        if (false === $iStart || false === $iEnd)
        {
            return false ;
        }
        $aStart = explode('-' , $dStart) ;
        $aEnd = explode('-' , $dEnd) ;
        if (count($aStart) !== 3 || count($aEnd) !== 3)
        {
            return false ;
        }
        if (false === checkdate($aStart[1] , $aStart[2] , $aStart[0]) || false === checkdate($aEnd[1] , $aEnd[2] , $aEnd[0]) || $iEnd <= $iStart)
        {
            return false ;
        }
        for ($i = $iStart ; $i < $iEnd + 86400 ; $i = strtotime('+1 day' , $i))
        {
            $sDateToArr = strftime('%Y-%m-%d' , $i) ;
            $sYear = substr($sDateToArr , 0 , 4) ;
            $sMonth = substr($sDateToArr , 5 , 2) ;
            //$aDates[$sYear][$sMonth][]=$sDateToArr;
            $aDates[] = $sDateToArr ;
        }
        if (isset($aDates) && !empty($aDates))
        {
            return $aDates ;
        }
        else
        {
            return false ;
        }
    }

}
