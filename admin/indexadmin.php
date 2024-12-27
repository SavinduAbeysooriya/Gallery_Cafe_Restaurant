<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    
<style>

body {
  font-family: 'Arial', sans-serif;
  background-color: #161617;
  color: #fff;
}

header {
  background-color: #202020;
  padding: 10px 20px;
}

nav .logo {
  display: flex;
  align-items: center;
}

nav .logo img {
  width: 60px;
  height: 60px;
  margin-right: 10px;
}

nav .logo h1 {
  color: #fdae40;
  font-size: 1.8rem;
}

.hero {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 100px 50px;
  background-image: url('homepageadmin.jpg'); 
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat;
    height: 649px; 
    width: 100%;
    position: relative;
    color: #fff;
    z-index: 1;
}

.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); 
  z-index: -1; 
}

.hero .content {
  max-width: 50%;
  z-index: 2;
}

.hero .content h2 {
  font: impact;
  font-size: 4rem;
  color: white;
  margin-bottom: 20px;
}

.hero .content p {
  font-size: 1.2rem;
  line-height: 1.6;
  margin-bottom: 30px;
  color: #bbb;
}

.cta-btn {
  padding: 15px 30px;
  background-color: #fdae40;
  color: #202020;
  text-decoration: none;
  border-radius: 5px;
  font-size: 1.1rem;
  font-weight: bold;
}

.hero .image img {
  max-width: 450px;
  border-radius: 10px;
  z-index: 2;
}

</style>
</head>

<body>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <header>
    <nav>
        <div class="logo">
          <img src="—restaurant logo.png" alt="Logo" />
            <h1>The Gallery Cafe</h1>
        </div>
    </nav>
  </header>
  <section class="hero">
    <div class="content">
        <h2>TASTE<br> OF HEAVEN</h2>
        <p>
          A charming eatery serving homemade comfort food with a modern twist. Enjoy a warm atmosphere and delicious meals.
        </p>
        <a href="loginstaff.php" class="cta-btn">Login Staff</a>
        <a href="adminlogin.php" class="cta-btn">Login Admin</a>
    </div>
    <div class="image">
        <img src="food-1.png" alt="home page" />
    </div>
</section>
</body>
</html>