<?php

@include 'includes/dbh.inc.php';

if(isset($_POST['book_table'])){

   $date = $_POST['date'];
   $time = $_POST['time'];
   $people = $_POST['people'];
   $firstname = $_POST['first_name'];
   $lastname = $_POST['last_name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $comments = $_POST['comments'];
   
   if(empty($date) || empty($time) || empty($people) || empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($comments)){
      $message[] = 'please fill out all';
      }else{
        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO bookedtable (Date, Time, People, FirstName, LastName, Email, Phone, Comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $date, $time, $people, $firstname, $lastname, $email, $phone, $comments);

        // Execute the statement
        if ($stmt->execute()) {
            $message[] = 'Table booked successfully!';
        } else {
            $message[] = 'Error booking table: ' . $stmt->error;
        }
        $stmt->close();
    }
}
  
  // Display messages
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<span class="message">' . $msg . '</span>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe Booking</title>
    
   <style>
       * {
         margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;   
            }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 1%;
        }
        .img-responsive {
            width: 100%;
        }
        .img-curve {
            border-radius: 15px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .text-white {
            color: white;
        }
        .clearfix {
            clear: both;
            float: none;
        }
        a {
            color: #ff6b81;
            text-decoration: none;
        }
        a:hover {
            color: #ff4757;
        }
        .btn {
            padding: 1%;
            border: none;
            font-size: 1rem;
            border-radius: 5px;
        }
        .message{
           display: block;
           background: var(--bg-color);
           padding:1.5rem 1rem;
           font-size: 2rem;
           color:var(--black);
           margin-bottom: 2rem;
           text-align: center;
        }
        .btn-primary {
            background-color: #ff6b81;
            color: white;
            cursor: pointer;
        }
        .btn-primary:hover {
            color: white;
            background-color: #ff4757;
        }
        h2 {
            color: #2f3542;
            font-size: 2rem;
            margin-bottom: 2%;
        }
        h3 {
            font-size: 1.5rem;
        }
        fieldset {
            border: 1px solid white;
            margin: 5%;
            padding: 3%;
            border-radius: 5px;
        }
        .navbar .logo {
            width: 10%;
            float: left;
        }
        .navbar .menu {
            line-height: 60px;
            text-align: right;
        }
        .navbar .menu ul {
            list-style-type: none;
        }
        .navbar .menu ul li {
            display: inline;
            padding: 1%;
            font-weight: bold;
        }
        .order {
            width: 50%;
            margin: 0 auto;
        }
        .input-responsive {
            width: 96%;
            padding: 1%;
            margin-bottom: 3%;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        .order-label {
            margin-bottom: 1%;
            font-weight: bold;
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

/* CSS for Social */
.social ul{
    list-style-type: none;
}
.social ul li{
    display: inline;
    padding: 1%;
}

.table-capacity {
    padding: 20px;
    background-color: #f8f9fa; 
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
}

.table-capacity h2 {
    text-align: center;
    color: #2f3542; 
    margin-bottom: 20px;
}

.table-capacity ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.table-capacity li {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 10px;
    border-bottom: 1px solid #ddd; 
}

.table-capacity img {
    width: 120px; 
    height: auto;
    border-radius: 10px; 
    margin-right: 20px; 
}

.table-capacity div {
    max-width: 300px; 
}

.table-capacity h3 {
    margin: 0;
    font-size: 1.2rem;
    color: #333; 
}

.table-capacity p {
    margin: 5px 0 0;
    font-size: 1rem;
    color: #555; 
}

 </style>

<?php
// Display the message if set
if (isset($_SESSION['message'])) {
    echo '<span class="message">' . $_SESSION['message'] . '</span>';
    unset($_SESSION['message']); 
}
?>

    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="—restaurant logo.png" alt="NinjaGrill Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="homepage.php">Home</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Booking Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Book a Table</h2>

        <form action="#" method="post" class="order">
            <fieldset>
                <legend>Booking Details</legend>

                <div class="order-label">Date:</div>
                <input type="date" id="date" name="date" class="input-responsive" required>

                <div class="order-label">Time:</div>
                <select id="time" name="time" class="input-responsive" required>
                <option value="">Select Time</option>
                
<option value="06:00 AM">06:00 AM</option>
<option value="06:30 AM">06:30 AM</option>
<option value="07:00 AM">07:00 AM</option>
<option value="07:30 AM">07:30 AM</option>
<option value="08:00 AM">08:00 AM</option>
<option value="08:30 AM">08:30 AM</option>
<option value="09:00 AM">09:00 AM</option>
<option value="09:30 AM">09:30 AM</option>
<option value="10:00 AM">10:00 AM</option>
<option value="10:30 AM">10:30 AM</option>
<option value="11:00 AM">11:00 AM</option>
<option value="11:30 AM">11:30 AM</option>
<option value="12:00 PM">12:00 PM</option>
<option value="12:30 PM">12:30 PM</option>
<option value="01:00 PM">01:00 PM</option>
<option value="01:30 PM">01:30 PM</option>
<option value="02:00 PM">02:00 PM</option>
<option value="02:30 PM">02:30 PM</option>
<option value="03:00 PM">03:00 PM</option>
<option value="03:30 PM">03:30 PM</option>
<option value="04:00 PM">04:00 PM</option>
<option value="04:30 PM">04:30 PM</option>
<option value="05:00 PM">05:00 PM</option>
<option value="05:30 PM">05:30 PM</option>
<option value="06:00 PM">06:00 PM</option>
<option value="06:30 PM">06:30 PM</option>
<option value="07:00 PM">07:00 PM</option>
<option value="07:30 PM">07:30 PM</option>
<option value="08:00 PM">08:00 PM</option>
<option value="08:30 PM">08:30 PM</option>
<option value="09:00 PM">09:00 PM</option>
<option value="09:30 PM">09:30 PM</option>
<option value="10:00 PM">10:00 PM</option>
<option value="10:30 PM">10:30 PM</option>
<option value="11:00 PM">11:00 PM</option>
<option value="11:30 PM">11:30 PM</option>
   
                </select>

                <div class="order-label">People:</div>
                <input type="number" id="people" name="people" min="1" class="input-responsive" required>

                <div class="order-label">First Name:</div>
                <input type="text" id="first-name" name="first_name" class="input-responsive" required>

                <div class="order-label">Last Name:</div>
                <input type="text" id="last-name" name="last_name" class="input-responsive" required>

                <div class="order-label">Email:</div>
                <input type="email" id="email" name="email" class="input-responsive" required>

                <div class="order-label">Phone:</div>
                <input type="tel" id="phone" name="phone" class="input-responsive" required>

                <div class="order-label">Comments:</div>
                <textarea id="comments" name="comments" class="input-responsive"></textarea>

                <input type="submit" class="btn btn-primary" name="book_table" value="Book a Table" >
            </fieldset>
        </form>

        <section class="table-capacity">
    <h2>Available Table Capacities</h2>
    <ul>
        <li>
            <img src="2table.jpg" alt="2-person table" class="img-responsive img-curve">
            <div>
                <h3>2-person tables</h3>
                <p>10 available</p>
            </div>
        </li>
        <li>
            <img src="4table.jpg" alt="4-person table" class="img-responsive img-curve">
            <div>
                <h3>4-person tables</h3>
                <p>5 available</p>
            </div>
        </li>
        <li>
            <img src="6table.jpg" alt="6-person table" class="img-responsive img-curve">
            <div>
                <h3>6-person tables</h3>
                <p>2 available</p>
            </div>
        </li>
    </ul>
</section>

        <section class="parking">
            <h2><br>Parking Information</h2>
            <img src="parking2.jpeg" alt="Parking area" class="img-responsive img-curve">
            <p>We offer ample parking spaces on-site.</p>
        </section>
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
</html>