<?php

namespace App\Http\Controllers\User;

use App\Models\Employer;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\Company\Position;
use App\Rules\CheckSamePassword;
use App\Models\Company\Department;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Repositories\Company\Contracts\IEmployer;


class SettingsController extends Controller
{
    protected $employers;
    public function __construct(IEmployer $employer)
    {
        $this->employers = $employer;
    }
    
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'company_name' => ['required'],
            'industry' => ['required'],
            'location.latitude' => ['required', 'numeric', 'min:-90', 'max:90'],
            'location.longitude' => ['required', 'numeric', 'min:-180', 'max:180']
        ]);

        $location = new Point($request->location['latitude'], $request->location['longitude']);
        
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'industry' => $request->industry,
            'location' => $location
        ]);

        return new UserResource($user);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required','confirmed', new CheckSamePassword]
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['message' => 'Password Updated'], 200);
    }

    public function saveGettingStarted(Request $request)
    {
        $this->validate($request, [
            'company_name' => ['required'],
            'website' => ['required'],
            'address' => ['required'],
            'phone' => ['required']
        ]);
        $employer = $this->employers->findMine();

        $employer->company_name = $request->company_name;
        $employer->website = $request->website;
        $employer->address = $request->address;
        $employer->phone = $request->phone;

        $employer->save();

        return response()->json('Company Updated!', 200);
        

    }
}
