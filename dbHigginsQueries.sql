
-- shows the average price for each genre, ordered in ascending order of the average

SELECT genre, FORMAT(AVG(price), 2) AS AVERAGE
FROM game
GROUP BY genre
ORDER BY AVERAGE ASC;

-- shows the games that are on each platform

SELECT platform.name AS 'Platform Name', GROUP_CONCAT(game.name) as 'Game Name'
FROM game JOIN game_platform USING (gameID) JOIN platform USING (platformID)
GROUP BY platform.name;