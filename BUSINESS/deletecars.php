<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Car</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php 
    if (isset($_GET['carID'])) {
        $getCarByID = getCarByID($pdo, $_GET['carID']); 
        
        // Check if the car details were retrieved successfully
        if ($getCarByID) {
    ?>
    <h1>Are you sure you want to delete this car?</h1>

    <table>
        <tr>
            <th>Model</th>
            <td><?php echo htmlspecialchars($getCarByID['model']); ?></td>
        </tr>
        <tr>
            <th>Brand</th>
            <td><?php echo htmlspecialchars($getCarByID['brand']); ?></td>
        </tr>
        <tr>
            <th>Rental Price</th>
            <td><?php echo htmlspecialchars($getCarByID['rentalPrice']); ?></td>
        </tr>
        <tr>
            <th>Date Added</th>
            <td><?php echo htmlspecialchars($getCarByID['dateAdded']); ?></td>
        </tr>
    </table>

    <form action="core/handleForms.php?carID=<?php echo urlencode($_GET['carID']); ?>&rentalId=<?php echo urlencode($_GET['rentalId']); ?>" method="POST">
        <input type="submit" name="deleteCarBtn" value="Delete">
    </form>

    <p><a href="viewcars.php">Cancel</a></p>

    <?php
        } else {
            echo "<h2>Car not found.</h2>";
        }
    } else {
        echo "<h2>No car ID provided.</h2>";
    }
    ?>
</body>
</html>