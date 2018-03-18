<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class NavigationController extends Controller
{
    public function index($navigation_type = 'desktop')
    {
        return $this->response->array(frontend_navigation($navigation_type));
    }
}
