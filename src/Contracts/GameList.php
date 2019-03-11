<?php

namespace wild\UserBehavior\Contracts;

interface GameList
{
    public static function getGameList($keyword, $page, $page_size, $type, $app_id);

    public static function getUserList($user_id, $page, $page_size, $app_id, $sort, $sortfield);

    public static function create($app_id, $user_id, $title, $content, $is_public = 0, $path);

    public static function deleteGameList($app_id, $user_id, $id);

    public static function increase($app_id, $id, $type);

    public static function getDetails($app_id, $ids);

	public static function isExistence($user_id, $id, $app_name);

}
?>