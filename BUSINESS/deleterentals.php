<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Rental</title>
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
    <h1>Are you sure you want to delete this rental?</h1>
    
    <?php 
    if (isset($_GET['rentalId'])) {
        $getRentalByID = getRentalByID($pdo, $_GET['rentalId']); 
        
        if ($getRentalByID) {
            // Split the fullName into firstName and lastName
            $fullNameParts = explode(" ", $getRentalByID['fullName'], 2);
            $firstName = $fullNameParts[0];
            $lastName = isset($fullNameParts[1]) ? $fullNameParts[1] : '';

            ?>
            <table>
                <tr>
                    <th>Full Name</th>
                    <td><?php echo ($getRentalByID['fullName']); ?></td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td><?php echo ($getRentalByID['contactNumber']); ?></td>
                </tr>
                <tr>
                    <th>Rental Date</th>
                    <td><?php echo ($getRentalByID['rentalDate']); ?></td>
                </tr>
                <tr>
                    <th>Return Date</th>
                    <td><?php echo ($getRentalByID['returnDate']); ?></td>
                </tr>
            </table>

            <form action="core/handleForms.php?rentalId=<?php echo urlencode($_GET['rentalId']); ?>" method="POST">
                <input type="submit" name="deleteRentalBtn" value="Delete">
            </form>
            
            <p><a href="index.php?rentalId=<?php echo $_GET['rentalId']; ?>">Cancel</a></p>
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
