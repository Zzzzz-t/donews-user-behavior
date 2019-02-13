<?php
namespace wild\UserBehavior\Services;

use wild\UserBehavior\Contracts\GameList;
use Illuminate\Database\Eloquent\Model;

class GameListImages extends Model
{
	protected $connection = "tgbus_users_behavior";

	protected $table = "gamelist_images";

    // public static function gamelist(string $name)
    // {
    //     return self::get()->toArray();
    // }
}

?>