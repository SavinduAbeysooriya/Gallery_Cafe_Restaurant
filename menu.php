<?php
@include 'includes/dbh.inc.php';

if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
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
    text-align: right;
}

.menu ul li{
    display: inline;
    padding: 1%;
    font-weight: bold;
    transition: color 0.3s;
    color: #ffc107;
}

/* CSS for Social */
.social ul{
    list-style-type: none;
}
.social ul li{
    display: inline;
    padding: 1%;
}

/* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f8f9fa;
    color: #333;
}

/* Container */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

/* Food Search Section */
.food-search {
    background: url('bg.jpg') no-repeat center center/cover;
    color: #fff;
    padding: 60px 0;
}

.food-search h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.food-search input[type="search"] {
    width: 50%;
    padding: 10px;
    border-radius: 25px;
    border: none;
    margin-top: 20px;
}

/* Food Menu Section */
.food-menu {
    padding: 60px 0;
    background-color: #ececec;
}

.food-menu .text-center {
    margin-bottom: 40px;
    font-size: 2rem;
    font-weight: bold;
}

.food-menu-box {
    display: flex;
    flex-wrap: wrap;
    background-color: #fff;
    margin-bottom: 20px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.food-menu-box:hover {
    transform: translateY(-5px);
}

.food-menu-img {
    flex: 1;
    max-width: 150px;
    overflow: hidden;
}

.food-menu-img img {
    width: 100%;
    border-radius: 15px 0 0 15px;
    height: 100%;
    object-fit: cover;
}

.food-menu-desc {
    flex: 2;
    padding: 20px;
}

.food-menu-desc h4 {
    font-size: 1.5rem;
    color: #ff4757;
    margin-bottom: 10px;
}

.food-price {
    color: #20bf6b;
    font-size: 1.25rem;
    font-weight: bold;
}

.food-detail {
    margin: 15px 0;
    color: #666;
    line-height: 1.5;
}

.food-menu-desc .btn {
    background-color: #ff6b81;
    color: #fff;
    border: none;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.food-menu-desc .btn:hover {
    background-color: #ff4757;
}

/* Social Media */
.social ul li a img {
    width: 40px;
    transition: transform 0.3s;
}

.social ul li a img:hover {
    transform: scale(1.1);
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
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="foodsearch.php" class="text-white">Click Here</a></h2>

        </div>
    </section>
   
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
        // Fetch products from the database
        $select_products = mysqli_query($conn, "SELECT * FROM products");
        if (mysqli_num_rows($select_products) > 0) {
            // Loop through the products and display them
            while ($row = mysqli_fetch_assoc($select_products)) { 
        ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="admin/uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row['name']; ?></h4>
                    <p class="food-price">$<?php echo $row['price']; ?></p>
                    <p class="food-detail">
                        <?php echo $row['description']; ?>
                    </p>
                    <br>

                   <a href="orderfood.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Order Now</a>

                </div>
            </div>
        <?php
            }
        } else {
            echo "<p class='text-center'>No products available at the moment.</p>";
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

