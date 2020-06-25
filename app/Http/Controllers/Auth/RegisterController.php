<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Employer;
use App\Models\Logs\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Grimzy\LaravelMysqlSpatial\Types\Point;

use Illuminate\Http\Request;

class RegisterController extends Controller
{

    use RegistersUsers;


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        DB::beginTransaction();
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        if($user)
        {
            if($data['user_type'] == 'employer')
            {
                $employer = Employer::create([
                    'user_id' => $user->id,
                    'company_name' => $data['company_name']
                ]);
            }
        }
        else
        {
            DB::rollBack();
        }
        $position = new Point($data['lat'], $data['long']);

        Auth::create([
            'user_id' => $user->id,
            'event' => 'Account Created',
            'ip_address' => $data['ip_address'],
            'position' => $position
        ]);
        
        DB::commit();
        return $user;
    }

    protected function registered(Request $request, User $user)
    {
        return response()->json($user, 200);
    }
}
