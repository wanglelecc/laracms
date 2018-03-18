<?php

namespace App\Observers;

use App\Models\File;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class FileObserver
{
    public function creating(File $file)
    {
        $file->status = '0';
        $file->created_op || $file->created_op = Auth::id();
    }

    public function updating(File $file)
    {
    }

    public function saving(File $file){

    }
}