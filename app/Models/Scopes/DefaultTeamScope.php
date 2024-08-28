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

        $user = Auth::user()->id;
        // if (Auth::check() && $user->usertype=='admin') {
        //     // Admins see everything
        //     return;
        // }
        
        if (Auth::check() && $user=='teamlead') {
            $teamId = $user->team_id;
            $builder->where('team_id', $teamId);
        }
        
        if (Auth::check() && $user=='seller') {
            $teamId = $user->team_id;
            $builder->where('team_id', $teamId);
            if ($teamId === null) {
                $builder->where('team_id', null);
            }else{
                $builder->where('team_id', $user->team_id);
            }
        }

    }
}
