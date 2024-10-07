<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;


class TeamScopeWithNullObjects implements Scope
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
            $builder->where('team_id', $teamId)->orWhereNull('team_id');

            // if ($teamId === null) {
            //     $builder->where('team_id', null);
            // }

        }
        
        if (Auth::check() && $user->usertype=='seller') {

            $teamId = $user->team_id;
            $builder->where('team_id', $teamId)->orWhereNull('team_id');

            // if ($teamId === null) {
            //     $builder->where('team_id', null);
            // }else
            // {
                // $builder->where('team_id', $user->team_id);
            // }
            
        }

    }
}
