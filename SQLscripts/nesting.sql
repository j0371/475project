select platformID
from game_platform
where gameID = (
  select gameID
  from game
  where gameID = 1
);
