<?php 
session_start();
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



if(isset($_POST['customercare'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message =  $_POST['message'];

  
  //validation check if all fields have data inserted 

  if($name != '' and $email != '' and $subject != '' and $message !=''){
    $sql = "INSERT INTO CARE(name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    
    //timeout before code execution
   
    $exec = mysqli_query($conn, $sql);
    if (!$exec){
      echo 'error'.mysqli_error($conn);
    }


  }

}

if(isset($_POST['logout'])){
  unset($_SESSION['username']);
  session_destroy();
  header('Location:main.php');
  
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
          <li class="nav-item">
            <form action="alogin.php" method="post"> 
              
            <button type="submit" class=" nav-link btn btn-primary btn-user btn-dark" name='logout'>logout </button> 
          </form>
            
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

  <!-- Services -->
  <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Services</h2>
          <h3 class="section-subheading text-muted">This are some of the produces that awe offer at the moment.</h3>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">E-Commerce</h4>
          <p class="text-muted">We are the leading producer and transporter of organic produces in more than 20 counties in kenya.We also have clients from outside of Kenya:<br><b>Tanzania , Uganda and Somalia</b></p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Deliverry</h4>
          <p class="text-muted">We offer delivery serivces for clients who are locally and also internationally.For an extra cost agreed between you and the management you can get access to thi service</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Produce booking</h4>
          <p class="text-muted">we allow our clients to be able to buy produce ahead of time before they are harvested.This allows customers to plan ahead of time and also arrange for transport costs if they want</p>
        </div>
      </div>
    </div>
  </section>

  <!-- products Grid -->
  <section class="bg-light page-section" id="products">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">products</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-6 products-item">
          <a class="products-link" data-toggle="modal" href="#productsModal1">
            <div class="products-hover">
              <div class="products-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="images/produces/onion.jpg" alt="">
          </a>
          <div class="products-caption">
            <h4>Onions</h4>
            <!-- <p class="text-muted"></p> -->
          </div>
        </div>
        <div class="col-md-4 col-sm-6 products-item">
          <a class="products-link" data-toggle="modal" href="#productsModal2">
            <div class="products-hover">
              <div class="products-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="images/produces/tomato1.jpg" alt="">
          </a>
          <div class="products-caption">
            <h4>Tomatoes</h4>
            <!-- <p class="text-muted">Graphic Design</p> -->
          </div>
        </div>
        <div class="col-md-4 col-sm-6 products-item">
          <a class="products-link" data-toggle="modal" href="#productsModal3">
            <div class="products-hover">
              <div class="products-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="images/produces/hoho2.jpg" alt="">
          </a>
          <div class="products-caption">
            <h4>Green Bell Pepers</h4>
            <!-- <p class="text-muted">Identity</p> -->
          </div>
        </div>
        <div class="col-md-4 col-sm-6 products-item">
          <a class="products-link" data-toggle="modal" href="#productsModal4">
            <div class="products-hover">
              <div class="products-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="images/produces/watermelon1.jpg" alt="">
          </a>
          <div class="products-caption">
            <h4>Watermelon</h4>
            <!-- <p class="text-muted"></p> -->
          </div>
        </div>
        <div class="col-md-4 col-sm-6 products-item">
          <a class="products-link" data-toggle="modal" href="#productsModal5">
            <div class="products-hover">
              <div class="products-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="images/produces/peper.jpg" alt="">
          </a>
          <div class="products-caption">
            <h4>pepers</h4>
            <p class="text-muted">Website Design</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 products-item">
          <a class="products-link" data-toggle="modal" href="#productsModal6">
            <div class="products-hover">
              <div class="products-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="images/produces/avacado.jpg" alt="">
          </a>
          <div class="products-caption">
            <h4>Avacado</h4>
            <!-- <p class="text-muted">Photography</p> -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">About Us</h2>
          <h3 class="section-subheading text-muted">This is a brief history about out company</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <ul class="timeline">
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="img/about/1.jpg" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4>2015-2016</h4>
                  <h4 class="subheading">Beginning Of The Farm</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">This was the period when we starting the farm and experimenting on the produces that were going to be produced</p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="img/about/2.jpg" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4>2017</h4>
                  <h4 class="subheading">The Farm Gains tranction</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">After so many tiresome months of experimenting we got the produces that we thought were in demand in the local area at the time</p>
                </div>
              </div>
            </li>
            <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="img/about/3.jpg" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4>June 2018</h4>
                  <h4 class="subheading">Popularity of the farm</h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted">We became the number on producer of oragnic produce in the local area and now started gaining popularity in other counties in the country and start doing bussiness there</p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="img/about/4.jpg" alt="">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4>internationally Recognized</h4>
                  
                </div>
                <div class="timeline-body">
                  <p class="text-muted">we became now internationally recognized and were exporting produces to other contries</p>
                </div>
              </div>
            </li>
            <li class="timeline-inverted">
              <div class="timeline-image">
                <h4>Expecting 
                  <br>in the coming
                  <br>years!</h4>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="bg-light page-section" id="team">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="images/produces/user.png" alt="">
            <h4>Kay Garland</h4>
            <p class="text-muted">Lead Designer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="images/produces/user.png" alt="">
            <h4>Larry Parker</h4>
            <p class="text-muted">Lead Marketer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="images/produces/user.png" alt="">
            <h4>Diana Pertersen</h4>
            <p class="text-muted">Lead Developer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <p class="large text-muted"></p>
        </div>
      </div>
    </div>
  </section>


  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contact Us</h2>
          <h3 class="section-subheading text-muted">send us feedback</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form  id="" method='post' action='alogin.php'>
            <div class="row">
              <div class="col-md-6">
                
                <div class="form-group">
                  <input class="form-control" id="name" name='name'type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                  
                </div>
                <div class="form-group">
                  <input class="form-control" id="email"  name='email' type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                  
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" name='subject' type="tel" placeholder="Your Title *" required="required" data-validation-required-message="Please enter your Title.">
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" name='message' placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                  
                </div>
              </div>
              
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" name='customercare' type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Your Website 2019</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- products Modals -->

  <!-- Modal 1 -->
  <div class="products-modal modal fade" id="productsModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">Onion</h2>
                
                <p>The red onions are mostly large to medium size and has a mellow test.The red onions are mostly consumed in three methods: <br> <em>lightly cooked, grilled and sometimes raw</em></p>
                
                <a href="buy.php" class='btn btn-primary'>buy produce</a>
                                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 2 -->
  <div class="products-modal modal fade" id="productsModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">Tomatoe</h2>
                <p>Tomatoes are normally  rounded, large, edible, pulpy berry of an herb of the nightshade family native to South America that is typically red but may be yellow, orange, green, or purplish in color and is eaten raw or cooked as a vegetable</p>
                  
                <div>
                <a href="buy.php" class='btn btn-primary'>buy produce</a>
                                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 3 -->
  <div class="products-modal modal fade" id="productsModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">Green bell pepers</h2>
                <p>A fresh, crisp green bell pepper is a tasty vegetable that can be a regular part of your healthy eating plan. This vegetable is low in calories and contains 0 grams of fat and a good supply vitamins and minerals. Their mildly sweet flavor makes green bell peppers versatile enough to include a wide variety of nutritious recipes.<br><br> bell pepers have the following benefits:</p>
                <ul class="list-inline">
                  <li>Rich in Fibre</li>
                  <li>Vitamin E</li>
                  <li>Vitamin C</li>
                </ul>
                 
                <div>
                <a href="buy.php" class='btn btn-primary'>buy produce</a>
                                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 4 -->
  <div class="products-modal modal fade" id="productsModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">Watermelon</h2>
                <p>Watermelons are mostly water about 92 percent but this refreshing fruit is soaked with nutrients. Each juicy bite has significant levels of vitamins A, B6 and C, lots of lycopene, antioxidants and amino acids. There's even a modest amount of potassium. Plus, this quintessential summer snack is fat-free, very low in sodium and has only 40 calories per cup. </p>
                
                
                <div>
                <a href="buy.php" class='btn btn-primary'>buy produce</a>
                                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 5 -->
  <div class="products-modal modal fade" id="productsModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">Pepers</h2>
                <p>Peppers are the dried unripe fruit grown in the plant called piper nigrum. It's pungent smell, peppery/hot taste and health friendly properties make pepper a favorite spice all over the world and it is commonly used in all cuisines.</p>
                
               
                <div>
                <a href="buy.php" class='btn btn-primary'>buy produce</a>
                                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 6 -->
  <div class="products-modal modal fade" id="productsModal6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">Avacado</h2>              
                <p>Avocados are commercially valuable and are cultivated in tropical and Mediterranean climates throughout the world.They have a green-skinned,
                   fleshy body that may be pear-shaped, egg-shaped, or spherical. Commercially, they ripen after harvesting. Avocado trees are partially self-pollinating, 
                   and are often propagated through grafting to maintain predictable fruit quality and 
                  quantity. In 2017, Mexico produced 34% of the world supply of avocados.</p>
                   
                  <div>
                  <a href="buy.php" class='btn btn-primary'>buy produce</a>
                                      
                  </div>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
