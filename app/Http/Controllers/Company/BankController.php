<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Company\Contracts\IBank;

class BankController extends Controller
{
    protected $banks;

    public function __construct(IBank $banks)
    {
        $this->banks = $banks;
    }

    public function index()
    {
        return response()->json($this->banks->allMine(), 200);
    }

    public function show($id)
    {
        $bank = $this->banks->find($id);
        $this->authorize('view', $bank);
        return response()->json($bank, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                        'name' => ['required', 'unique:banks,name,NULL,id,user_id,'.auth()->user()->id],
                        'account_number' => ['required']
                        ]);

        $data['user_id'] = auth()->user()->id;
        $data['name'] = $request->name;
        $data['account_number'] = $request->account_number;

        $bank = $this->banks->create($data);
        
        return response()->json($bank, 200);
    }

    public function update(Request $request, $id)
    {
        $bank = $this->banks->find($id);

        $this->authorize('update', $bank);
        $this->validate($request, [
            'name' => ['required', 'unique:banks,name,NULL,id,user_id,'.auth()->user()->id],
            'account_number' => ['required']
            ]);

        $bank->name = $request->name;
        $bank->update();
        
        return response()->json($bank, 200);
    }

    public function destroy($id)
    {
        $bank = $this->banks->find($id);
        $this->authorize('delete', $bank);
        $bank->delete();

        return response()->json([
            'message' => 'Bank Deleted.'
        ], 200);
    }
}
