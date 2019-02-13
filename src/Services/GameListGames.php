<?php
namespace wild\UserBehavior\Services;

use wild\UserBehavior\Contracts\GameListGames;
use Illuminate\Database\Eloquent\Model;

class GameListGamesModel extends Model implements GameListGames
{
	protected $connection = "tgbus_users_behavior";

	protected $table = "game_list_games";

    public static function gamesCount($id, $app_id)
    {
    	$count = self::where('l_id', $id)->where("app_name", $app_id)->count();
    	 return [
            'count' => $count
        ];
    }

    public static function gameCollection($app_id, $list_id, $game_id)
    {
    	$game = self::where("l_id", $game_id)->where("app_name", $app_id)->where("g_id", $game_id)->first();
    	if($game){
    		return false;
    	}

    	$data['g_id'] = $game_id;
    	$data['l_id'] = $list_id;
    	$data['app_name'] = $app_id;
    	$data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        self::insert($data);

        return true;
    }

    //游戏单中删除游戏
    public static function deleteGame($app_id, $list_id, $game_id)
    {
        $res = self::where("l_id", $game_id)->where("app_name", $app_id)->where("g_id", $game_id)->delete();
        if(!$res){
            return false;
        }
        return true;
    }
}

?>