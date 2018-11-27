<?php
namespace wild\UserBehavior\Services;

use wild\UserBehavior\Contracts\UserScore;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model implements UserScore
{
    public function sendName(string $name)
    {
        return $name;
    }
}

?>