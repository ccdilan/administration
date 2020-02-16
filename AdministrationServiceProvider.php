<?php

namespace Administration;

use Administration\Models\Menu;
use Administration\Models\Role;
use Administration\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdministrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // register our controller
        $this->app->make('Administration\Controllers\DocumentationController');
        $this->app->bind('Administration', function ($app) {
            return new Administration;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/web.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'Administration');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->publishes([
            __DIR__ . '/Assets/js' => public_path('js'),
            __DIR__ . '/Assets/vendors' => public_path('vendors'),
            __DIR__ . '/Assets/css' => public_path('css'),
            __DIR__ . '/Assets/images' => public_path('images'),
            __DIR__ . '/Assets/fonts' => public_path('fonts'),
            __DIR__ . '/Views' => resource_path('views'),
        ], 'public');

//        View::composer('*', function ($view) {
//            $request = $this->app->request;
//            $routeName = $request->route()->getName();
//            $html = null;
//            $roots = Menu::roots()->get();
//            if (Auth::check()) {
//                foreach ($roots as $root) {
//                    $permissionList = $root->derivedPermissions();
//                    $isAllowed = app('auth')->user()->hasAnyAccess($permissionList, true);
//                    $html .= '<li class="nav-item dropdown show-on-hover">';
//
//                    if ($isAllowed) {
//                        $routeList = collect($root->descendants()->get()->pluck('url'));
//                        $isActiveParent = ($routeList->contains($routeName))?'active':null;
//
//                        $html .= " <a class='nav-link dropdown-toggle ".$isActiveParent."' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
//                        $html .= $root->title;
//                        $html .= '</a>';
//
//                        $html .= '<div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">';
//                        $html .= '<div class="sub-dropdown-menu show-on-hover">';
//
//                        foreach ($root->descendants()->get() as $child) {
//                            $childPermissionList = Menu::find($child->id)->permissions()->get()->pluck('id');
//                            $isAllowed = app('auth')->user()->hasAnyAccess($childPermissionList, true);
//                            $isActive = ($routeName == $child->url) ? 'active' : null;
//
//                            if ($isAllowed) {
//                                $html .= "<a href=" . route($child->url) . "  class='dropdown-item " . $isActive . "'>" . $child->title . "</a>";
//                            }
//                        }
//
//                        $html .= '</div>';
//                        $html .= '</div>';
//                    }
//                    $html .= '</li>';
//                }
//            }
//            View::share('menu', $html);
//        });
    }
}
