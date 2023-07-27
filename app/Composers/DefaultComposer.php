<?php namespace App\Composers;

use Illuminate\Support\Facades\Auth;


class DefaultComposer
{

    static $user;



    public function compose($view)
    {

      if (Auth::check()) {
        if (static::$user)
        {
          return  $view->with('user',static::$user);
        }
        static::$user =  Auth::user();
        return  $view->with('user',static::$user);
      }
    }
}
