select platform.name Name, group_concat(distinct game.genre) Genre
from platform
natural join game_platform
natual join game
where multiplayer = True
group by platform.name;
