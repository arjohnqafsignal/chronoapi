<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Company\Contracts\IDepartment;


class DepartmentController extends Controller
{

    protected $departments;

    public function __construct(IDepartment $departments)
    {
        $this->departments = $departments;
    }

    public function index()
    {
        return response()->json($this->departments->allMine(), 200);
    }

    public function show($id)
    {
        $department = $this->departments->find($id);
        $this->authorize('view', $department);
        return response()->json($department, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => ['required', 'unique:departments,name,NULL,id,user_id,'.auth()->user()->id]]);

        $data['user_id'] = auth()->user()->id;
        $data['name'] = $request->name;

        $department = $this->departments->create($data);
        
        return response()->json($department, 200);
    }

    public function update(Request $request, $id)
    {
        $department = $this->departments->find($id);

        $this->authorize('update', $department);
        $this->validate($request, ['name' => ['required', 'unique:departments,name,NULL,id,user_id,'.auth()->user()->id]]);

        $department->name = $request->name;
        $department->update();
        
        return response()->json($department, 200);
    }

    public function destroy($id)
    {
        $department = $this->departments->find($id);
        $this->authorize('delete', $department);
        $department->delete();

        return response()->json([
            'message' => 'Department Deleted.'
        ], 200);
    }
}
