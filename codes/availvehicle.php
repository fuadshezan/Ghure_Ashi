<?php 
include('connection.php');
session_start();
if(isset($_GET['tid'])){
    $tid=$_GET['tid'];
    $cin=$_GET['cin']; 
    $cout=$_GET['cout'];

    $sql="SELECT driver_name,hire_rate,v_number,image
            FROM lveh
            WHERE'$tid' LIKE id";

    $returnvalue=$conn->query($sql);
    $t=$returnvalue->fetchALL(PDO::FETCH_NUM);
    $v_nmbr=$t[0][2];
    $dname="Local Vehicle-".$t[0][0];


    $sql="SELECT booking_details 
          FROM booking 
          WHERE ((end_date BETWEEN '$cin' AND '$cout') OR ('$cin' BETWEEN arrival_date AND end_date) OR (arrival_date BETWEEN '$cin' AND '$cout')) AND '$v_nmbr' LIKE booking_details ";

    $returnvalue=$conn->query($sql);
    $r=$returnvalue->fetchALL(PDO::FETCH_NUM);

    $date1=new DateTime($_GET['cin']);
    $date2=new DateTime($_GET['cout']);
    $d=$date1->diff($date2);
    
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <title>Ghure Ashi</title>
</head>

<body>
    <!-- Navbar started -->
      <?php  if(isset($_SESSION['Aname']))
    {
       include("navbar.php");
    } 
    else
    {
        include("navbaru.php");
    } ?>
    
    <!-- Navbar end -->

    <!-- login modal start -->
    <!-- Button trigger modal -->
        <!--login  Modal -->
    <div class="modal fade" id="logineModal" tabindex="-1" role="dialog" aria-labelledby="logineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logineModalLabel">Log In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action=LogSign.php>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="emaill" id="emaill" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter email" />
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="passl" id="passl" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password" />
                        </div>

                        <button type="submit" class="btn btn-primary" name="submitl" id="submitl">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- login modal end -->

    <!-- sign up modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="LogSign.php">
                        <div class="form-group">
                            <label for="username" >Username</label>
                            <input name="name" id="name" type="text" class="form-control" id="username" aria-describedby="usernameHelp"
                                placeholder="Enter Username"  />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" >Email address</label>
                            <input name="email" id="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter email" />
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" >Password</label>
                            <input name="pass" id="pass" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <label for="contactno" >Contact No.</label>
                            <input name="contact" id="contact" type="text" class="form-control" id="contactno" aria-describedby="contactnoHelp"
                                placeholder="Enter Your Contact Number" />
                        </div>
                        
                        <div class="form-group">
                            <label for="address" >Address</label>
                            <input name="address" id="address" type="text" class="form-control" id="contactno" aria-describedby="contactnoHelp"
                                placeholder="Enter Your Contact Number" />
                        </div>
                        
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0" >Gender</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                            value="option1" checked />
                                        <label class="form-check-label" for="gridRadios1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                            value="option2" />
                                        <label class="form-check-label" for="gridRadios2">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- sign up modal end -->


    <!-- show search result -->
   <!-- show search result -->
   <?php
    if(count($r)>0)
    {?>
        <div class="container my-5">
        <div class="text-center" style="margin: 240px;">
            <h2 class="featurette-heading">Sorry Vehicle "<?php echo $t[0][0] ?>" is Not Available </h2>
        </div>
    </div>
    <?php
    }
    else
    {
        
        ?>
            <!-- show search result -->
    <div class="container my-5">
        <div class="row featurette d-flex justify-content-center align-items-center">
            <div class="col-md-7 order-md-1">
                <h2 class="featurette-heading"><?php echo $t[0][0] ?> </h2>
                <h4><span class="text-muted">Status: Available</span></h4>
                <p class="lead">Total: <?php $total=$d->format('%d')*(int)$t[0][1]; echo $total; ?> BDT</p>
                <form class="form-inline">
                    <div class="form-group mb-2">
                    </div>
                    <?php if(isset($_SESSION['email'])){?>
                    <a href="checkout.php?cin=<?php echo $cin ?>&cout=<?php echo $cout?> &hid=<?php echo $tid?> &rnmbr=<?php echo $t[0][2]?>&hname=<?php echo $dname?>&price=<?php echo $total?>"><button type="button" class="btn btn-primary mb-2 ">Book Now</button></a>
                    <!-- <a href="checkout.php?price=<?php echo $total?>"><button type="button" class="btn btn-primary mb-2 ">Book Now</button></a> -->
                <?php } 
                else{?>
                    <button type="button" class="btn btn-primary mb-2 " onclick="showAlert()">Book Now</button>
                <?php }
                ?>
                </form>
            </div>
            <div class="col-md-5 order-md-2">
                <?php echo '<img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                    height="500" src="data:image/jpeg;base64,'.base64_encode( $t[0][3] ).'"alt=""  style="border:5px solid black"/>';?>
            </div>
        </div>
    </div>
    <!-- show search result end -->
     <?php   
    }
    ?>
    


    <!-- footer start -->
    <section>
        <footer class="mt-3">
            <div class="containerf fb">
                <div class="sec aboutus">
                    <h2>About Us</h2>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa dolores debitis, modi animi
                        excepturi delectus porro doloribus consequatur, architecto nihil asperiores iste vero cupiditate
                        facere sequi vel! Doloremque, eveniet consequatur? Sapiente culpa maxime cupiditate facilis
                        nihil nemo itaque repellat beatae aliquam? Eveniet perspiciatis praesentium unde quae qui eos
                        accusantium beatae!</p>
                    <ul class="sci">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="sec quicklinks">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacr Policy</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact </a></li>
                    </ul>
                </div>
                <div class="sec contact">
                    <h2>Contact Info</h2>
                    <ul class="info">
                        <li>
                            <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <span>GA-32/2 Shahzadpur Gulshan-1 Dhaka-1200<br>Bangladesh</span>
                        </li>
                        <li>
                            <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                            <p><a href="tel:88017112233">+88 01723 456 789</a></p>
                        </li>
                        <li>
                            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <p><a href="mailto:knowmore@email.con">knowmore@email.com</a></p>
                        </li>

                    </ul>

                </div>
            </div>
        </footer>
        <div class="copyright">
            <p>Copyright @ 2020 Ghure Ashi team. All Rights Reserved.</p>
        </div>
    </section>

    <!-- footer end -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <script>
  function showAlert() {
    var myText = "You are not logged in.Please login First.";
    alert (myText);
  }
  </script>
</body>

</html>