
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
VALUES (19.99, "Rocket League", "Racing", "PSYONIX, INC.", TRUE);

INSERT INTO game_platform(gameID, platformID)
VALUES (1, 1);
INSERT INTO game_platform(gameID, platformID)
VALUES (1, 2);
INSERT INTO game_platform(gameID, platformID)
VALUES (1, 3);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (39.99, "The Elder Scrolls V: Skyrim", "Adventure", "Bethesda Game Studios", FALSE);

INSERT INTO game_platform(gameID, platformID)
VALUES (2, 1);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (19.99, "Sekiro: Shadows Die Twice", "Action", "FromSoftware", FALSE);

INSERT INTO game_platform(gameID, platformID)
VALUES (3, 1);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (0.00, "Apex Legends", "Action", "Respawn Entertainment", TRUE);

INSERT INTO game_platform(gameID, platformID)
VALUES (4, 1);


INSERT INTO game(price, monthly_price, name, genre, developer, multiplayer)
VALUES (0.00, 14.99, "World of Warcraft", "MMORPG", "Blizzard Entertainment", TRUE);

INSERT INTO game_platform(gameID, platformID)
VALUES (5, 1);

INSERT INTO game_platform(gameID, platformID)
VALUES (5, 2);


INSERT INTO game(price, monthly_price, name, genre, developer, multiplayer)
VALUES (19.99, 14.99, "Elder Scrolls Online", "MMORPG", "Zenimax Online Studios", TRUE);

INSERT INTO game_platform(gameID, platformID)
VALUES (6, 1);

INSERT INTO game_platform(gameID, platformID)
VALUES (6, 2);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (24.99, "Descenders", "Racing", "RageSquid", FALSE);

INSERT INTO game_platform(gameID, platformID)
VALUES (7, 1);

INSERT INTO game_platform(gameID, platformID)
VALUES (7, 2);

INSERT INTO game_platform(gameID, platformID)
VALUES (7, 3);


INSERT INTO game(price, name, genre, developer, multiplayer)
VALUES (59.99, "No Man's Sky", "Adventure", "Hello Games", TRUE);

INSERT INTO game_platform(gameID, platformID)
VALUES (8, 1);