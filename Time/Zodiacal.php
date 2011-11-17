<?php

namespace KL\UtilBundle\Time;

/**
 *
 * @class Zodiacal
 *
 * @copyright Copyright (C) 2008 PHPRO.ORG. All rights reserved.
 * @license new bsd http://www.opensource.org/licenses/bsd-license.php
 *
 * @package zodiacal
 *
 * @Author Kevin Waterson
 */
class Zodiacal{

    /*
     * @array blocks
     */
    private $blocks;

    /*
     * @constructor - set a few properties
     */
    public function __construct()
    {
        $this->blocks = array(
        13=>356,
        12=>326,
        11=>296,
        10=>266,
        9=>235,
        8=>203,
        7=>172,
        6=>140,
        5=>111,
        4=>78,
        3=>51,
        2=>20,
        1=>0);
    }

    /*
     *
     * @set day number
     *
     * @access private
     *
     * @param int $month
     * @param int $day
     *
     * @return it
     *
     */
    private function _getDayNumber($month, $day)
    {
        /*** get the day number ***/
        $num = getdate(mktime(2, 0, 0, $month, $day));
        return $num['yday'];
    }


    /*
     *
     * @Get Zodiac Star Sign
     *
     * @access public
     * @param int $month
     * @param int $day
     * @return int
     */
    public function getSign($month, $day)
    {
        $day_num = $this->_getDayNumber($month, $day);
        /*** loop through the day blocks ***/
        foreach ($this->blocks as $key=>$value) {
            if ($day_num>=$value)
            break;
        }
        /*** dont forget capricorn ***/
        $key = ($key>12) ? 1 : $key;
        return $key;
    }
}

?>