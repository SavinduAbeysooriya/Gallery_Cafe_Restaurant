<?php
@include 'includes/dbh.inc.php';

if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query to get the product details along with any associated promotion (Full Outer Join)
    $query = "SELECT p.name AS name, 
                     p.image AS image, 
                     p.price AS price, 
                     promo.PromotionName AS PromotionName, 
                     promo.Image AS Image, 
                     promo.PromotionPrice AS PromotionPrice
              FROM products p
              LEFT JOIN promotions promo ON p.id = promo.id
              WHERE p.id = $product_id
              
              UNION
              
              SELECT p.name AS name, 
                     p.image AS image, 
                     p.price AS price, 
                     promo.PromotionName AS PromotionName, 
                     promo.Image AS Image, 
                     promo.PromotionPrice AS PromotionPrice
              FROM promotions promo
              LEFT JOIN products p ON p.id = promo.id
              WHERE promo.id = $product_id";  // You might want to filter promotions as needed

    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Set the variables for the product details
        $food_name = $row['name'];
        $food_image = $row['image'];
        $food_price = $row['price'];

        // Set the variables for promotion details if they exist
        $promotion_name = $row['PromotionName'];
        $promotion_image = $row['Image'];
        $promotion_price = $row['PromotionPrice'];
    } else {
        echo "Product not found!";
        $food_name = $food_image = $food_price = ''; // Default values to avoid undefined variable issues
        $promotion_name = $promotion_image = $promotion_price = ''; // Default values for promotion
    }
} else {
    echo "No product selected!";
    $food_name = $food_image = $food_price = ''; // Default values to avoid undefined variable issues
    $promotion_name = $promotion_image = $promotion_price = ''; // Default values for promotion
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

<style>
    
/* CSS for All */
*{
    margin: 0 0;
    padding: 0 0;
    font-family: Arial, Helvetica, sans-serif;
}
.container{
    width: 80%;
    margin: 0 auto;
    padding: 1%;
}
.img-responsive{
    width: 100%;
}
.img-curve{
    border-radius: 15px;
}

.text-right{
    text-align: right;
}
.text-center{
    text-align: center;
}
.text-left{
    text-align: left;
}
.text-white{
    color: white;
}

.clearfix{
    clear: both;
    float: none;
}

a{
    color: #ff6b81;
    text-decoration: none;
}
a:hover{
    color: #ff4757;
}

.btn{
    padding: 1%;
    border: none;
    font-size: 1rem;
    border-radius: 5px;
}
.btn-primary{
    background-color: #ff6b81;
    color: white;
    cursor: pointer;
}
.btn-primary:hover{
    color: white;
    background-color: #ff4757;
}
h2{
    color: #2f3542;
    font-size: 2rem;
    margin-bottom: 2%;
}
h3{
    font-size: 1.5rem;
}
.float-container{
    position: relative;
}
.float-text{
    position: absolute;
    bottom: 50px;
    left: 40%;
}
fieldset{
    border: 1px solid white;
    margin: 5%;
    padding: 3%;
    border-radius: 5px;
}


/* CSSS for navbar section */
.logo{
    width: 10%;
    float: left;
}
.menu{
    line-height: 60px;
}
.menu ul{
    list-style-type: none;
}

.menu ul li{
    display: inline;
    padding: 1%;
    font-weight: bold;
}


/* CSS for Food SEarch Section */
.food-search{
    background-image: url(bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    padding: 7% 0;
}

.food-search input[type="search"]{
    width: 50%;
    padding: 1%;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
}


/* CSS for Categories */
.categories{
    padding: 4% 0;
}

.box-3{
    width: 28%;
    float: left;
    margin: 2%;
}


/* CSS for Food Menu */
.food-menu{
    background-color: #ececec;
    padding: 4% 0;
}
.food-menu-box{
    width: 43%;
    margin: 1%;
    padding: 2%;
    float: left;
    background-color: white;
    border-radius: 15px;
}

.food-menu-img{
    width: 20%;
    float: left;
}

.food-menu-desc{
    width: 70%;
    float: left;
    margin-left: 8%;
}

.food-price{
    font-size: 1.2rem;
    margin: 2% 0;
}
.food-detail{
    font-size: 1rem;
    color: #747d8c;
}


/* CSS for Social */
.social ul{
    list-style-type: none;
}
.social ul li{
    display: inline;
    padding: 1%;
}

/* for Order Section */
.order{
    width: 50%;
    margin: 0 auto;
}
.input-responsive{
    width: 96%;
    padding: 1%;
    margin-bottom: 3%;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
}
.order-label{
    margin-bottom: 1%; 
    font-weight: bold;
}

/* CSS for Mobile Size or Smaller Screen */

@media only screen and (max-width:768px){
    .logo{
        width: 80%;
        float: none;
        margin: 1% auto;
    }

    .menu ul{
        text-align: center;
    }

    .food-search input[type="search"]{
        width: 90%;
        padding: 2%;
        margin-bottom: 3%;
    }

    .btn{
        width: 91%;
        padding: 2%;
    }

    .food-search{
        padding: 10% 0;
    }

    .categories{
        padding: 20% 0;
    }
    h2{
        margin-bottom: 10%;
    }
    .box-3{
        width: 100%;
        margin: 4% auto;
    }

    .food-menu{
        padding: 20% 0;
    }

    .food-menu-box{
        width: 90%;
        padding: 5%;
        margin-bottom: 5%;
    }
    .social{
        padding: 5% 0;
    }
    .order{
        width: 100%;
    }
}

.btn-back {
    padding: 10px 20px;
    background-color: #ff6b81;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    display: inline-block;
}

.btn-back:hover {
    background-color: #ff4757;
    color: white;
}

/* CSS for Promotion Menu */
.promotion-menu-img {
    width: 20%; /* Same as food image */
    float: left; /* Aligns left */
}

.promotion-menu-desc {
    width: 70%; /* Same width for description */
    float: left; /* Aligns left */
    margin-left: 8%; /* Same margin as food description */
}

.promotion-price {
    font-size: 1.2rem; /* Consistent font size */
    margin: 2% 0; /* Margin consistent with food price */
}

.order-label {
    margin-bottom: 1%; 
    font-weight: bold; /* Keep order label consistent */
}


    </style>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="—restaurant logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="homepage.php">Home</a>
                    </li>
                    <li>
                        <a href="categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="foods.php">Foods</a>
                    </li>
                </ul>
                <a href="javascript:history.back()" class="btn-back"> Back</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

   <!-- Food Search Section -->
   <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="process_order.php" method="POST" class="order">
            <input type="hidden" name="food-title" value="<?php echo !empty($promotion_name) ? $promotion_name : $food_name; ?>">
                <fieldset>
                    <legend>Selected Food</legend>

                    <!-- Display product details -->
                    <div class="food-menu-img">
                    <img src="admin/uploaded_img/<?php 
                      if (!empty($promotion_name)) { 
                           echo $promotion_image; 
                      } else if (!empty($food_name)) { 
                        echo $food_image; 
                          } 
                      ?>" alt="<?php echo !empty($promotion_name) ? $promotion_name : $food_name; ?>" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                    <H3>$<?php 
                   // Display the price based on whether a promotion exists
                    if (!empty($promotion_price)) {
                     echo $promotion_price; 
                    } else if (!empty($food_price)) { 
                      echo $food_price; 
                     } 
                      ?></h3>

                        <p class="food-price"><?php echo !empty($promotion_name) ? $promotion_name : $food_name; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>
                 </fieldset>

                <!-- Delivery Details Section -->
                <fieldset>
                    <legend>Delivery Details</legend>

                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0771234567" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. example@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
        </div>
    </section>

<!-- social Section Starts Here -->
<section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="https://web.facebook.com/vi.savi.714"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/___savii.__?igsh=MXRheHp2M3Ztcm4weQ%3D%3D&utm_source=qr"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                <a href="https://www.linkedin.com/in/savindu-abeysooriya-13082129a/"><img src="https://img.icons8.com/fluent/50/000000/linkedin.png" alt="LinkedIn" /></a>
                </li>
            </ul>
        </div>
    </section>

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="https://www.linkedin.com/in/savindu-abeysooriya-13082129a/">Savi Abeysooriya</a></p>
        </div>
    </section>
</body>
</html>