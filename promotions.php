<?php
@include 'includes/dbh.inc.php';

if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

// Check if 'id' is passed in the URL for the promotion
if (isset($_GET['id'])) {
    $promotion_id = $_GET['id'];

    // Query to get the promotion details from the database
    $query = "SELECT name, image, price FROM promotions WHERE id = $promotion_id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Set the variables to use in the form
        $promotion_name = $row['name'];
        $promotion_image = $row['image'];
        $promotion_price = $row['price'];
    } else {
        echo "Promotion not found!";
        $promotion_name = $promotion_image = $promotion_price = ''; // Default values to avoid undefined variable issues
    }
} else {
    echo "No promotion selected!";
    $promotion_name = $promotion_image = $promotion_price = ''; // Default values to avoid undefined variable issues
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

 </style>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="—restaurant logo.png" alt="Restaurant Logo" class="img-responsive">
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="homepage.php">Home</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    
    <!-- promotions MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Promotions</h2>
            <?php
        // Fetch promotions from the database
        $select_promotions = mysqli_query($conn, "SELECT * FROM promotions");
        if (mysqli_num_rows($select_promotions) > 0) {
            // Loop through the promotions and display them
            while ($row = mysqli_fetch_assoc($select_promotions)) { 
        ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                <img src="admin/uploaded_img/<?php echo $row['Image']; ?>" alt="<?php echo $row['PromotionName']; ?>" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4><?php echo $row['PromotionName']; ?></h4>
                    <p class="food-price"><?php echo $row['PromotionPrice']; ?></p>
                    <p class="food-detail">
                        <?php echo $row['PromotionDescription']; ?>
                    </p>
                    <br>
                    <a href="orderfood.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
            }
        } else {
            echo "<p class='text-center'>No promotions available at the moment.</p>";
        }
        ?>
            <div class="clearfix"></div>
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