<?php
    function pricePerUnit($totalWatt, $totalPrice){
        $pricePerUnit = ($totalPrice / $totalWatt);
        return number_format((float)$pricePerUnit, 2, '.', '');
    }

    function calculatePrice($watt, $pricePerUnit) {
        $price = $watt * $pricePerUnit;
        return number_format((float)$price, 2, '.', '');
    }
?>