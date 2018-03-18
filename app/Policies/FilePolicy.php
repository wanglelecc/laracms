<?php

namespace App\Policies;

use App\Models\User;
use App\Models\File;

class FilePolicy extends Policy
{
    public function update(User $user, File $file)
    {
        // return $file->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, File $file)
    {
        return true;
    }
}
