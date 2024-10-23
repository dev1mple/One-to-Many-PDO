<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    // Check if carID is provided and fetch the car details 
        $getRentalByID = getRentalByID($pdo, $_GET['rentalId']);

        if (!$getRentalByID) {
            echo "<h2>Car not found!</h2>";
            exit;
        }
   
    ?>

    <h1>Edit Rental!</h1>
    <form action="core/handleForms.php?rentalId=<?php echo ($_GET['rentalId']); ?>" method="POST">
        <p>
            <label for="fullName">Full Name: </label>
            <input type="text" name="fullName" required>
        </p>
        <p>
            <label for="contactNumber">Contact Number: </label>
            <input type="text" name="contactNumber" required>
        </p>
        <p>
            <label for="rentalDate">Rental Date: </label>
            <input type="date" name="rentalDate" required>
        </p>
        <p>
            <label for="returnDate">Return Date: </label>
            <input type="date" name="returnDate" required>
        </p>
        <p><input type="submit" name="editRentalBtn" value="Update Rental"></p>
    </form>

    <p><a href="viewcars.php">Return to Car List</a></p>
</body>
</html>
