<?php

namespace KL\UtilBundle\Time;

/**
 * Date range od Zodiacal signs can be different, escpecially of boundary day 
 * 
 * @author kail
 */
class Zodiacal
{
    /**
     * 1 - 12, Capricorn - Sagittarius
     *
     * @access public
     * @param int $month
     * @param int $day
     * @return int
     */
    public function getSign($month, $day)
    {
        if (($month==12 && $day>21) || ($month==1 && $day<20)) {
            return 1; // 12.22 - 1.19
        } else if (($month==1 && $day>19) || ($month==2 && $day<19)) {
            return 2; // 1.20 - 2.18
        } else if(($month==2 && $day>18 ) || ($month==3 && $day<21)) {
            return 3; // 2.19 - 3.20
        } else if(($month==3 && $day>20) || ($month==4 && $day<20)) {
            return 4; // 3.21 - 4.19
        } else if(($month==4 && $day>19) || ($month==5 && $day<21)) {
            return 5; // 4.20 - 5.20
        } else if(($month==5 && $day>20) || ($month==6 && $day<22)) {
            return 6; // 5.21 - 6.21
        } else if(($month==6 && $day>21) || ($month==7 && $day<23)) {
            return 7; // 6.22 - 7.22
        } else if(($month==7 && $day>22) || ($month==8 && $day<23)) {
            return 8; // 7.23 - 8.22
        } else if(($month==8 && $day>22) || ($month==9 && $day<23)) {
            return 9; // 8.23 - 9.22
        } else if(($month==9 && $day>22) || ($month==10 && $day<24)) {
            return 10; // 9.23 - 10.23
        } else if(($month==10 && $day>23) || ($month==11 && $day<23)) {
            return 11; // 10.24 - 11.22
        } else if(($month==11 && $day>22) || ($month==12 && $day<22)) {
            return 12; // 11.23 - 12.21
        }
        
        return 0;
    }
}

?>