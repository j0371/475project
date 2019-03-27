
-- -----------------------------------------------------
-- Data for platform
-- -----------------------------------------------------

INSERT INTO platform(Name) -- Platform 1
VALUES ("Windows");

INSERT INTO platform(Name) -- Platform 2
VALUES ("Mac");

INSERT INTO platform(Name) -- Platform 3
VALUES ("Linux");

-- -----------------------------------------------------
-- Data for game, and game_platform
-- -----------------------------------------------------

INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (19.99, "Rocket League", "Racing", "PSYONIX, INC.", TRUE); -- Game 1

    INSERT INTO game_platform(gameID, platformID)
    VALUES (1, 1);
    INSERT INTO game_platform(gameID, platformID)
    VALUES (1, 2);
    INSERT INTO game_platform(gameID, platformID)
    VALUES (1, 3);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (39.99, "The Elder Scrolls V: Skyrim", "Adventure", "Bethesda Game Studios", FALSE); -- Game 2

    INSERT INTO game_platform(gameID, platformID)
    VALUES (2, 1);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (19.99, "Sekiro: Shadows Die Twice", "Action", "FromSoftware", FALSE); -- Game 3

    INSERT INTO game_platform(gameID, platformID)
    VALUES (3, 1);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (0.00, "Apex Legends", "Action", "Respawn Entertainment", TRUE); -- Game 4

    INSERT INTO game_platform(gameID, platformID)
    VALUES (4, 1);


INSERT INTO game(price, monthly_price, name, genre, developer, multiplayer)
VALUES (0.00, 14.99, "World of Warcraft", "MMORPG", "Blizzard Entertainment", TRUE); -- Game 5

    INSERT INTO game_platform(gameID, platformID)
    VALUES (5, 1);
    INSERT INTO game_platform(gameID, platformID)
    VALUES (5, 2);


INSERT INTO game(price, monthly_price, name, genre, developer, multiplayer)
VALUES (19.99, 14.99, "Elder Scrolls Online", "MMORPG", "Zenimax Online Studios", TRUE); -- Game 6

    INSERT INTO game_platform(gameID, platformID)
    VALUES (6, 1);
    INSERT INTO game_platform(gameID, platformID)
    VALUES (6, 2);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (24.99, "Descenders", "Racing", "RageSquid", FALSE); -- Game 7

    INSERT INTO game_platform(gameID, platformID)
    VALUES (7, 1);
    INSERT INTO game_platform(gameID, platformID)
    VALUES (7, 2);
    INSERT INTO game_platform(gameID, platformID)
    VALUES (7, 3);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (59.99, "No Man's Sky", "Adventure", "Hello Games", TRUE); -- Game 8

    INSERT INTO game_platform(gameID, platformID)
    VALUES (8, 1);

-- -----------------------------------------------------
-- Data for customer, orders, and order_game
-- -----------------------------------------------------

INSERT INTO customer(email, name, address)
VALUES ('rWilliams@gmail.com', 'Robert Williams', '1545 Oaktree Rd.'); -- Customer 1

    INSERT INTO cOrder(customerID, cost, orderDate) -- Order 1
    VALUES (1, 39.98, '2019-03-26');

        INSERT INTO order_game(orderID, gameID)
        VALUES (1, 1);
        INSERT INTO order_game(orderID, gameID)
        VALUES (1, 3);

INSERT INTO customer(email, name, address)
VALUES('qwerty@yahoo.com', 'Michael Thompson', '7623 Anderson Ave.'); -- Customer 2

    INSERT INTO cOrder(customerID, cost, orderDate) -- Order 2
    VALUES (2, 49.97, '2019-02-20');

        INSERT INTO order_game(orderID, gameID, StartDate, EndDate)
        VALUES (2, 6, '2019-02-20', '2019-4-20');

    INSERT INTO cOrder(customerID, cost, orderDate) -- Order 3
    VALUES (2, 0.00, '2019-2-28');

        INSERT INTO order_game(orderID, gameID)
        VALUES (3, 4);

INSERT INTO customer(email, name, address)
VALUES('redwood4323@gmail.com', 'Camilla Robinson', '7699 SW. Creek Street'); -- Customer 3