<?php
namespace wild\UserBehavior\Providers;

use Illuminate\Support\ServiceProvider;
use wild\UserBehavior\Contracts\GameList;
use wild\UserBehavior\Contracts\UserScore;
use wild\UserBehavior\Services\TestName;
use wild\UserBehavior\Services\TestName;

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