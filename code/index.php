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

  <link rel="stylesheet" href="index.css">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">

  <title>Shopping Cart System</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-lg navbar navbar-dark" style="background-color:#420606;">
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
                <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

  <div class="container" >
 </div>
    <section id="header" class="jumbotron text-center">
      <h1 style=" text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; color:grey; font-family: 'Dela Gothic One', cursive;" class="display-3"><strong> WATCHES FoR MEN</strong></h1><br>
      <P  class="lead" style=" text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; color:firebrick; font-family: 'Dela Gothic One', cursive;" ><strong> Nothing is more valuable then time.   It's time for a change.</strong></P>

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
                          <form action="" class="form-submit">
                            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                            <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                            <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                            <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                            <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                            <button class="btn-info btn-block text-center addItemBtn" > <i class="fas fa-cart-plus"></i>&nbsp; Add to Cart</button>
                          </form>
                          <!-- when clicked on the item its gonna be save to the cart -->
                        </div>
                    </div>
                </div>
        </div>
        <?php endwhile ?>
    </div>

    <br>
    <br>
    
    <!-- contact btn -->
    <div class="float-right" > 
      <a href="contact.php" class="btn btn-primary ">Contact Us</a>
  </div>


  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>
