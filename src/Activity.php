<?php
namespace Tuto1902\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Tuto1902\Activity\ActivityLog;

trait Activity {

    public static function log($action,$model){
        //who
        $userNameColumn = config('activity.user_name_column');
        $user = isset(Auth::user()->$userNameColumn) ? Auth::user()->$userNameColumn : 'guest';
        $ip = Request::getClientIP();

        //what
        $modelName = class_basename($model);
        $modelId   = $model->getKey();


        //how
        $payload = json_encode($model->getDirty());

        ActivityLog::create([
            'user'=>$user,
            'ip_address'=>$ip,
            'model_name'=>$modelName,
            'model_id'=>$modelId,
            'payload'=>$payload,
            'action'=> $action

        ]);

    }

    public static function bootActivity(){
        static::created(function($model){
            static::log("created",$model);
        });

        static::updated(function($model){
            static::log("updated",$model);
        });

        static::deleted(function($model){
            static::log("deleted",$model);
        });
    }
}

?>
