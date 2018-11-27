<?php
namespace wild\UserBehavior\Services;

use wild\UserBehavior\Contracts\GameList;
use Illuminate\Database\Eloquent\Model;

class GameList extends Model implements GameList
{
    public function sendName(string $name)
    {
        return $name;
    }
}

?>