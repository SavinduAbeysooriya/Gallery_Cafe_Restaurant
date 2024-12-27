<?php
@include 'includes/dbh.inc.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if 'category_id' is set in the URL
if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = mysqli_real_escape_string($conn, trim($_GET['category_id']));

    // Fetch the category name using category ID
    $category_query = "SELECT Name FROM category WHERE id = '$category_id'";
    $category_result = mysqli_query($conn, $category_query);

    if (!$category_result || mysqli_num_rows($category_result) === 0) {
        die('Invalid category.');
    }

    $category_row = mysqli_fetch_assoc($category_result);
    $category_name = $category_row['Name'];

    // Fetch products based on the category name
    $query = "SELECT * FROM products WHERE category = '$category_name'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if any products were found for the selected category
    if (mysqli_num_rows($result) === 0) {
        echo '<p class="text-center">No products found for this category: ' . htmlspecialchars($category_name) . '</p>';
    }
} else {
    // Redirect to foodsearch.php if 'category_id' is missing or empty
    header('Location: foodsearch.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Foods</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        /* General styling */
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f7f7f7;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
        }

        .food-menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .food-menu-box {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .food-menu-box:hover {
            transform: translateY(-10px);
        }

        .img-responsive {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .text-center {
            text-align: center;
            color: #333;
        }

        .food-price {
            font-size: 1.2rem;
            color: #ff6b81;
            margin: 10px 0;
        }

        .food-detail {
            font-size: 0.9rem;
            color: #747d8c;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            font-size: 1rem;
            border-radius: 5px;
            background-color: #ff6b81;
            color: white;
            cursor: pointer;
            margin-top: 10px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #ff4757;
        }

        h1 {
            color: #333;
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .food-menu-box {
                width: 100%;
            }
        }

       
    .btn-back {
        padding: 10px 20px;
        border: none;
        font-size: 1rem;
        border-radius: 5px;
        background-color: #2ed573;
        color: white;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #1eae60;
    }

    </style>
</head>
<body>

<div class="container">
<a href="javascript:history.back()" class="btn-back">← Back</a>
    <h1 class="text-center">Foods in Category: <?php echo htmlspecialchars($category_name); ?></h1>

    <div class="product-display">
        <div class="food-menu">
            <?php
            // Check if any products were found for the selected category
            if (isset($noProductsMessage)) {
                echo '<p class="text-center">' . htmlspecialchars($noProductsMessage) . '</p>';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = isset($row['image']) ? htmlspecialchars($row['image']) : 'default-image.jpg';
                    $name = isset($row['name']) ? htmlspecialchars($row['name']) : 'Unknown Product';
                    $price = isset($row['price']) ? htmlspecialchars($row['price']) : '0.00';
                    $description = isset($row['description']) ? htmlspecialchars($row['description']) : 'No description available.';
            ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="admin/uploaded_img/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-responsive">
                </div>
                <div class="food-menu-desc">
                    <h4><?php echo $name; ?></h4>
                    <p class="food-price"><?php echo $price; ?>$</p>
                    <p class="food-detail"><?php echo $description; ?></p>
                    <br>
                    <a href="orderfood.php?id=<?php echo $row['id']; ?>" class="btn">Order Now</a>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
