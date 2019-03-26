
-- -----------------------------------------------------
-- Drop Existing Constraints And Tables
-- -----------------------------------------------------

ALTER TABLE game_platform
DROP FOREIGN KEY FK_gp_platformID;

ALTER TABLE game_platform
DROP FOREIGN KEY FK_gp_gameID;

ALTER TABLE order_game
DROP FOREIGN KEY FK_og_gameID;

ALTER TABLE order_game
DROP FOREIGN KEY FK_og_orderid;

ALTER TABLE cOrder
DROP FOREIGN KEY FK_cOrder_customerID;

DROP TABLE IF EXISTS platform;
DROP TABLE IF EXISTS game_platform;
DROP TABLE IF EXISTS game;
DROP TABLE IF EXISTS order_game;
DROP TABLE IF EXISTS cOrder;
DROP TABLE IF EXISTS customer;

-- -----------------------------------------------------
-- Create Tables
-- -----------------------------------------------------

CREATE TABLE platform(
    platformID INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (platformID)
)ENGINE InnoDB;

CREATE TABLE game_platform(
    gameID INT(11) NOT NULL,
    platformID INT(11) NOT NULL,
    PRIMARY  KEY (gameID, platformID)
)ENGINE = InnoDB;

CREATE TABLE game(
    gameID INT(11) NOT NULL AUTO_INCREMENT,
    price DECIMAL(13,2) NOT NULL,
    monthly_price DECIMAL(13,2) NULL DEFAULT NULL,
    name VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    developer VARCHAR(255) NOT NULL,
    multiplayer BOOLEAN NOT NULL,
    PRIMARY KEY (gameID)
)ENGINE = InnoDB;

CREATE TABLE order_game(
    orderID INT(11) NOT NULL,
    gameID INT(11) NOT NULL,
    startDate DATE NULL DEFAULT NULL,
    endDate DATE NULL DEFAULT NULL,
    PRIMARY KEY (orderID, gameID)
)ENGINE = InnoDB;

CREATE TABLE cOrder(
    orderID INT(11) NOT NULL AUTO_INCREMENT,
    customerID INT(11) NOT NULL,
    cost DECIMAL(13,2) NOT NULL,
    orderDate DATE NOT NULL,
    PRIMARY KEY (orderID)
)ENGINE = InnoDB;

CREATE TABLE customer(
    customerID INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    PRIMARY KEY (customerID)
)ENGINE = InnoDB;



-- -----------------------------------------------------
-- Create Constraints
-- -----------------------------------------------------

ALTER TABLE game_platform
ADD CONSTRAINT FK_gp_platformID
FOREIGN KEY (platformID) REFERENCES platform(platformID);

ALTER TABLE game_platform
ADD CONSTRAINT FK_gp_gameID
FOREIGN KEY (gameID) REFERENCES game(gameID);

ALTER TABLE order_game
ADD CONSTRAINT FK_og_gameID
FOREIGN KEY (gameID) REFERENCES game(gameID);

ALTER TABLE order_game
ADD CONSTRAINT FK_og_orderid
FOREIGN KEY (orderID) REFERENCES cOrder(orderID);

ALTER TABLE cOrder
ADD CONSTRAINT FK_cOrder_customerID
FOREIGN KEY (customerID) REFERENCES customer(customerID);