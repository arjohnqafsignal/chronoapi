<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Company\Contracts\IEmployee;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeAccount;

use App\Http\Requests\Company\CreateEmployeeRequest;

class EmployeeController extends Controller
{
    protected $employees;

    public function __construct(IEmployee $employees)
    {
        $this->employees = $employees;
    }

    public function store(CreateEmployeeRequest $request)
    {
        
        $validated = $request->validated();
        
        if($validated)
        {
            $password = Str::random('8');

            $data = [
                'user_id' => auth()->user()->id,
                'employee_id' => $request['employee_id'],
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'password' => Hash::make($password),
                'birthdate' => $request['birthdate'],
                'gender' => $request['gender']
            ];

            $employee = $this->employees->register($data);

            $mail['url'] = config('app.client_url');
            $mail['password'] = $password;
            $mail['employee'] = $employee;
            
            Mail::to($request->email)->send(new EmployeeAccount($mail));

            return response()->json($employee, 200);
        }

    }

}
