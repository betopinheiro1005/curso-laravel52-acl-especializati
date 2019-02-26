<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Post;
use App\User;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        /*
         \App\Post::class => \App\Policies\PostPolicy::class,
         */
    ];

    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /*
        $gate->define('update-post', function(User $user, Post $post){
            return $user->id == $post->user_id;
        });
         */
        
        $permissions = Permission::with('roles')->get();
        foreach( $permissions as $permission )
        {
            $gate->define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }

        $gate->before(function(User $user, $ability){
            
            if ( $user->hasAnyRoles('adm') )
                return true;
            
        });
    }
}
