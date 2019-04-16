
-- shows the average price for each genre for the games on windows, ordered in ascending order of the average

SELECT genre, FORMAT(AVG(price), 2) AS AVERAGE
FROM game join game_platform using (gameID)
WHERE platformID = (SELECT platformID FROM platform WHERE name = "Windows")
GROUP BY genre
ORDER BY AVERAGE ASC;


-- shows the games that are on each platform

SELECT platform.name AS 'Platform Name', GROUP_CONCAT(game.name) as 'Game Name'
FROM game JOIN game_platform USING (gameID) JOIN platform USING (platformID)
GROUP BY platform.name;