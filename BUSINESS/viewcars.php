<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rentals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p><a href="index.php">Return to Home Screen</a></p>

    <?php 
    if (isset($_GET['rentalId'])) {
        // Fetch rental info by ID
        $getRentalByID = getRentalByID($pdo, $_GET['rentalId']);
        
        if ($getRentalByID) {
    ?>
            <h1>Rental ID: <?php echo htmlspecialchars($getRentalByID['rentalId']); ?></h1>

            <h2>Add New Car</h2>
            <form action="core/handleForms.php" method="POST">
                <input type="hidden" name="rentalId" value="<?php echo htmlspecialchars($getRentalByID['rentalId']); ?>">
                <div>
                    <label for="model">Car Model:</label>
                    <input type="text" name="model" required>
                </div>
                <div>
                    <label for="brand">Car Brand:</label>
                    <input type="text" name="brand" required>
                </div>
                <div>
                    <label for="rentalPrice">Rental Price:</label>
                    <input type="number" step="0.01" name="rentalPrice" required>
                </div>
                <div>
                    <input type="submit" name="insertCarBtn" value="Add Car">
                </div>
            </form>

            <h2>Current Cars in Rental</h2>
            <table class="rental-table">
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Model</th>
                        <th>Brand</th>
                        <th>Rental Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getCarsByRental = getCarsByRental($pdo, $_GET['rentalId']); 
                    foreach ($getCarsByRental as $row) { 
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['carID']); ?></td>
                            <td><?php echo htmlspecialchars($row['model']); ?></td>
                            <td><?php echo htmlspecialchars($row['brand']); ?></td>
                            <td><?php echo htmlspecialchars($row['rentalPrice']); ?></td>
                            <td>
                                <a href="editcars.php?carID=<?php echo $row['carID']; ?>&rentalId=<?php echo $_GET['rentalId']; ?>">Edit</a>
                                <a href="deletecars.php?carID=<?php echo $row['carID']; ?>&rentalId=<?php echo $_GET['rentalId']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    <?php 
        } else {
            echo "<h2>Rental not found.</h2>";
        }
    } else {
        echo "<h2>No rental ID provided.</h2>";
    }
    ?>
</body>
</html>
