<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginadmin - The Gallery Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    padding: 10px 0;
    color: #fff;
    text-align: center;
}

header a {
    color: #fff;
    text-decoration: none;
    margin: 0 15px;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

button {
    width: 100%;
}

form {
    margin-top: 20px;
}

p {
    text-align: center;
}
</style>
</head>

<body>
    <header>
    <nav>
         <a href="indexadmin.php" class="logo">Back to Admin/Staff Homepage</a>
    </nav>
    </header>
 
    <div class="container mt-5">
        <h2>Login to Staff Account</h2>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyinput") {
                echo '<p class="error-msg" style="color:red;text-align:center;">Please fill in all fields.</p>';
            } elseif ($_GET['error'] == "wronglogin") {
                echo '<p class="error-msg" style="color:red;text-align:center;">Invalid login credentials. Please try again.</p>';
            }
        }
        ?>

        <form action="loginstaff.inc.php" method="POST">
              
                <label for="email" class="form-label" >Email Address</label>
                <input type="email"class="form-control"  id="email" name="email" required>
                <br>
                <label for="password"class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <br>
                <button type="submit" a href class="btn btn-primary"  name="submit">Login</button>
                </form>
            <br>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

