<?php

class Zend_View_Helper_Sconto extends Zend_View_Helper_Abstract
{
    public function sconto($offerta){
        $sconto = $offerta->tipologia;
        if(preg_match('/[0-9](x|[0-9])[0-9]/',$sconto)){
           $array = str_split($sconto);
           $val1 = intval($array[0]);
           $val2 = intval($array[2]);
           if($val1>$val2){
               $p_scontato = round($offerta->prezzo *($val2/$val1),2);
           }else if($val2>$val1){
               $p_scontato = round($offerta->prezzo *($val1/$val2),2);
           }
        }else{
        preg_replace('/[0-9]{1,2}/', '', $sconto);
        $sconto = intval($sconto);
        $p_scontato = round($offerta->prezzo *(1 -($sconto/100)),2);
        }
        $string = '<p><b>Prezzo scontato: </b>'.$p_scontato.'€</p>';
        return $string ;
    }
}

