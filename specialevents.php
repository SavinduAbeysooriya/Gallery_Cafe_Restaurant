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
    height: auto;
    margin-right: 15px;
    border-radius: 8px;
    object-fit: cover;
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
    color: red;
}
.float-container{
    position: relative;
}
.float-text {
    font-size: 2rem; 
    font-weight: bold; 
    text-align: center; 
    color: #333; 
    margin-top: 20px; 
    margin-bottom: 20px; 
}

.float-text::before {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background-color: #ff4d4d; 
    margin: 10px auto; 
}


@media (max-width: 768px) {
    .float-text {
        font-size: 1.6rem; 
        padding: 8px 15px; 
    }
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

/* CSS for events */
.categories{
    padding: 4% 0;
}

.box-3{
    width: 28%;
    float: left;
    margin: 2%;
}

/* CSS for Social */
.social ul{
    list-style-type: none;
}
.social ul li{
    display: inline;
    padding: 1%;
}

.event-detail {
    background-color: #f9f9f9; 
    padding: 20px; 
    border-radius: 10px; 
    border: 1px solid #ddd; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    font-size: 1.6rem; 
    line-height: 1.5; 
    color: #333; 
    transition: transform 0.3s ease; 
    max-width: 600px; 
    margin: 20px auto; 
}

.event-detail:hover {
    transform: scale(1.05); 
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
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
   
    <!-- events Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Special Events</h2>

        <?php
        // Fetch promotions from the database
        $select_events = mysqli_query($conn, "SELECT * FROM events");
        if (mysqli_num_rows($select_events) > 0) {
            // Loop through the promotions and display them
            while ($row = mysqli_fetch_assoc($select_events)) { 
        ?>

            <a href="#">
            <div class="box-3 float-container">
                <img src="admin/uploaded_img/<?php echo $row['Image']; ?>" alt="<?php echo $row['Eventname']; ?>" class="img-responsive img-curve">
                </div>
                <h3 class="float-text text-white"><?php echo $row['Eventname']; ?></h3>
                <p class="event-detail">
                    <?php echo $row['EventDescription']; ?>
                </p>
            </div>
            </a>
            <?php
            }
        } else {
            echo "<p class='text-center'>No events available at the moment.</p>";
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