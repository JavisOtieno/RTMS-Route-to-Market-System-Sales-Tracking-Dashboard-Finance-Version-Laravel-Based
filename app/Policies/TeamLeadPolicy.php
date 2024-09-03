<?php

namespace App\Policies;

use App\Models\User;

class TeamLeadPolicy
{
    public function view(User $user, $model)
    {
        // All users can view if model has a team_id or if usertype is admin or seller
        return $user->usertype === 'admin' 
            || $user->usertype === 'seller' 
            || ($user->usertype === 'teamlead' && $model->team_id !== null);
    }

    public function update(User $user, $model)
    {
        // Only admins and sellers can update
        return $user->usertype === 'admin' || 
        ($user->usertype === 'teamlead' && $model->team_id !== null); 
        // || $user->usertype === 'seller';
    }

    public function delete(User $user, $model)
    {
        // Only admins and sellers can delete
        return $user->usertype === 'admin' ||
        ($user->usertype === 'teamlead' && $model->team_id !== null); 
        // || $user->usertype === 'seller';
    }

    // Add more methods as necessary (e.g., create, etc.)
}
