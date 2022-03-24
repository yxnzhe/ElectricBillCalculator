<head>
    <?php require_once "navbar.php"; ?>
</head>
<body>
    <h1>Buy us a Coffee</h1>
    <div class="container col-sm-9" style="text-align: center">
        <form method="POST">
            <select name="paymentOption" id="payment" class="btn border col-sm-2 align=center">
                <option value="tng">TnG</option>
                <option value="maybank">Maybank</option>
            </select><br><br>
            <input type="submit" class="btn btn-success col-sm-2" name="payment" value="Confirm">
        </form>
        <?php 
        if(isset($_POST["payment"])){
            $selected = $_POST["paymentOption"];
            if($selected == "tng"){
                $img = "./imgs/tng.jpg";
                $alt = "Touch n Go QR Code";
            }
            else if($selected == "maybank"){
                $img = "./imgs/mae.jpg";
                $alt = "Maybank QR Code";
            }
            echo "<img src='".$img."' width=500 alt='".$alt."'>";
        }
        ?>
    </div>
</body>
<footer><?php require_once "footer.php"; ?></footer>