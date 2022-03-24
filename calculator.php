<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
<script>
        //ajax
        function add_number(e) {
        if (isNumberKey(e)) {
            setTimeout(() => {
            var totalWatt = document.getElementById("totalWatt").value !== "" ? parseInt(document.getElementById("totalWatt").value) : 1;
            var totalPrice = document.getElementById("totalPrice").value !== "" ? parseInt(document.getElementById("totalPrice").value) : 1;
            if(totalPrice||totalWatt < 0){
                var result = totalPrice / totalWatt;
            }else{
                var result = "ERROR";
            }
            console.log(result);
            document.getElementById("ppu").value = result;
            }, 50)
            return true;
        } else {
            return false;
        }
        }

        function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
        }
</script>

<div class="stepper d-flex flex-column mt-3 ml-2">
    <form method="POST" class="ml-3">
    <br>
    <div class="d-flex mb-1">
      <div class="d-flex flex-column pr-4 align-items-center">
        <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">1</div>
        <div class="line h-100"></div>
      </div>
      <div>
        <h5 class="text-dark">Enter Your Total Consumption & Total Price</h5>
        <p class="lead text-muted pb-3">You can find the Total Consumtion(kWh) & Price on Your Bill</p>
      </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Total Consumption (kWh)</label>
        <div class="col-sm-6">
        <input class="form-control" type="text" name="totalWatt" id="totalWatt" placeholder="Total Watt (kWh)" required min=1 step=".01" onkeypress="return add_number(event)">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Total Price</label>
        <div class="col-sm-6">
        <input class="form-control" type="text" name="totalPrice" id="totalPrice" placeholder="Total Price (RM)" required min=1 step=".01" onkeypress="return add_number(event)"><br>
        </div>
    </div>
        <?php
            echo "<p style='color:red'>".$msg."</p>";     
        ?>
        <h5 class="text-info">Price Per Unit: RM 
        <input class="text-info" type="text" id="ppu" disabled style="border:0">
        </h5>
        <br>
        <div class="d-flex mb-1">
            <div class="d-flex flex-column pr-4 align-items-center">
                <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">2</div>
                <div class="line h-100"></div>
            </div>
            <div>
                <h5 class="text-dark">Enter Your User's Name With thier Previous and Current Readings of the meter</h5>
                <p class="lead text-muted pb-3">You can get the Readings from the meter.</p>
            </div>
        </div>
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

        <br><br><input class="btn btn-danger btn-outline-warning" type="submit" name="calculate" value="Calculate Bill">
    </form>
  </div>
  <div class="d-flex mb-1 ml-4">
        <div class="d-flex flex-column pr-4 align-items-center">
            <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">3</div>
            <div class="line h-100"></div>
        </div>
        <div>
            <h5 class="text-dark">Usages :</h5>
            <p class="lead text-muted pb-3">
    <?php
        if(isset($_SESSION["user3Usage"])){
            $pax = 3; //total pax
            $t=time();
            echo "<p class=".'text-info'.">Price Per Unit: RM ".$pricePerUnit."</p>";
            echo("Date <br>");
            echo(date("Y-m-d",$t));
            echo("<br>");
            for($k=1; $k < 4; $k++){
                $curUser = "user".$k;
                echo $_SESSION[$curUser."Name"]." Usage: ".$_SESSION[$curUser."Usage"].", ";
                echo $_SESSION[$curUser."Name"]." Price: RM ".round($_SESSION[$curUser."Price"], 2);
                echo "<br>";
                $_SESSION["userUsage"] = $_SESSION["userUsage"] + $_SESSION[$curUser."Usage"];
            }
            $commonArea = countCommonArea(floatval($totalWatt), floatval($_SESSION["userUsage"]), floatval($pricePerUnit));
            echo "Total Common Area: RM ".round($commonArea, 2);
            echo "<br>Common Area per person: RM ".round(($commonArea / $pax), 2);
        }
    ?>
    </p>
        </div>
    </div>
</body>
<footer><?php require_once "footer.php"; ?></footer>