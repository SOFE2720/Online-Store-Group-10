
<?php

$mysqli = new mysqli('localhost','root','','ratings');

if(isset($_POST['rating'])){
  $email = $_POST['email'];
  $rating = $_POST['rating'];
  $feedback = $_POST['feedback'];
  $query = "Insert into feedback(rating, feedback, email) VALUE(?,?,?)";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('iss',$rating,$feedback,$email);
  $stmt->execute();
  $msg="<div class='alert alert-success'>Rating Successfully Added </div>";
  $stmt->close();  
}

function getAverageRating(){
  global $mysqli;
  $query = "select avg(rating) as avg from feedback";
            $stmt = $mysqli->prepare($query);
            if($stmt->execute()){
              $result= $stmt->get_result();
              if($result->num_rows>0){
                $row=$result->fetch_assoc();
                return $row['avg'];
              }
            }
}


?>


<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/bee7cd2ded.js" crossorigin="anonymous"></script>

    <style type="text/css">


      
      .card-img, .card-img-top{
        border-top-style: dashed;
      }
      *{
        margin: 0;
        padding: 0;
      }
      html, body {margin: 0 }

      #contact{
          color:green;
      }

      body{
        background:url("image/pattern2.jpg") center center/cover no-repeat;
      }
   

    </style>
    <title>Contact</title>
    
  </head>
  <body>

      <!-- Navbar start -->
  <nav class="navbar navbar-expand-lg navbar navbar-dark" style="background-color: #4d1919;">
    <a class="navbar-brand" href="index.php"><i class="fas fa-clock"></i>&nbsp;&nbsp;Watch Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-mobile-alt mr-2"></i>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-th-list mr-2"></i>Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->


    <div class="container">
  </div>

    <section id="header" class="jumbotron text-center">
      <h1 class="display-3">Watch For Mens<br>CONTACT</h1>
      <P class="lead" style="color: rgb(5, 66, 8);"> Nothing is more valuable then time. It's time for a change</P>
      <a href="index.php" class="btn btn-primary ">Find Items</a>
      <H3>Any Question? Feel free to reach any of our stuff below</H3>
    </section>

    <section id="gallery">
      <div class="container ">
        <div class="row">
          <div class="col-sm-4  mb-3 ">

        <div class="card" id="contact">
          <div class="card-body">
            <h5 class="card-title">Krishna Biswa(100755321)</h5>
            <p class="card-text">balkrishna.biswa@ontariotechu.net <br> 647-555-5555</p>
            
          </div>
        </div>
       </div>

      

       <div class="col-sm-4  mb-3 " id="contact">
        <div class="card">
          <div class="card-body" >
            <h5 class="card-title">Sehaj Behl(100748987)</h5>
            <p class="card-text"> /////////// <br> /////// </p>
     
          </div>
          
        </div>
       </div>

        <div class="col-sm-4 mb-3" id="contact">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Thashon Sirkan.. (100625757)</h5>
            <p class="card-text">/////////// <br> ///////</p>

          </div>
        </div>


       </div>
       </div>
       </div>
      </div>
    </section>

    </div>
    <div style="background-color:white" class="container">
      <div class="row">
        <div class="col-md-12 col-md-offset-3">
        <br><br>
        <h2>You can leave feedbacks here</h2><hr>
        <?php 
          if(isset($msg)){
            echo $msg;
          }

        
        ?>

          <form action="" method="post">
            <div class="form-group">
              <label for="">Rating</label>
              <div id="rateYo"></div>
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <label for="">Feedback</label>
              <input type="text" class="form-control" name="feedback">
              <input type="hidden" name="rating" id="rating">
            </div>
            <button class="btn btn-primary">Submit</button>
          </form>
          <hr>
          <h2>User Feedback</h2>
          Average: <div id="avgrating"></div>
         
          <hr>
          <?php
            $query = "select * from feedback";
            $stmt = $mysqli->prepare($query);
            if($stmt->execute()){
              $result= $stmt->get_result();
              if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                  // echo $row['email'].'<br>'.$row['rating'].'<br>'.$row['feedback'].'<br>';
          ?>
                <div class="media">
                  <img class="mr-3" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1762ca10d8f%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1762ca10d8f%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                  <div class="media-body">
                    <h5 class="media-heading"> <div class="rateYo-<?php echo $row['id']; ?>"></div></h5>
                   
                   <script>
                    /* Javascript */
                    $(function () {
                      $(".rateYo-<?php echo $row['id']; ?>").rateYo({
                        readOnly:true,
                        rating:<?php echo $row['rating']; ?>,
                        
                      });
                    });
                  </script>

                    <?php echo $row['feedback'] ?><br>
                    By: <?php echo $row['email']; ?>
                  </div>
                </div>



            <?php

                }
              }
            }
           ?>
           <br><br>


        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
  /* Javascript */

  $(function () {
    $("#rateYo").rateYo({
      fullStar:true,
      onSet:function(rating, rateYoinstance){
        $("#rating").val(rating);
      }
    });

    $("#avgrating").rateYo({
      readOnly:true,
      rating:' <?php echo getAverageRating(); ?>'
    });
  });


  





</script>


  </body>
</html>
</html>