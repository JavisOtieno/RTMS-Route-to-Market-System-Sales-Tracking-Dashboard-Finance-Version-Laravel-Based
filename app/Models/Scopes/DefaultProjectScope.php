<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;


class ProjectScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {

        $user = Auth::user()->id;
        // if (Auth::check() && $user->usertype=='admin') {
        //     // Admins see everything
        //     return;
        // }
        
        if (Auth::check() && $user=='teamlead') {
            $projectId = $user->project_id;
            $builder->where('project_id', $projectId);
        }
        
        if (Auth::check() && $user=='seller') {
            $projectId = $user->project_id;
            $builder->where('project_id', $projectId);
            if ($projectId === null) {
                $builder->where('project_id', null);
            }else{
                $builder->where('project_id', $user->project_id);
            }
        }

    }
}
