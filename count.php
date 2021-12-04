<?php
    $pricePerUnit = 0.00;
    $totalWatt = 0;
    $totalPrice = 0.00;
    $usage = 0.00;
    $price = 0.00;
    $commonArea = 0;

    function pricePerUnit($totalWatt, $totalPrice){ //calculate the price per unit
        return $pricePerUnit = ($totalPrice / $totalWatt);
    }

    function countUsage($curUsage, $prvUsage){ //calculate the usage
            $usage = $curUsage - $prvUsage;
        return number_format((float)$usage, 2, '.', '');
    }

    function countPrice($usage, $pricePerUnit){
        return $price = $usage * $pricePerUnit;
    }

    function countCommonArea($totalUsage, $userUsage, $pricePerUnit){
        return $commonArea = ($totalUsage - $userUsage) * $pricePerUnit;
    }
?>