<?php
@include 'config.php';

if(isset($_POST['add_staff'])){

   $staffmember_name = $_POST['staffmember_name'];
   $staffmember_email = $_POST['staffmember_email'];
   $staffmember_password = $_POST['staffmember_password'];
   $staffmember_passwordrepeat = $_POST['staffmember_passwordrepeat'];

   if(empty($staffmember_name) || empty($staffmember_email) || empty($staffmember_password) || empty($staffmember_passwordrepeat)){
      $message[] = 'please fill out all';
   }elseif($staffmember_password != $staffmember_passwordrepeat) {
    $message[] = 'Passwords do not match.';
   } else {
    // Optionally hash the password before storing it for security
    $hashed_password = password_hash($staffmember_password, PASSWORD_DEFAULT);
      
      $insert = "INSERT INTO usersstaff(UsersName, UsersEmail, UsersPwd) VALUES('$staffmember_name', '$staffmember_email', '$hashed_password')";
      $upload = mysqli_query($conn,$insert);

      if ($upload) {
        $message[] = 'Staff member added successfully.';
     } else {
        $message[] = 'Error adding staff member.';
     }
   }
};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM usersstaff WHERE id = $id");
   header('location:addstaff.php');
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
    background-color: #ff4d4d; 
    color: white;             
    padding: 10px 20px;       
    text-align: center;        
    text-decoration: none;     
    display: inline-block;     
    font-size: 16px;          
    border-radius: 5px;        
    border: none;             
    cursor: pointer;          
    transition: background-color 0.3s ease; 
}

.cta-btn:hover {
    background-color: #ff1a1a; 
}

.logo {
    display: flex;
    align-items: center;   
    justify-content: flex-end; 
    width: 150px;         
    float: right;         
}

.logo img {
    width: 100%;          
    max-width: 50px;      
    margin-right: 10px;    
}

.logo h1 {
    font-size: 1.2rem;     
    margin: 0;             
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
   
<div class="container">
   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add staff Member</h3>
         <input type="text" placeholder="enter staff member name" name="staffmember_name" class="box">
         <input type="email" placeholder="enter staff member email" name="staffmember_email" class="box">
         <input type="password" placeholder="enter staff member password" name="staffmember_password" class="box">
         <input type="password" placeholder="enter staff member password again" name="staffmember_passwordrepeat" class="box">
         <input type="submit" class="btn" name="add_staff" value="add staff">
      </form>
   </div>

   <?php
   $select = mysqli_query($conn, "SELECT * FROM usersstaff");
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>staff member name</th>
            <th>staff member email</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['UsersName']; ?></td>
            <td><?php echo $row['UsersEmail']; ?></td>
            <td>
               <a href="addstaff.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
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
                window.location.href = 'indexadmin.php'; 
            } else {
                // Do nothing if the user cancels
                console.log("User canceled logout.");
            }
        }
    </script>
</body>
</html>