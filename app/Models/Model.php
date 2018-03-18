<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use App\Models\Traits\WithOrderHelper;

class Model extends EloquentModel
{
    use WithOrderHelper;
}
