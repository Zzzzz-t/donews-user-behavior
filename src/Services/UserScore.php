<?php
namespace wild\UserBehavior\Services;


use wild\UserBehavior\Contracts\UserScore;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserScoreModel extends Model implements UserScore
{
    protected $connection = "tgbus_users_behavior";

    protected $table = "user_scores";

    public static function addScore($gid, $user_id, $is_wanted, $is_played, $score, $content, $app_id)
    {
        $result = self::where("g_id", $gid)->where("app_name", $app_id)->where("u_id", $user_id)->first();
        //是否评分
        if (!$result) {
            $data['content'] = $content;
            $data['g_id'] = $gid;
            $data['u_id'] = $user_id;
            $data['is_wanted'] = $is_wanted;
            $data['is_played'] = $is_played;
            $data['score'] = $score;
            $data['app_name'] = $app_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $id = self::insertGetId($data);

            // $id = DB::getPdo()->lastInsertId();
            $data['id'] = $id;
            return $data;
        }
        return 415;
    }

    public static function getList($where, $id, $page, $page_size, $app_id, $key = 'power')
    {
        $data = self::select('id as score_id', 'u_id as uid', 'content', 'score', 'created_at', 'power', 'g_id', 'is_played')
            ->where('content', '<>', '')
            ->where('app_name', $app_id)
            ->where('g_id', $where, $id)
            ->where("is_delete", 0)
            ->orderBy($key, "desc")->offset(($page-1)*$page_size)->limit($page_size)
            ->get()->toArray();

        return $data;
    }

    public static function getListCount($where, $id, $app_id)
    {
        $count = self::where('content', '<>', '')
            ->where('app_name', $app_id)
            ->where('g_id', $where, $id)
            ->where("is_delete", 0)
            ->count();

        return $count;
    }

    public static function getUserScore($app_id, $user_id, $page, $page_size, $key = 'created_at')
    {
        $comment = self::select('id', 'u_id', 'g_id as game_id', 'score', 'content', 'created_at', 'power', 'is_played')->where("is_delete", 0)->where('u_id', $user_id)->orderBy($key,"desc")->offset(($page-1)*$page_size)->limit($page_size)->get()->toArray();

        return $comment ?? [];
    }

    public static function detail($id)
    {
        $comment = self::select('id', 'u_id as uid', 'content', 'score', 'created_at','g_id','is_played')
            ->where('id', $id)
            ->where("is_delete", 0)
            ->first();

        return $comment ?? [];
    }


    public static function played($user_id)
    {
        $count = self::where("u_id", $user_id)->where('is_played', 1)->where("is_delete", 0)->count();
        return [
            'count' => $count
        ];
    }

    public static function avg($ids, $app_id)
    {
        $score = [];
        foreach (json_decode($ids,1) as $key => $value) {
            $score[$value] = round(self::where('g_id', $value)->where("is_delete", 0)->where("is_played", 1)->where("app_name", $app_id)->avg('score'), 1) ?? 0;
        }
        return $score;
    }
    
    public static function scoreUserCount($ids, $app_id)
    {
        $count = [];
        foreach (json_decode($ids,1) as $key => $value) {
            $count[$value] = self::where('g_id', $value)->where("is_delete", 0)->where("app_name", $app_id)->count();
        }
        return $count;
    }

    public static function gameScore($id, $app_id, $page, $page_size, $key = 'power')
    {
        $data = self::where('g_id', $id)->where("app_name", $app_id)->where("is_delete", 0)->orderBy($key, "desc")->offset(($page-1)*$page_size)->limit($page_size)->get();
        return $data;
    }

    public static function most($app_id, $page, $pageSize, $key = 'power')
    {
        $forward = self::select('g_id', DB::raw('count(u_id) as total'))
                ->where('is_wanted', 1)
                ->where('created_at', '>', date('Y-m-d ' . '00:00:00', strtotime('-10 days')))
                ->where("app_name", $app_id)
                ->where("is_delete", 0)
                ->groupby('g_id')
                ->orderBy('total', 'desc')
                ->offset(($page-1)*$pageSize)->limit($pageSize)
                ->get()->toArray();

        $most = self::select('g_id', DB::raw('count(u_id) as total'))
                ->where('is_played', 1)
                ->where('created_at', '>', date('Y-m-d ' . '00:00:00', strtotime('-10 days')))
                ->where("app_name", $app_id)
                ->where("is_delete", 0)
                ->where('score', '>', 0)
                ->groupby('g_id')
                ->orderBy('total', 'desc')
                ->offset(($page-1)*$pageSize)->limit($pageSize)
                ->get()->toArray();

        return [
            'forward' => $forward,
            'most' => $most
        ];
    }

    public static function updateScore($user_id, $id, $is_wanted, $is_played, $score, $content, $app_id)
    {

        $obj = self::where("id", $id)->where("u_id",$user_id)->where("app_name", $app_id)->first();
        if(!$obj){
            return 405;
        }

        $data['content'] = $content;
        $data['is_wanted'] = $is_wanted;
        $data['is_played'] = $is_played;
        $data['score'] = $score;
        $data['updated_at'] = date('Y-m-d H:i:s');

        self::where("id",$id)->update($data);

        $comment = self::select('id', 'u_id as uid', 'content', 'score', 'created_at','g_id','is_played')
            ->where('id', $id)
            ->where("is_delete", 0)
            ->first();

        return $comment ?? [];
    }

    public static function getUserScoreInfo($user_id, $id)
    {
        return self::where("g_id", $id)->where("u_id", $user_id)->get()->toArray() ?? [];
    }
}

?>
