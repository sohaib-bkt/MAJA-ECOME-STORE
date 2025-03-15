<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        view()->composer('*', function ($view) {
            $wishlist = session()->get('wishlist', []);
            $view->with('wishlistCount', count($wishlist));
        });
    }
}
