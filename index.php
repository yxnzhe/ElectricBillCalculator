<!DOCTYPE HTML>
<html>
    <head>
        <title>Electricity Bill Calculator</title>
        <?php
            require_once "count.php";
            require_once "navbar.php"; 
            $msg = "";
            $wattPerUnit = 0.0;
            if(isset($_POST["calculatePPU"])){
                $totalWatt = $_POST["totalWatt"];
                $totalPrice = $_POST["totalPrice"];
                if($totalWatt == "" || $totalPrice == ""){
                    $msg = "All fields are mandatory!";
                }
                else if($totalWatt == 0 || $totalPrice == 0) {
                    $msg = "Zero kennot be accepted!";
                }
                else{
                    $wattPerUnit = pricePerUnit($totalWatt, $totalPrice);
                    // print_r($_POST);
                    // echo "Total price :: ".$totalPrice;
                    // echo "Total watt :: ".$totalWatt;
                }
            }
        ?>
    </head>
    <body>
         <form method="POST">
            <input type="number" name="totalWatt" placeholder="Total Watt (kWh)" required min=1>
            <input type="number" name="totalPrice" placeholder="Total Price (RM)" required min=1><br>
            <br><input type="submit" name="calculatePPU" value="Calculate PPU">
            <?php
                echo "<p style='color:red'>".$msg."</p>";   
                if(isset($_POST["calculatePPU"])) {
                    echo "<p>Price Per Unit: RM ".$wattPerUnit."</p>";
                }
            ?>    
        </form>
        <form method="POST">
            <h2>Dr Alvin</h2>
            <input type="hidden" name="user1" value="alvin" readonly>
            <input type='number' name='alvinPrev' placeholder="Dr Alvin Previous" required>
            <input type='number' name='alvinCurr' placeholder="Dr Alvin Current" required><br>
            <?php if(isset($_POST["calculate"])){
                $alvinPrev = $_POST["alvinPrev"];
                $alvinCurr = $_POST["alvinCurr"];
                $alvinUsage = $alvinCurr - $alvinPrev;
                $alvinPrice = calculatePrice($alvinUsage, $wattPerUnit);
                echo "Usage: ".$alvinUsage." kWh";
                echo "Price: RM ".$alvinPrice;
            }?>
            
            <h2>Dr Philbert</h2>
            <input type="hidden" name="user2" value="philbert" readonly>
            <input type='number' name='philbertPrev' placeholder="Dr Philbert Previous" required>
            <input type='number' name='philbertCurr' placeholder="Dr Philbert Current" required><br>
            <?php if(isset($_POST["calculate"])){
                $philbertPrev = $_POST["philbertPrev"];
                $philbertCurr = $_POST["philbertCurr"];
                $philbertUsage = $philbertCurr - $philbertPrev;
                $philbertPrice = calculatePrice($philbertUsage, $wattPerUnit);
                echo "Usage: ".$philbertUsage." kWh";
                echo "Price: RM ".$philbertPrice; 
            }?>

            <h2>Dr Ives</h2>
            <input type="hidden" name="user3" value="ives" readonly>
            <input type='number' name='ivesPrev' placeholder="Dr Ives Previous" required>
            <input type='number' name='ivesCurr' placeholder="Dr Ives Current" required><br>
            <?php if(isset($_POST["calculate"])){ 
                $ivesPrev = $_POST["ivesPrev"];
                $ivesCurr = $_POST["ivesCurr"];
                $ivesUsage = $ivesCurr - $ivesPrev;
                $ivesPrice = calculatePrice($ivesUsage, $wattPerUnit);
                echo "Usage: ".$ivesUsage." kWh";
                echo "Price: RM ".$ivesPrice;
            }?>

            <br><br><input type='submit' name='reset' value='Reset'>
            <input type='submit' name='calculate' value='Calculate'>
        </form>
    </body>
    <footer><?php require_once "footer.php"; ?></footer>
</html>