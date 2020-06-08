<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Company\Contracts\IBranch;

class BranchController extends Controller
{

    protected $branches;

    public function __construct(IBranch $branches)
    {
        $this->branches = $branches;
    }

    public function index()
    {
        return response()->json($this->branches->allMine(), 200);
    }

    public function show($id)
    {
        $branch = $this->branches->find($id);
        $this->authorize('view', $branch);
        return response()->json($branch, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => ['required', 'unique:branches,name,NULL,id,user_id,'.auth()->user()->id]]);

        $data['user_id'] = auth()->user()->id;
        $data['name'] = $request->name;

        $branch = $this->branches->create($data);
        
        return response()->json($branch, 200);
    }

    public function update(Request $request, $id)
    {
        $branch = $this->branches->find($id);

        $this->authorize('update', $branch);
        $this->validate($request, ['name' => ['required', 'unique:branches,name,NULL,id,user_id,'.auth()->user()->id]]);

        $branch->name = $request->name;
        $branch->update();
        
        return response()->json($branch, 200);
    }

    public function destroy($id)
    {
        $branch = $this->branches->find($id);
        $this->authorize('delete', $branch);
        $branch->delete();

        return response()->json([
            'message' => 'Branch Deleted.'
        ], 200);
    }
}
