<?php

include('connect.php');


if(isset($_POST['register'])){
  $firstname = $_POST['fname'];
  $lastname = $_POST['lname'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = $_POST['phone'];
  $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); 
  $address = $_POST['address'];
  $username = $_POST['username'];







  


//check if any registration fields are empty
if($firstname != '' and $lastname != '' and $email != '' and $password !=''  and $username !=''  and $address !=''  and $phone !=''){

  //check if the username exists in the database
        $sql1  = mysqli_query($conn, "SELECT * FROM  CUSTOMER  WHERE username='$username' ");
            if ($sql1){
              $count = mysqli_num_rows($sql1);
              if($count>=1)
                {
                echo"name already exists";
              }
              else
                {
                  //if username does not exist thry are added into the website
                  $sql = "INSERT INTO CUSTOMER (firstname, lastname, phoneNo, email, c_address, username, password)
                 VALUES ( '$firstname', '$lastname', '$phone', '$email', '$address', '$username', '$password')";
                  $exec = mysqli_query($conn, $sql);
                  
                  // echo 'successful'.mysqli_error($conn);
                   header('Location:login.php');
                }

            }
            else{
              echo 'error'.mysqli_error($conn);
            }
                   
       
}
else{
  ?>
    <div class="alert alert-danger" role="alert" >
  please fill the form
</div>
<?php
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bibs farm</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method='post' action='register.php'>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name='fname'>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name='lname'>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name='email'>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Username " name='username'>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Address" name='address'>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Telephone No " name='phone'>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="password" name='password'>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-user btn-block btn-dark" name='register'>Register </button> 
                <hr>
               
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
