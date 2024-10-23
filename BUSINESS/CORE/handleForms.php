<?php
require_once 'dbConfig.php';
require_once 'models.php';

// Insert a new rental
if (isset($_POST['insertRentalBtn'])) {
    $query = insertRental($pdo, $_POST['fullName'], $_POST['contactNumber'], $_POST['rentalDate'], $_POST['returnDate']);

    if ($query) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Insertion Failed";
    }
}

// Edit an existing rental
if (isset($_POST['editRentalBtn'])) {
    $query = updateRental($pdo, $_POST['fullName'], $_POST['contactNumber'], $_POST['rentalDate'], $_POST['returnDate'], $_GET['rentalId']);

    if ($query) {
        header("Location: ../index.php");
        exit(); 
    } else {
        echo "Edit Failed";
    }
}

// Delete a rental
if (isset($_POST['deleteRentalBtn'])) {
    $query = deleteRental($pdo, $_GET['rentalId']);

    if ($query) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Deletion Failed";
    }
}

// Insert a new car
if (isset($_POST['insertCarBtn'])) {
    $query = insertCar($pdo, $_POST['model'], $_POST['brand'], $_POST['rentalPrice'], $_POST['rentalId']);

    if ($query) {
        header("Location: ../viewcars.php?rentalId=" . $_POST['rentalId']); // Redirect to view cars for the specific rental
        exit(); 
    } else {
        echo "Insertion Failed";
    }
}

// Edit an existing car
if (isset($_POST['editCarBtn'])) {
    // Check if carID is provided
    if (isset($_GET['carID'])) {
        $query = updateCar($pdo, $_POST['model'], $_POST['brand'], $_POST['rentalPrice'],$_GET['rentalId'], $_GET['carID']);

        if ($query) {
            header("Location: ../viewcars.php?rentalId=" . $_GET['rentalId']); // Redirect to view cars for the specific rental
            exit(); 
        } else {
            echo "Update Failed";
        }
    } else {
        echo "No car ID provided.";
    }
}

// Delete a car
if (isset($_POST['deleteCarBtn'])) {
    $query = deleteCar($pdo, $_GET['carID']);

    if ($query) {
        header("Location: ../viewcars.php?rentalId=" . $_GET['rentalId']); // Redirect to view cars for the specific rental
        exit(); 
    } else {
        echo "Deletion Failed";
    }
}
?>
