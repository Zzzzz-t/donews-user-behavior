<?php
namespace wild\UserBehavior\Providers;

use Illuminate\Support\ServiceProvider;
use wild\UserBehavior\Contracts\GameList;
use wild\UserBehavior\Contracts\UserScore;
use wild\UserBehavior\Contracts\GameListGames;

use wild\UserBehavior\Services\GameListModel;
use wild\UserBehavior\Services\UserScoreModel;
use wild\UserBehavior\Services\GameListGamesModel;

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
            return new GameListModel();
        });
        $this->app->singleton(UserScore::class, function ($app) {
            return new UserScoreModel();
        });
        $this->app->singleton(GameListGames::class, function ($app) {
            return new GameListGamesModel();
        });
    }

    public function provides()
    {
        return [
            GameList::class,
            UserScore::class,
            GameListGames::class
        ];
    }

}

?>