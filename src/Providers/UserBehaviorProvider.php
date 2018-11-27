<?php
namespace sen\UserBehavior\Providers;

use Illuminate\Support\ServiceProvider;
use sen\UserBehavior\Contracts\GameList;
use sen\UserBehavior\Contracts\UserScore;
use sen\UserBehavior\Services\TestName;
use sen\UserBehavior\Services\TestName;

class UserBehaviorProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GameList::class, function ($app) {
            return new GameList();
        });
        $this->app->singleton(UserScore::class, function ($app) {
            return new UserScore();
        });
    }

    public function provides()
    {
        return [
            GameList::class,
            UserScore::class
        ];
    }

}

?>