<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getClientsByType($type)
    {
        return Client::where('client_type_id', $type)
            ->whereHas('person', function ($query) {
                $query->whereNotIn('id', [1]);
            })
            ->with(['person', 'userType'])
            ->get();
    }
}
