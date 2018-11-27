<?php
namespace sen\UserBehavior\Services;

use sen\UserBehavior\Contracts\UserScore;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model implements UserScore
{
    public function sendName(string $name)
    {
        return $name;
    }
}

?>