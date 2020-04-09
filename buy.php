<?php
session_start();
$product_identifier = array();
//session_destroy();




if(filter_input(INPUT_POST,'add_to_cart')){
  if(isset($_SESSION['shopping_cart'])){
    $count = count($_SESSION['shopping_cart']);
    $product_identifier = array_column($_SESSION['shopping_cart'], 'produceID');

     //before_printr($product_identifier);
    if(!in_array(filter_input(INPUT_GET, 'produceID'),$product_identifier)){
      $_SESSION['shopping_cart'][$count] = array
        (
          'produceID' => filter_input(INPUT_GET, 'produceID'), 
          'NAME' => filter_input(INPUT_POST, 'produceName'),
          'price' => filter_input(INPUT_POST, 'price' ),
          'qunatity '=> filter_input(INPUT_POST, 'quantity'),
          
        );
    }
    else{
      for ($i = 0; $i < count($product_identifier); $i++){
        if($product_identifier[$i] == filter_input(INPUT_GET, 'produceID')){
            $_SESSION['shopping_cart'][$i]['quantity'] = $_SESSION['shopping_cart'][$i]['quantity'] + filter_input(INPUT_POST, 'quantity');
        }
        
      }
    }
  }
  else{
    $_SESSION['shopping_cart'][0] = array
    (
      'produceID' => filter_input(INPUT_GET, 'produceID'), 
      'NAME' => filter_input(INPUT_POST, 'produceName'),
      'price' => filter_input(INPUT_POST, 'producePrice' ),
      'qunatity '=> filter_input(INPUT_POST, 'quantity'),
    );
  }
}
before_printr($_SESSION);
function before_printr($array){
  echo '<pre>';
  
  print_r($array);
  echo '<pre>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BIBI ORGANIC FARM</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
  <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->


  <!-- Custom styles for this template -->
  <link href="css/agency.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">BIBI FARM</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#products">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> 

  <!-- Header -->
   <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">Welcome To Bibi Farm!</div>
        <div class="intro-heading text-uppercase">HOME OF FRESH ORGANIC PRODUCE</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#products">Shop With Us</a>
      </div>
    </div> 
  </header> 


 <div class="container">
<div class="row">


 

<?php



include('connect.php');
$sql = "SELECT * FROM PRODUCE ORDER BY produceID ASC";
$result = mysqli_query($conn, $sql);
if ($result):
  if(mysqli_num_rows($result)>0):
    while($product = mysqli_fetch_assoc($result)):
      ?>
       <div class="col-sm-4 col-md-3">

       
        <form action="buy.php?action=add&produceID=<?php echo $product['produceID'];?>" method="POST" style='padding-top:5px;'>
        <div class="products" style='padding:10px;'>
           
        <img src="<?php echo"".$product['img'];?>" style="width:100%; height:auto; display:block;  margin:auto;" />
          <h4  class=text-info>  <?php echo $product['produceName'];?> </h4>
          <h4> ksh <?php echo $product['producePrice'];?> </h4>
          <input type="text" name="quantity" class='form-control' value='1'>
          <input type="hidden" name="name" value=" <?php echo $product['produceName'];?>" />
          <button type="submit" name='add_to_cart' class="btn btn-info" value="Add to Cart" style='margin-top:10px; margin-bottom:10px;'>purchase </button>
    </div>
      </form>
      </div>
      
      
<?php
    endwhile;
  endif;
endif;
  

?>
</div>
</div>
<div class="" style='clear':both></div>
<br>
<div class="table-responsive">
  <table class="table">
    <tr><th colspan='5'><h3>Details</h3></th></tr>
    <tr>
      <th width='40%'>Poduce Name</th>
      <th width='7%'>Quantity</th>
      <th width='20%'>Price</th>
      <th width='12%'>Total</th>
    </tr>

    <?php
            //$query = "SELECT * FROM PRODUCE ORDER BY produceID ASC ";
           // $result = mysqli_query($conn,$query);
            //$row = mysqli_fetch_array($result);
                if(!empty($_SESSION["shopping_cart"])){
                    $total = 0;
                    foreach ($_SESSION["shopping_cart"] as $key => $produce) {
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
                  }
                        ?>

  </table>
</div>

    

<!-- calculation -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/agency.min.js"></script>

  

</body>

</html>
