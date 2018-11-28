<?php

namespace wild\UserBehavior\Contracts;

interface UserScore
{
	public static function addScore($gid, $user_id, $is_wanted, $is_played, $score, $content, $app_id);

	public static function getList($where, $id, $page, $page_size, $app_id, $key = 'power');

	public static function getUserScore($app_id, $user_id, $page, $page_size, $key = 'created_at');

	public static function detail($id);

	public static function played($user_id);

	public static function avg($ids, $app_id);

	public static function gameScore($id, $app_id, $page, $page_size, $key = 'power');

	public static function most($app_id, $page, $pageSize, $key = 'power');
}
?>