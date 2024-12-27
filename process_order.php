<?php
@include 'includes/dbh.inc.php';

if (!$conn) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

$delete_success = false; // Variable to track delete success

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize
    $food_title = mysqli_real_escape_string($conn, $_POST['food-title']); // Food title
    $quantity = mysqli_real_escape_string($conn, $_POST['qty']); // Quantity
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']); // Full name
    $phone = mysqli_real_escape_string($conn, $_POST['contact']); // Phone
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Email
    $address = mysqli_real_escape_string($conn, $_POST['address']); // Address

    // Insert the order into the database
    $query = "INSERT INTO orders (FoodTitle, Quantity, FullName, Phone, Email, Address) 
              VALUES ('$food_title', '$quantity', '$full_name', '$phone', '$email', '$address')";

    if (mysqli_query($conn, $query)) {
        // Retrieve the last inserted order ID
        $order_id = mysqli_insert_id($conn);

        // Retrieve the order details using the order ID
        $order_query = "SELECT * FROM orders WHERE id = $order_id";
        $order_result = mysqli_query($conn, $order_query);
        
        if ($order_result && mysqli_num_rows($order_result) > 0) {
            $order = mysqli_fetch_assoc($order_result);
        } else {
            echo "Failed to retrieve order details!";
        }

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Delete functionality
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (mysqli_query($conn, "DELETE FROM orders WHERE id = $id")) {
        $delete_success = true; // Set success flag
    } else {
        echo "Failed to delete the order: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center;
        }
        .success-message, .delete-message {
            font-size: 1.5rem;
            color: green;
            margin-bottom: 20px;
        }
        .order-details {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
        }
        .order-details h3 {
            margin-bottom: 10px;
        }
        .order-details p {
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn i {
            margin-right: 5px;
        }

    .btn-exit {
        display: inline-block;
        padding: 10px 240px;
        background-color: #ff0000;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        margin-top: 20px;
    }

    .btn-exit i {
        margin-right: 5px;
    }
</style>

</head>
<body>

<?php if ($delete_success) { ?>
    <div class="delete-message">Order has been canceled successfully!</div>
<?php } else if (isset($order)) { ?>
    <div class="success-message">Your order has been placed successfully!</div>
    <div class="order-details">
        <h3>Order Details</h3>
        <p><strong>Food:</strong> <?php echo $order['FoodTitle']; ?></p>
        <p><strong>Quantity:</strong> <?php echo $order['Quantity']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $order['FullName']; ?></p>
        <p><strong>Phone:</strong> <?php echo $order['Phone']; ?></p>
        <p><strong>Email:</strong> <?php echo $order['Email']; ?></p>
        <p><strong>Address:</strong> <?php echo $order['Address']; ?></p>

        <!-- Delete button with correct order ID -->
        <a href="process_order.php?delete=<?php echo $order['id']; ?>" class="btn"> 
            <i class="fas fa-trash"></i> Cancel Order
        </a>
    </div>
<?php } else { ?>
    <p>There was an issue processing your order. Please try again.</p>
<?php } ?>

<a href="menu.php" class="btn-exit">
    <i class="fas fa-sign-out-alt"></i> Exit
</a>

</body>
</html>
