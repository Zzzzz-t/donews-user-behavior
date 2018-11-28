<?php

namespace wild\UserBehavior\Contracts;

interface GameListGames
{
    public static function gamesCount($id, $app_id);

    public static function gameCollection($app_id, $list_id, $game_id);

    public static function deleteGame($app_id, $list_id, $game_id);
}
?>