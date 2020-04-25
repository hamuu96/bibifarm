<?php 
session_start();
//session_destroy();
include('connect.php');

//if user in not logged in they are redirected to the login page
if(empty($_SESSION['username'])){
	header('Location:login.php');
}
//when user is inactive for more than 30 mins he is redirected back to the login page
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} 
else if (time() - $_SESSION['CREATED'] > 1800) {
    session_regenerate_id(true);    
    $_SESSION['CREATED'] = time();  
	header('Location:login.php');
	unset($_SESSION['CREATED']);
}

if(isset($_POST["add"]))
{
	if(isset($_SESSION["Shopping_Cart"]))
	{
		$item_array_id = array_column($_SESSION["Shopping_Cart"], "produce_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["Shopping_Cart"]);
			$item_array = array(
				'produce_id'			=>	$_GET["id"],
				'name'				=>	$_POST["hidden_name"],
				'produce_price'		=>	$_POST["hidden_price"],
				'produce_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["Shopping_Cart"][$count] = $item_array;
			
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'produce_id'			=>	$_GET["id"],
			'name'				=>	$_POST["hidden_name"],
			'produce_price'		=>	$_POST["hidden_price"],
			'produce_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["Shopping_Cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["Shopping_Cart"] as $keys => $values)
		{
			if($values["produce_id"] == $_GET["id"])
			{
				unset($_SESSION["Shopping_Cart"][$keys]);
				?>
				<div class="alert alert-success" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
			item removed from cart
			</div>
			<?php
			}
		}
	}
}
if(!empty($_SESSION["Shopping_Cart"]))
{
	if(isset($_POST['check'])){
		header('Location:checkout.php');
	}
		}
else{
	?>
	<div class="alert alert-danger" role="alert" style='margin-top:20px; text-align:center; text-transform:uppercase;'>
 please add item to cart before checking out
</div>
<?php
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bibs farm</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        .produce{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
			padding-top:10px;
        }
        .cart{
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
		<h2>BIBS PRODUCE CART</h2>
			<?php
				$query = "SELECT * FROM PRODUCE ORDER BY produceID ASC";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
				
			<div class="col-md-3">
				<form method="post" action="buy.php?action=add&id=<?php echo $row["produceID"]; ?>">
				<div class="produce">
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
			<div style="clear:both"></div>
			<br />
			<h3 class="cart">CART</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="33%">Product Name</th>
                <th width="15%">Quantity</th>
                <th width="14%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="19%">Remove Item</th>
            </tr>
					<?php
					if(!empty($_SESSION["Shopping_Cart"]))
					{
						$total = 0;
						foreach($_SESSION["Shopping_Cart"] as $keys => $values)
						{
					
					?>
					<tr>
						<td><?php echo $values["name"]; ?></td>
						<td><?php echo $values["produce_quantity"]; ?></td>
						<td>$ <?php echo $values["produce_price"]; ?></td>
						<td>$ <?php echo number_format($values["produce_quantity"] * $values["produce_price"], 2);?></td>
						<td><a href="buy.php?action=delete&id=<?php echo $values["produce_id"]; ?>"><span class="text-danger">Remove</span></a></td>
						
					</tr>
					<?php
					$_SESSION['itemName'] = $values['name'];
							$total = $total + ($values["produce_quantity"] * $values["produce_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>

					</tr>
					
					<?php
					}
					// global $list;
					

					//trying insert data to database after buy button is pressed 
					if(!empty($_SESSION["Shopping_Cart"]))
					{
						if(isset($_POST['buy'])){
							$total = 0;
							foreach($_SESSION["Shopping_Cart"] as $keys => $values)
							{
							$userid=$_SESSION['userid'];
							$produceid=$values["produce_id"];
							$produceName=$values["name"];
							$Quantity=$values["produce_quantity"];
							$Total=$values["produce_price"]*$Quantity;
							$username=$_SESSION['username'];
								$query = "INSERT INTO SALES(userid,produceid,produceName,Quantity,Total,username)
							VALUES('$userid','$produceid','$produceName','$Quantity','$Total','$username')";
							$result = mysqli_query($conn,$query); 
							// unset($_SESSION["Shopping_Cart"]);
							}
						}
				}
					?>
						
				</table>
				<form action="buy.php" method="post">
				<button class="btn btn-primary" type="submit" name='buy'>buy produce</button>
				<button class="btn btn-success" type="submit" style='margin-left:20px;' name='check'>check out</button>
				</form>
				
			</div>
		</div>
	</div>
	<br />
	</body>
</html>
