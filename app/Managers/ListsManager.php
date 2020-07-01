<?php


namespace App\Managers;


use App\User;
use Illuminate\Support\Facades\Auth;

class ListsManager
{

    public static function getMy(bool $activities = false){
        if(($user = User::find(Auth::id())) === null){
            return -1;
        }
        $lists = $user->lists();
        if($activities){
            $lists->with('activities');
        }
        return $lists->get();
    }

    public static function getExplore(){

    }

    public static function getCanCopy(){

    }
}
