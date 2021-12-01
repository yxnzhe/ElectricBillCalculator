<!DOCTYPE HTML>
<html>
    <head>
        <title>Electricity Bill Calculator</title>
        <?php
            require_once "count.php";
            require_once "navbar.php"; 
            $msg = "";
            $result = "";
            if(isset($_POST["calculatePPU"])){
                $totalWatt = $_POST["totalWatt"];
                $totalPrice = $_POST["totalPrice"];
                if($totalWatt == "" || $totalPrice == ""){
                    $msg = "All fields are mandatory!";
                }
                else{
                    $result = pricePerUnit($totalWatt, $totalPrice);
                }
            }
        ?>
    </head>
    <body>
        <!-- <form method="POST">
            <input type="number" name="totalWatt" placeholder="Total Watt (kWh)" required min=1>
            <input type="number" name="totalPrice" placeholder="Total Price (RM)" required min=1><br>
            <br><input type="submit" name="calculatePPU" value="Calculate PPU">
            <?php
                // echo "<p style='color:red'>".$msg."</p>";     
                // if($result != ""){
                //     echo "<p s'>Price Per Unit: RM ".$result."</p>";
                // }
            ?>    
        </form> -->
    </body>
    <footer><?php require_once "footer.php"; ?></footer>
</html>