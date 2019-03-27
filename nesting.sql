select game.name Name
from game
where game.gameID = (
  select game_platform.gameID
  from game_platform
  natural join platform
  where platform.name = "Linux"
);
