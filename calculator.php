<head>
    <?php 
        require_once "navbar.php";
        require_once "count.php";
        session_unset();
        // print_r($_SESSION);
        $msg = "";
        $ppu = 0.00;
        $_SESSION["userUsage"] = 0;
        if(isset($_POST["calculate"])){
            $totalWatt = $_POST["totalWatt"];
            $totalPrice = $_POST["totalPrice"];
            $ppu = round(pricePerUnit($totalWatt, $totalPrice), 2);
            for($i=1; $i < 4; $i++){
                $curUser = "user".$i;
                $curUsage = $_POST[$curUser."CurUsage"];
                $prvUsage = $_POST[$curUser."PrvUsage"];
                $_SESSION[$curUser."Usage"] = countUsage(floatval($curUsage), floatval($prvUsage));
                $_SESSION[$curUser."Price"] = countPrice($_SESSION[$curUser."Usage"], $ppu);
            }
        }
    ?>
</head>
<body>
    <form method="POST">
        <input type="number" name="totalWatt" placeholder="Total Watt (kWh)" required min=1 step=".01">
        <input type="number" name="totalPrice" placeholder="Total Price (RM)" required min=1 step=".01"><br>
        <?php
            echo "<p style='color:red'>".$msg."</p>";     
            if($ppu != ""){
                echo "<p s'>Price Per Unit: RM ".$ppu."</p>";
            }
        ?>    
        <h2>Dr Alvin</h2>
        <input type="number" name="user1PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
        <input type="number" name="user1CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br>

        <h2>Dr Philbert</h2>
        <input type="number" name="user2PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
        <input type="number" name="user2CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br>

        <h2>Dr Ives</h2>
        <input type="number" name="user3PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
        <input type="number" name="user3CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01">

        <br><br><input type="submit" name="calculate" value="Calculate">
    </form>
    <?php
        if(isset($_SESSION["user3Usage"])){
            for($k=1; $k < 4; $k++){
                $curUser = "user".$k;
                echo "User ".$k." Usage: ".$_SESSION[$curUser."Usage"]." ";
                echo "User ".$k." Price: RM ".round($_SESSION[$curUser."Price"], 2);
                echo "<br>";

                $_SESSION["userUsage"] = $_SESSION["userUsage"] + $_SESSION[$curUser."Usage"];
            }
            $commonArea = countCommonArea($totalWatt, $_SESSION["userUsage"], $ppu);
            echo "Common Area: RM ".$commonArea." per person";
        }
    ?>
</body>
<footer><?php require_once "footer.php"; ?></footer>