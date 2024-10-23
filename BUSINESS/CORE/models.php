<?php

// Insert a new car
function insertCar($pdo, $model, $brand, $rentalPrice, $rentalId) {
    $sql = "INSERT INTO cars (model, brand, rentalPrice, rentalId) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$model, $brand, $rentalPrice, $rentalId]);

    return $executeQuery;
}

// Update an existing car
function updateCar($pdo, $model, $brand, $rentalPrice, $rentalId, $carID) {
    $sql = "UPDATE cars
            SET model = ?, brand = ?, rentalPrice = ?, rentalId = ?
            WHERE carID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$model, $brand, $rentalPrice, $rentalId, $carID]);

    return $executeQuery;
}

// Delete a car
function deleteCar($pdo, $carID) {
    $sql = "DELETE FROM cars WHERE carID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$carID]);

    return $executeQuery;
}

// Get all cars
function getAllCars($pdo) {
    $sql = "SELECT * FROM cars";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}

// Get a car by ID
function getCarByID($pdo, $carID) {
    $sql = "SELECT * FROM cars WHERE carID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$carID]);

    return $stmt->fetch();
}

// Insert a new rental
function insertRental($pdo, $fullName, $contactNumber, $rentalDate, $returnDate) {
    $sql = "INSERT INTO rentals (fullName, contactNumber, rentalDate, returnDate) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$fullName, $contactNumber, $rentalDate, $returnDate]);

    return $executeQuery;
}

// Update an existing rental
function updateRental($pdo, $fullName, $contactNumber, $rentalDate, $returnDate, $rentalId) {
    $sql = "UPDATE rentals
            SET fullName = ?, contactNumber = ?, rentalDate = ?, returnDate = ?
            WHERE rentalId = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$fullName, $contactNumber, $rentalDate, $returnDate, $rentalId]);

    return $executeQuery;
}

// Delete a rental
function deleteRental($pdo, $rentalId) {
    // First, delete all cars related to the rental
    $deleteCarsSQL = "DELETE FROM cars WHERE rentalId = ?";
    $deleteStmt = $pdo->prepare($deleteCarsSQL);
    $executeDeleteCarsQuery = $deleteStmt->execute([$rentalId]);

    if ($executeDeleteCarsQuery) {
        // Then, delete the rental
        $sql = "DELETE FROM rentals WHERE rentalId = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$rentalId]);

        return $executeQuery;
    }
    return false;
}

// Get all rentals
function getAllRentals($pdo) {
    $sql = "SELECT * FROM rentals";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}

// Get a rental by ID
function getRentalByID($pdo, $rentalId) {
    $sql = "SELECT * FROM rentals WHERE rentalId = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rentalId]);

    return $stmt->fetch();
}

// Get all cars by rental ID
function getCarsByRental($pdo, $rentalId) {
    $sql = "SELECT cars.carID, cars.model, cars.brand, cars.rentalPrice, cars.dateAdded,
                   rentals.fullName AS Rental_Owner
            FROM cars
            JOIN rentals ON cars.rentalId = rentals.rentalId
            WHERE cars.rentalId = ?
            ORDER BY cars.model";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rentalId]);

    return $stmt->fetchAll();
}

?>
