<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Rental!</h1>

    <p><a href="viewcars.php">View the Cars</a></p>

    <?php 
    if (isset($_GET['carID'])) {
        $getCarByID = getCarByID($pdo, $_GET['carID']);

        if ($getCarByID) { 
    ?>
    <form action="core/handleForms.php?carID=<?php echo urlencode($_GET['carID']); ?>&rentalId=<?php echo urlencode($_GET['rentalId']); ?>" method="POST">
        <p>
            <label for="model">Model: </label>
            <input type="text" name="model" value="<?php echo ($getCarByID['model']); ?>" required>
        </p>
        <p>
            <label for="brand">Brand: </label>
            <input type="text" name="brand" value="<?php echo ($getCarByID['brand']); ?>" required>
        </p>
        <p>
            <label for="rentalPrice">Rental Price: </label>
            <input type="number" name="rentalPrice" step="0.01" min="0" value="<?php echo ($getCarByID['rentalPrice']); ?>" required>
        </p>
        <p><input type="submit" name="editCarBtn" value="Update Car"></p>
    </form>
    <?php 
        } else {
            echo "<p>Car not found.</p>";
        }
    } else {
        echo "<p>No car ID provided.</p>";
    }
    ?>

    <p><a href="viewcars.php">Return to Cars</a></p>
</body>
</html>