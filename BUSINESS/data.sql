CREATE TABLE rentals (
    rentalId INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(50),
    contactNumber VARCHAR(50),
    rentalDate DATE,
    returnDate DATE,
    dateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cars (
    carID INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(100),
    brand VARCHAR(50),
    rentalPrice DECIMAL(8,2),
    rentalId INT,
    dateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);






