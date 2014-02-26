<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of timeHelper
 *
 * @author trocha
 */
class timeHelper {
    
        static function toHoursMinutes($total_minutes) { 
        $mins = $total_minutes % 60;
        if ($mins == 0) $mins = '0'.$mins; //adds a zero, so it doesn't return 08:0, but 08:00
        $hour = floor($total_minutes / 60);
        return $hour . 'H ' . $mins . 'm';
    }
    
        static function yes_Or_no($true){
            $string = ($true ? 'Yes' : 'No');
            return $string;
        }
}
