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

DROP TABLE platform;
DROP TABLE game_platform;
DROP TABLE game;
DROP TABLE order_game;
DROP TABLE cOrder;
DROP TABLE customer;