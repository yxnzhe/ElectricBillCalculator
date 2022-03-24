<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php 
        require_once "navbar.php";
        require_once "count.php";
        session_unset();
        // print_r($_SESSION);
        $msg = "";
        $pricePerUnit = 0.00;
        $_SESSION["userUsage"] = 0;
        $totalAmount = 0;
        $totalUsage = 0;
        $pax = 3; //total users
        if(isset($_POST["calculate"])){
            $totalWatt = $_POST["totalWatt"];
            $totalPrice = $_POST["totalPrice"];
            $pricePerUnit = round(pricePerUnit($totalWatt, $totalPrice), 2);
            $_SESSION["startDate"] = $_POST["startDate"];
            $_SESSION["endDate"] = $_POST["endDate"];
            for($i = 1; $i < 4; $i++){
                $curUser = "user".$i;
                $_SESSION[$curUser."Name"] = $_POST[$curUser."Name"];
                $curUsage = $_POST[$curUser."CurUsage"];
                $prvUsage = $_POST[$curUser."PrvUsage"];
                $_SESSION[$curUser."Usage"] = countUsage(floatval($curUsage), floatval($prvUsage));
                $_SESSION[$curUser."Price"] = countPrice($_SESSION[$curUser."Usage"], $pricePerUnit);
                $_SESSION["userUsage"] = $_SESSION["userUsage"] + $_SESSION[$curUser."Usage"];
            }
            $commonArea = countCommonArea(floatval($totalWatt), floatval($_SESSION["userUsage"]), floatval($pricePerUnit));
        }
    ?>
</head>
<body>
<div class="stepper d-flex flex-column mt-3 ml-2">
    <form method="POST" class="ml-3">
    <br>
    <div class="d-flex mb-1">
      <div class="d-flex flex-column pr-4 align-items-center">
        <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">1</div>
        <div class="line h-100"></div>
      </div>
      <div>
        <h5 class="text-dark">Enter Your Total Consumption, Total Price & Date</h5>
        <p class="lead text-muted pb-3">You can find the Total Consumtion(kWh) & Price on Your Bill</p>
      </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Total Consumption (kWh)</label>
        <div class="col-sm-6">
            <input class="form-control" type="number" name="totalWatt" placeholder="Total Watt (kWh)" required min=1 step=".01">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Total Price</label>
        <div class="col-sm-6">
            <input class="form-control" type="number" name="totalPrice" placeholder="Total Price (RM)" required min=1 step=".01">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Date (mm/dd/yyyy)</label>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-5 col-sm-5">
                    <input class="form-control" type="date" name="startDate" placeholder="Start Date">
                </div>
                <h5 class="text-dark col-1 col-sm-1" style="margin:auto">Until</h5>
                <div class="col-5 col-sm-5">
                    <input class="form-control" type="date" name="endDate" placeholder="End Date">
                </div>
            </div>
        </div>
    </div>
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
        <!-- <h2>User 1</h2> -->
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">User's Name</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" name="user1Name" placeholder="User's Name" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">User Current and Previous Usage</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" name="user1PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
                <input class="form-control" type="number" name="user1CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br>
            </div>
        </div>

        <!-- <h2>Dr Philbert</h2> -->
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">User's Name</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" name="user2Name" placeholder="User's Name" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">User Current and Previous Usage</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" name="user2PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
                <input class="form-control" type="number" name="user2CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br>
            </div>
        </div>

        <!-- <h2>Dr Ives</h2> -->
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">User's Name</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" name="user3Name" placeholder="User's Name" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">User Current and Previous Usage</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" name="user3PrvUsage" placeholder="Previous Usage (kWh)" required min=1 step=".01">
                <input class="form-control" type="number" name="user3CurUsage" placeholder="Current Usage (kWh)" required min=1 step=".01"><br><br>
            </div>
        </div>

        <input class="btn btn-danger btn-outline-warning" type="submit" name="calculate" value="Calculate Bill">
    </form>
  </div>
  <div class="d-flex mb-1 ml-4 ">
        <div class="d-flex flex-column pr-4 align-items-center">
            <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">3</div>
            <div class="line h-100"></div>
        </div>
        <div class="col-md-11">
            <h5 class="text-dark">Usages :</h5>
            <p class="lead text-muted pb-3">
            <?php if(isset($_SESSION["user3Usage"])){ ?>
                <div class="container">
                    <table class="table align-self-center">
                    <?php 
                        echo "<p class=".'text-info'.">Price Per Unit: RM ".$pricePerUnit."</p>";
                        if(isset($commonArea)){
                            echo "<p class=".'text-info'.">Total Common Area: RM ".round(($commonArea / $pax), 2)."</p>";
                        }
                        ?>
                        <thead>
                            <tr>
                                <td colspan="5" style="text-align: center"><b>From &nbsp</b> <?php echo $_SESSION["startDate"]?> <b>&nbsp Until &nbsp</b> <?php echo $_SESSION["endDate"] ?></td>
                            </tr>
                            <tr>
                                <?php
                                date_default_timezone_set("Asia/Kuala_Lumpur");
                                echo "<td colspan='5' style='text-align: right'><b>Bill Calculated On</b> &nbsp".date('d-M-Y')."</td>";
                                ?>
                            </tr>
                            <tr>
                                <th scope="col">UserName</th>
                                <th scope="col">Usage (kWh)</th>
                                <th scope="col">Room Price (RM)</th>
                                <th scope="col">Common Area Price (RM)</th>
                                <th scope="col">Total Price (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(isset($_SESSION["user3Usage"])){
                                for($k = 1; $k < 4; $k++){
                                    $curUser = "user".$k;
                                    $totalAmount += round($_SESSION[$curUser."Price"] + ($commonArea / $pax), 2); 
                                    $totalUsage += $_SESSION[$curUser."Usage"];
                                    echo "<tr>";
                                        echo "<td>".$_SESSION[$curUser."Name"]."</td>";
                                        echo "<td>".$_SESSION[$curUser."Usage"]."</td>";
                                        echo "<td>RM ".round($_SESSION[$curUser."Price"], 2)."</td>";
                                        echo "<td>RM ".round(($commonArea / $pax), 2)."</td>";
                                        echo "<td>RM ".round($_SESSION[$curUser."Price"] + ($commonArea / $pax), 2)."</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            <tr><td></td></tr>
                            <tr>
                                <th>Total</th>
                                <td><b><?php echo $totalUsage; ?> kWh<b></td>
                                <td></td>
                                <td></td>
                                <td><b>RM <?php echo $totalAmount; ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </p>
            <?php } ?>
        </div>
    </div>
</body>
<footer><?php require_once "footer.php"; ?></footer>