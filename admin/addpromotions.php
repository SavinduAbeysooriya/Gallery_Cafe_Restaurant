<?php

@include 'config.php';

if(isset($_POST['add_promotion'])){

   $promotion_name = $_POST['promotion_name'];
   $promotion_price = $_POST['promotion_price'];
   $promotion_description = $_POST['promotion_description'];
   $promotion_image = $_FILES['promotion_image']['name'];
   $promotion_image_tmp_name = $_FILES['promotion_image']['tmp_name'];
   $promotion_image_folder = 'uploaded_img/'.$promotion_image;

   if(empty($promotion_name) || empty($promotion_price)  || empty($promotion_description) || empty($promotion_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO promotions(PromotionName, PromotionPrice, PromotionDescription, Image) VALUES('$promotion_name', '$promotion_price', '$promotion_description' , '$promotion_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($promotion_image_tmp_name, $promotion_image_folder);
         $message[] = 'new promotion added successfully';
      }else{
         $message[] = 'could not add the promotion';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM promotions WHERE id = $id");
   header('location:addpromotions.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root{
   --green:#27ae60;
   --black:#333;
   --white:#fff;
   --bg-color:#eee;
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   --border:.1rem solid var(--black);
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   text-transform: capitalize;
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

.btn{
   display: block;
   width: 100%;
   cursor: pointer;
   border-radius: .5rem;
   margin-top: 1rem;
   font-size: 1.7rem;
   padding:1rem 3rem;
   background: var(--green);
   color:var(--white);
   text-align: center;
}

.btn:hover{
   background: var(--black);
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

.container{
   max-width: 1200px;
   padding:2rem;
   margin:0 auto;
}

.admin-product-form-container.centered{
   display: flex;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
   
}

.admin-product-form-container form{
   max-width: 50rem;
   margin:0 auto;
   padding:2rem;
   border-radius: .5rem;
   background: var(--bg-color);
}

.admin-product-form-container form h3{
   text-transform: uppercase;
   color:var(--black);
   margin-bottom: 1rem;
   text-align: center;
   font-size: 2.5rem;
}

.admin-product-form-container form .box{
   width: 100%;
   border-radius: .5rem;
   padding:1.2rem 1.5rem;
   font-size: 1.7rem;
   margin:1rem 0;
   background: var(--white);
   text-transform: none;
}

.product-display{
   margin:2rem 0;
}

.product-display .product-display-table{
   width: 100%;
   text-align: center;
}

.product-display .product-display-table thead{
   background: var(--bg-color);
}

.product-display .product-display-table th{
   padding:1rem;
   font-size: 2rem;
}

.product-display .product-display-table td{
   padding:1rem;
   font-size: 2rem;
   border-bottom: var(--border);
}

.product-display .product-display-table .btn:first-child{
   margin-top: 0;
}

.product-display .product-display-table .btn:last-child{
   background: crimson;
}

.product-display .product-display-table .btn:last-child:hover{
   background: var(--black);
}

@media (max-width:991px){

   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   .product-display{
      overflow-y:scroll;
   }

   .product-display .product-display-table{
      width: 80rem;
   }

}

@media (max-width:450px){

   html{
      font-size: 50%;
   }

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

.logo {
    width: 10%;
    float: right;
}

.menu {
    line-height: 60px;
}

.menu ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.menu ul li {
    display: inline-block;
    padding: 0 15px;
    font-weight: bold;
    font-size: 15px;
}

.cta-btn {
    background-color: #ff4d4d; /* Red background */
    color: white;              /* White text */
    padding: 10px 20px;        /* Padding for the button */
    text-align: center;        /* Center the text */
    text-decoration: none;     /* Remove the underline from the link */
    display: inline-block;     /* Makes it behave like a button */
    font-size: 16px;           /* Text size */
    border-radius: 5px;        /* Rounded corners */
    border: none;              /* Remove default border */
    cursor: pointer;           /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth hover transition */
}

.cta-btn:hover {
    background-color: #ff1a1a; /* Darker red on hover */
}

.logo {
    display: flex;
    align-items: center;   /* Vertically center the logo and text */
    justify-content: flex-end; /* Move the logo to the right */
    width: 150px;          /* Set a width to make the logo smaller */
    float: right;          /* Align to the right side of the page */
}

.logo img {
    width: 100%;           /* Make the image responsive and fit the width */
    max-width: 50px;       /* Set the maximum width for the logo */
    margin-right: 10px;    /* Add some spacing between the logo and the text */
}

.logo h1 {
    font-size: 1.2rem;     /* Adjust the font size */
    margin: 0;             /* Remove default margin */
}

label {
  font-size: 16px;
  font-weight: bold;
  margin-right: 10px;
}

/* Style the select dropdown */
select {
  width: 200px;
  height: 40px;
  padding: 5px;
  font-size: 16px;
  border: 2px solid #ccc;
  border-radius: 5px;
  background-color: #f8f8f8;
  color: #333;
  cursor: pointer;
}

/* Change background and border on hover */
select:hover {
  border-color: #888;
  background-color: #fff;
}

/* Style the dropdown options */
option {
  font-size: 16px;
  padding: 10px;
}

/* Style the submit button */
input[type="submit"] {
  margin-top: 10px;
  padding: 10px 20px;
  font-size: 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}
</style>  
</head>

<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

<!-- Navbar Section Starts Here -->
<section class="navbar">
        <div class="container">
            <div class="logo">
          <img src="—restaurant logo.png" alt="Logo" />
        </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="addfood.php">Foods & Beverages</a>
                        </li>
                        <li>
                        <a href="addpromotions.php">Promotions</a>
                        </li>
                        <li>
                        <a href="addevent.php">Special Events</a>
                    </li>
                    <li>
                        <a href="categoryadmin.php">Categories</a>
                    </li>
                    <li>
                        <a href="tablereservations.php">Table Reservations</a>
                    </li>
                    <li>
                        <a href="orderdetails.php">Orders</a>
                    </li>
                    <li>
                        <a href="addStaff.php">Staff</a>
                    </li>
                   
                </ul>
                <a href="indexadmin.php" class="cta-btn" onclick="confirmLogout(event)">Logout</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
   
<div class="container">
   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add Promotions</h3>
         <input type="text" placeholder="enter promotion name" name="promotion_name" class="box">
         <input type="text" placeholder="enter promotion price/discount" name="promotion_price" class="box">
         <input type="text" placeholder="enter promotion description" name="promotion_description" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="promotion_image" class="box">
         <input type="submit" class="btn" name="add_promotion" value="add promotion">
      </form>
   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM promotions");
   
   ?>

   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>promotion name</th>
            <th>promotion price/discount</th>
            <th>promotion description</th>
            <th>promotion image</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            
            <td><?php echo $row['PromotionName']; ?></td>
            <td><?php echo $row['PromotionPrice']; ?></td>
            <td><?php echo $row['PromotionDescription']; ?></td>
            <td><img src="uploaded_img/<?php echo $row['Image']; ?>" height="100" alt=""></td>
            <td>
               <a href="addpromotions.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
</div>

<script>
        function confirmLogout(event) {
            event.preventDefault(); // Prevent the default link behavior
            var confirmAction = confirm("Do you want to logout?");
            if (confirmAction) {
                // Redirect to your actual logout script or page
                window.location.href = 'indexadmin.php'; // Modify this with your logout script path
            } else {
                // Do nothing if the user cancels
                console.log("User canceled logout.");
            }
        }
    </script>

</body>
</html>