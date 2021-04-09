<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style type="text/css">
      /* body{
        background-image: url(image/pattern.);
      } */
      #header{
        background:url("image/watchpattern.jpg") center center/cover no-repeat;
      }
   
    </style>

  <title>Shopping Cart System</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index.php"><i class="fas fa-clock"></i>&nbsp;&nbsp;Watch Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php"><i class="fas fa-mobile-alt mr-2"></i>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-th-list mr-2"></i>Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger">3</span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

  <div class="container" >
 </div>
    <section id="header" class="jumbotron text-center">
      <h1 style=" color: red;" class="display-3"><strong> Watch for Mens</strong></h1>
      <P style=" color: green;" class="lead" style="color: white;"><strong> Nothing is more valuable then time. It's time for a change.</strong></P>

    </section>


  <div class="container">
    <div class="row mt-5 pb-3">
        <?php
            include 'config.php';
            ////selcting the items
            $stmt = $conn->prepare("SELECT*FROM product");
            $stmt->execute();
            //storing the items
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()):
        ?>
        <div class="col-md-3">
                <!-- displaying the image in the home page -->
                <div class="card-deck">
                    <div class="card p-2 border-secondary mb-2">
                        <img src="<?= $row['product_image'] ?>" class="card-img-top" height ="250" >
                        <div class="card-body p-1">
                          <h5 class="card-title text-center text-success"> <?= $row['product_name']?> </h4>
                          <h6 class="card-title text-center text-danger" > <i class="fas fa-dollar-sign">&nbsp;&nbsp;</i><?= $row['product_price'] ?></h6>
                        </div>
                        <div class="card-footer"  >
                          <!-- when clicked on the item its gonna be save to the cart -->
                          <a href="action.php?id=<?= $row['id']?>" class="btn-info btn-block text-center">  <i class="fas fa-cart-plus"></i>&nbsp; Add to Cart </a>
                        </div>
                    </div>
                </div>
        </div>
        <?php endwhile ?>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
 
  </script>
</body>

</html>