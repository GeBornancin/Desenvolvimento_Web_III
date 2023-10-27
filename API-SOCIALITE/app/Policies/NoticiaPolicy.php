<?php

namespace App\Policies;

use App\Models\Noticia;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticiaPolicy
{
    use HandlesAuthorization;

    
    public function viewAny(User $user)
    {
        //
    }

    
    public function view(User $user, Noticia $noticia)
    {
        return $user->id === $noticia->user_id || $user->hasPermissionTo('viewNoticia');
    }

    
    public function create(User $user)
    {
        return $user->hasPermissionTo('createNoticia');
    }

    
    public function update(User $user, Noticia $noticia)
    {
        return $user->id === $noticia->user_id || $user->hasPermissionTo('updateNoticia');
    }

    
    public function delete(User $user, Noticia $noticia)
    {
        return $user->id === $noticia->user_id || $user->hasPermissionTo('deleteNoticia');
        //return false;
    }

    
    public function restore(User $user, Noticia $noticia)
    {
        //
    }

    
    public function forceDelete(User $user, Noticia $noticia)
    {
        //
    }

    
}