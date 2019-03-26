
-- -----------------------------------------------------
-- Data for platform
-- -----------------------------------------------------

INSERT INTO platform(Name)
VALUES ("Windows");

INSERT INTO platform(Name)
VALUES ("Mac");

INSERT INTO platform(Name)
VALUES ("Linux");

-- -----------------------------------------------------
-- Data for game
-- -----------------------------------------------------

INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (19.99, "Rocket League", "Sports", "PSYONIX, INC.", TRUE);

-- -----------------------------------------------------
-- Data for game
-- -----------------------------------------------------

INSERT INTO game_platform(gameID, platformID)
VALUES (1, 1);
INSERT INTO game_platform(gameID, platformID)
VALUES (1, 2);
INSERT INTO game_platform(gameID, platformID)
VALUES (1, 3);