<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_category = $_POST['category'];
   $product_description = $_POST['product_description'];
   
   
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_category) || empty($product_description) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $update = "UPDATE products SET name='$product_name', price='$product_price', category='$product_category', description='$product_description', image='$product_image'
      WHERE id = $id";
      $upload = mysqli_query($conn,$update);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
      }else{
         $message[] = 'could not add the product';
      }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin edit food</title>

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


.message{
   display: block;
   background: var(--bg-color);
   padding:1.5rem 1rem;
   font-size: 2rem;
   color:var(--black);
   margin-bottom: 2rem;
   text-align: center;
}

.btn:hover{
   background: var(--black);
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

.admin-product-form-container form.centered{
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

<div class="container">
<div class="admin-product-form-container centered">

<?php 

$select =mysqli_query($conn,"SELECT * FROM products WHERE id =$id");
while($row = mysqli_fetch_array($select)){

?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
   <h3>update foods & beverages</h3>
   <input type="text" placeholder="enter product name" value="<?php $row['name'];?>" name="product_name" class="box">
   <input type="number" placeholder="enter product price" value="<?php $row['price'];?>" name="product_price" class="box">
  
   
   <label for="category">Choose a category:</label>
   <select id="category" name="category">
   <option value="Srilankan">Srilankan</option>
   <option value="Italian">Italian</option>
   <option value="Indian">Indian</option>
   </select>

   <input type="text" placeholder="enter product description" value="<?php $row['description'];?>" name="product_description" class="box">
   <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
   <input type="submit" class="btn" name="update_product" value="update product" >
   <a href="addfood.php" class="btn">go back</a>
</form>

<?php
};
?>

</div>

</div>
    
</body>
</html>