<?php
// app/Models/Scopes/OrganizationScope.php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class OrganizationScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        
        if (Auth::check()) {
            if(Auth::user()->usertype=="systemadmin"){
            
            }else{
                
                // $builder->where('organization_id', Auth::user()->organization_id);

                $table = $builder->getModel()->getTable(); // Get model's table dynamically
                $builder->where("{$table}.organization_id", Auth::user()->organization_id);
            }
        }

        
    }
    
}


