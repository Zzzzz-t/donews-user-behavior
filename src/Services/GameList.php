<?php
namespace sen\UserBehavior\Services;

use sen\UserBehavior\Contracts\GameList;
use Illuminate\Database\Eloquent\Model;

class GameList extends Model implements GameList
{
    public function sendName(string $name)
    {
        return $name;
    }
}

?>