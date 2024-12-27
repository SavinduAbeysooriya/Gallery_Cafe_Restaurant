<?php
@include 'includes/dbh.inc.php';

if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch categories from the database
$query = "SELECT id, Name, Image FROM category";
$result = mysqli_query($conn, $query);



if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Store fetched categories in an array
$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

// Fetch products from the database
$productsQuery = "SELECT * FROM products";
$productsResult = mysqli_query($conn, $productsQuery);

if (!$productsResult) {
    die("Query failed: " . mysqli_error($conn));
}

// Store fetched products in an array
$products = [];
while ($row = mysqli_fetch_assoc($productsResult)) {
    $products[] = $row;
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

.food-menu-img {
    width: 20%; 
    float: left; 
    position: relative; 
}

.food-menu-img img {
    width: 100%; 
    height: auto; 
    aspect-ratio: 1; 
    object-fit: cover; 
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

.category-link {
    text-decoration: none; 
    color: inherit; 
    transition: transform 0.3s; 
}

.box-3 {
    position: relative; 
    overflow: hidden; 
    border-radius: 10px; 
    margin: 15px; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
    transition: transform 0.3s, box-shadow 0.3s; 
}

.box-3:hover {
    transform: scale(1.05); 
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); 
}

.img-responsive {
    width: 100%; 
    height: auto; 
}

.float-text {
    position: absolute; 
    bottom: 10px; 
    left: 15px; 
    font-size: 24px; 
    background-color: rgba(0, 0, 0, 0.6); 
    padding: 10px; 
    border-radius: 5px; 
    transition: background-color 0.3s; 
}

.float-text:hover {
    background-color: rgba(0, 0, 0, 0.8); 
}

.food-categories {
    background-color: #ececec; 
    padding: 4% 0; 
}

.food-category-box {
    position: relative; 
    overflow: hidden; 
    border-radius: 15px; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
    transition: transform 0.3s, box-shadow 0.3s; 
}

.food-category-box:hover {
    transform: scale(1.05); 
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); 
}

.category-link {
    display: block; 
    margin: 1%; 
    width: calc(25% - 2%); 
    float: left; 
    text-decoration: none; 
    color: inherit; 
}

.img-responsive {
    width: 100%; 
    height: 200px; 
    object-fit: cover; 
}

.category-name {
    position: absolute; 
    bottom: 10px; 
    left: 15px; 
    font-size: 1.5rem; 
    color: white; 
    background-color: rgba(0, 0, 0, 0.6); 
    padding: 10px; 
    border-radius: 5px; 
    transition: background-color 0.3s; 
}

.category-name:hover {
    background-color: rgba(0, 0, 0, 0.8); 
}

/* Logo styles */
.logo {
    margin-right: auto; 
}

.logo img {
    width: 50px; 
    height: auto; 
    transition: transform 0.3s; 
}

.logo img:hover {
    transform: scale(1.2); 
    z-index: 10; 
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
            
            <form action="search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
    <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php if (count($categories) > 0): ?>
                <?php foreach ($categories as $category): ?>
                    <a href="categoryfood.php?category_id=<?php echo $category['id']; ?>" class="category-link">
                        <div class="food-category-box">
                            <img src="admin/uploaded_img/<?php echo $category['Image']; ?>" alt="<?php echo $category['Name']; ?>" class="img-responsive img-curve">
                            <h3 class="category-name"><?php echo ($category['Name']); ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No categories available at the moment.</p>
            <?php endif; ?>

        <div class="clearfix"></div>
        </div>
    </section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        
            <h2 class="text-center">Food Menu</h2>

            <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="admin/uploaded_img/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                        <p class="food-price"><?php echo htmlspecialchars($product['price']); ?>$</p>
                        <p class="food-detail"><?php echo htmlspecialchars($product['description']); ?></p>
                        <br>
                        <a href="orderfood.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Order Now</a>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No foods available at the moment.</p>
        <?php endif; ?>

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