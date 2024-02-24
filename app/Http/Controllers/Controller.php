<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\IdentityType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;
use PHPUnit\Framework\MockObject\Builder\Identity;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getIdentityTypes()
    {
        return IdentityType::all();
    }


    public function getClientsByType($type)
    {
        return Client::where('client_type_id', $type)
            ->whereHas('person', function ($query) {
                $query->whereNotIn('id', [1]);
            })
            ->with(['person', 'userType'])
            ->get();
    }

    public function storeDataClients($validatedData, array $params)
    {
        try {

            if (User::where('email', $validatedData['email'])->exists()) {
                return redirect()->route($params['prevUrl'])
                    ->with('error', 'El correo electrónico ya está registrado. Por favor, utilice otro correo electrónico.');
            } else {
                
                $user = User::create($validatedData);
                $person = $user->person()->create($validatedData);
                $faker = Faker::create();

                $person->client()->create([
                    'person_id' => $person->id,
                    'client_type_id' => strval($params['type_user']),
                    'user_type_id' =>  strval($params['type_user']),
                    'token' => strval($faker->unique()->sha256())
                ]);

                return redirect()->route($params['laterUrl'])->with('success', 'Registro creado correctamente');
            }
        } catch (\Throwable $th) {
            Log::error('Error creando registro de petición:', [
                'message' => $th->getMessage(),
                'data' => $validatedData,
            ]);

            return redirect()->route($params['laterUrl'])->with('error', 'Ocurrió un error al crear el registro. Por favor, inténtelo de nuevo.');
        }
    }
}
