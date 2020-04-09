<?php

include('connect.php');
    session_start();
    //session_destroy();



    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"produceID");
            if (!in_array($_GET["produceID"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["produceID"],
                    'item_name' => $_POST["produceName"],
                    'product_price' => $_POST["producePrice"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="test.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="test.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["produceID"],
                    'item_name' => $_POST["produceName"],
                    'product_price' => $_POST["producePrice"],
                    'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $PRODUCE){
                if ($produce["produceID"] == $_GET["produceID"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="test.php"</script>';
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
</head>
<body>

    <div class="container" style="width: 65%">
        <h2>Shopping Cart</h2>
        <?php
            $query = "SELECT * FROM PRODUCE ORDER BY produceID ASC ";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0) {
               
                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-md-3">

                        <form method="get" action="test.php?action=add&id=<?php echo $row["produceID"]; ?>">
  
                            <div class="product">
                                <img src="<?php echo $row["img"]; ?>" class="img-responsive">
                                <h5 class="text-info"><?php echo $row["produceName"]; ?></h5>
                                <h5 class="text-danger"><?php echo $row["producePrice"]; ?></h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["produceName"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["producePrice"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                                       value="Add to Cart">
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>

        <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>

            <?php
            //$query = "SELECT * FROM PRODUCE ORDER BY produceID ASC ";
           // $result = mysqli_query($conn,$query);
            //$row = mysqli_fetch_array($result);
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $produce) {
                        print_r($PRODUCE);
                        ?>
                        <tr>
                            <td><?php echo $produce["produceID"]; ?></td>
                            <td><?php echo $produce["quantity"]; ?></td>
                            <td>$ <?php echo $produce["producePrice"]; ?></td>
                            <td>
                                $ <?php echo number_format($produce["quantity"] * $produce["producePrice"], 2); ?></td>
                            <td><a href="test.php?action=delete&id=<?php echo $produce["produceID"]; ?>"><span
                                        class="text-danger">Remove Item</span></a></td>

                        </tr>
                        <?php
                        // $total +=($PRODUCE["quantity"] * $PRODUCE["producePrice"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <th align="right">$ <?php echo number_format($total, 2); ?></th>
                            <td></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>

    </div>


</body>
</html>