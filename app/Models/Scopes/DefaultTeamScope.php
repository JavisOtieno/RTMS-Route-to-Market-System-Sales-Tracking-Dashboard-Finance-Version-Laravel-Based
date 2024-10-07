<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;


class DefaultTeamScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {

        $user = Auth::user();
        // if (Auth::check() && $user->usertype=='admin') {
        //     // Admins see everything
        //     return;
        // }
        
        if (Auth::check() && $user->usertype=='teamlead') {

            $teamId = $user->team_id;
            $builder->where('team_id', $teamId)->whereNotNull('team_id');

        }
        
        if (Auth::check() && $user->usertype=='seller') {

            //allow users who are currently testing with the null
            //to be removed
            //IDEAL
            // $teamId = $user->team_id;
            // $builder->where('team_id', $teamId);
            //IDEAL
            $teamId = $user->team_id;
            $builder->where('user_id', $user->id)->where('team_id', $teamId)->orWhereNull('team_id');

        }

    }
}
