<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to the Car Rental Management System.</h1>

    <!-- Form for adding a new rental -->
    <form action="core/handleForms.php" method="POST">
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
        <p><input type="submit" name="insertRentalBtn" value="Add Rental"></p>
    </form>

    <!-- Displaying rental information in a table -->
    <?php $getAllRentals = getAllRentals($pdo); ?>
    <table class="rental-table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Contact Number</th>
                <th>Rental Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getAllRentals as $row) { ?>
                <tr>
                    <td><?php echo ($row['fullName']); ?></td>
                    <td><?php echo ($row['contactNumber']); ?></td>
                    <td><?php echo ($row['rentalDate']); ?></td>
                    <td><?php echo ($row['returnDate']); ?></td>
                    <td>
                        <div>
                            <a href="viewcars.php?rentalId=<?php echo $row['rentalId']; ?>">View Cars</a>
                        </div>
                        <div>
                            <a href="editrentals.php?rentalId=<?php echo $row['rentalId']; ?>">Edit Rental</a>
                        </div>
                        <div>
                            <a href="deleterentals.php?rentalId=<?php echo $row['rentalId']; ?>">Delete Rental</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
