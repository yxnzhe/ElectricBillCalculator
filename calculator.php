<head>
    <?php 
        require_once "navbar.php";
        require_once "count.php";
        session_unset();
        // print_r($_SESSION);
        $msg = "";
        $pricePerUnit = 0.00;
        $_SESSION["userUsage"] = 0;
        if(isset($_POST["calculate"])){
            $totalWatt = $_POST["totalWatt"];
            $totalPrice = $_POST["totalPrice"];
            $pricePerUnit = round(pricePerUnit($totalWatt, $totalPrice), 2);
            for($i=1; $i < 4; $i++){
                $curUser = "user".$i;
                $_SESSION[$curUser."Name"] = $_POST[$curUser."Name"];
                $curUsage = $_POST[$curUser."CurUsage"];
                $prvUsage = $_POST[$curUser."PrvUsage"];
                $_SESSION[$curUser."Usage"] = countUsage(floatval($curUsage), floatval($prvUsage));
                $_SESSION[$curUser."Price"] = countPrice($_SESSION[$curUser."Usage"], $pricePerUnit);
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
            if($pricePerUnit != 0.00){
                echo "<p s'>Price Per Unit: RM ".$pricePerUnit."</p>";
            }
        ?>    
        <!-- <h2>Dr Alvin</h2> -->
        <input type="text" name="user1Name" placeholder="User Name" required><br><br>
        <input type="number" name="user1PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
        <input type="number" name="user1CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br>

        <!-- <h2>Dr Philbert</h2> -->
        <input type="text" name="user2Name" placeholder="User Name" required><br><br>
        <input type="number" name="user2PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
        <input type="number" name="user2CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br>

        <!-- <h2>Dr Ives</h2> -->
        <input type="text" name="user3Name" placeholder="User Name" required><br><br>
        <input type="number" name="user3PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
        <input type="number" name="user3CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01">

        <br><br><input type="submit" name="calculate" value="Calculate">
    </form>
    <?php
        if(isset($_SESSION["userUsage"])){
            for($k=1; $k < 4; $k++){
                $curUser = "user".$k;
                echo $_SESSION[$curUser."Name"]." Usage: ".$_SESSION[$curUser."Usage"].", ";
                echo $_SESSION[$curUser."Name"]." Price: RM ".round($_SESSION[$curUser."Price"], 2);
                echo "<br>";

                $_SESSION["userUsage"] = $_SESSION["userUsage"] + $_SESSION[$curUser."Usage"];
            }
            $commonArea = countCommonArea($totalWatt, $_SESSION["userUsage"], $pricePerUnit);
            echo "Total Common Area: RM ".$commonArea;
            echo "<br>Common Area per person: RM ".($commonArea/3);
        }
    ?>
</body>
<footer><?php require_once "footer.php"; ?></footer>