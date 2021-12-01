<?php
    $pricePerUnit = 0.00;
    $totalWatt = 0;
    $totalPrice = 0.00;

    function pricePerUnit($totalWatt, $totalPrice){
        return $pricePerUnit = ($totalPrice / $totalWatt);
    }
?>