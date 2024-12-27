<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

    <style>
   /* Overall page styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 10%;
    padding: 0;
}
.container {
    width: 90%;
    margin: 0 auto;
    padding: 20px;
}
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Food menu styling */
.food-menu-box {
    display: flex;
    align-items: center;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 15px; /* Less space between items */
    padding: 15px; /* Reduced padding */
    transition: transform 0.3s ease;
}
.food-menu-box:hover {
    transform: scale(1.02);
}
.food-menu-img {
    flex: 1;
    max-width: 120px; /* Reduced image width */
    margin-right: 15px;
}
.food-menu-img img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    object-fit: cover;
}
.food-menu-desc {
    flex: 2;
}
.food-menu-desc h3 {
    font-size: 18px; /* Smaller font for title */
    color: #333;
    margin-bottom: 5px;
}
.food-price {
    font-size: 16px; /* Reduced font size for price */
    color: #ff6b81;
    margin-bottom: 5px;
}
.food-detail {
    font-size: 14px; /* Smaller font for description */
    color: #666;
    margin-bottom: 10px;
}

/* Buttons styling */
.buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}
.btn {
    padding: 8px 15px; /* Reduced button size */
    font-size: 14px; /* Smaller font size for buttons */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}
.btn-primary {
    background-color: #ff6b81;
    color: white;
}
.btn-primary:hover {
    background-color: #ff4a61;
}
.btn-secondary {
    background-color: #ddd;
    color: #333;
}
.btn-secondary:hover {
    background-color: #bbb;
}

/* Back to Top button styling */
#back-to-top {
        position: fixed;
        bottom: 40px;
        right: 40px;
        display: none;
        background-color: #ff6b81;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        z-index: 100;
    }
    #back-to-top:hover {
        background-color: #ff4a61;
    }
    </style>
</head>

<body>
    <h2 class="text-center">Search Results</h2>
    <a href="foodsearch.php" class="btn btn-secondary">Back to Previous Page</a>
    <br>
    <br>
        </div>

    <?php
    // Database connection details
    @include 'includes/dbh.inc.php';

    if (!$conn) {
     die("Failed to connect to database: " . mysqli_connect_error());
    }
  
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the search term from the form
        $searchQuery = $_POST['search'];

        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? OR category LIKE ? OR price LIKE?");
        $searchPattern = "%$searchQuery%";
        $stmt->bind_param("ssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output the results as styled food menu items
            while ($row = $result->fetch_assoc()) {
                echo "<div class='food-menu-box'>";
                echo "<div class='food-menu-img'>";
                echo "<img src='admin/uploaded_img/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' class='img-responsive img-curve'>";
                echo "</div>";
                echo "<div class='food-menu-desc'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p class='food-price'>$" . $row['price'] . "</p>";
                echo "<p class='food-detail'>" . $row['description'] . "</p>";
                echo "<a href='orderfood.php?id=" . $row['id'] . "' class='btn btn-primary'>Order Food</a>";
                
                echo "</div>";
                echo "<div class='clearfix'></div>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found for '$searchQuery'.</p>";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>

    </div>

</body>
</html>
