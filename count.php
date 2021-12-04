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
        return $usage = $curUsage - $prvUsage;
    }

    function countPrice($usage, $ppu){
        return $price = $usage * $ppu;
    }

    function countCommonArea($totalUsage, $userUsage){
        return $commonArea = $totalUsage - $userUsage;
    }
?>