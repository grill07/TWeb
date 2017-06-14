<?php

class Zend_View_Helper_Sconto extends Zend_View_Helper_Abstract
{
    public function sconto($offerta){
        $sconto = $offerta->tipologia;
        if(preg_match('/[0-9]x[0-9]/',$sconto)){
           $array = str_split($sconto);
           $val1 = intval($array[0]);
           $val2 = intval($array[2]);
           if($val1>$val2){
               $p_scontato = round($offerta->prezzo *($val2/$val1),2);
           }else if($val2>$val1){
               $p_scontato = round($offerta->prezzo *($val1/$val2),2);
           }
        }else if(preg_match('/[0-9]{1,2}/',$sconto)){
        preg_replace('/[0-9]{1,2}/', '', $sconto);
        $sconto1 = intval($sconto);
        $p_scontato = round($offerta->prezzo *(1 -($sconto1/100)),2);
        }
        if(preg_match('/[0-9][0-9][0-9]/',$sconto) || preg_match('/[0-9]x%/',$sconto) || preg_match('/[0-9]%x/',$sconto)){
            $p_scontato = 'Sconto non riconosciuto';
        }
        return $p_scontato ;
    }
}

