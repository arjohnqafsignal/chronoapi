<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Company\Contracts\IPosition;

class PositionController extends Controller
{
    protected $positions;

    public function __construct(IPosition $positions)
    {
        $this->positions = $positions;
    }

    public function index()
    {
        return response()->json($this->positions->allMine(), 200);
    }

    public function show($id)
    {
        $record = $this->positions->find($id);

        if($record){
            return response()->json($record, 200);
        }
        return response()->json([
            'message' => 'Position not found.'
        ], 200);
        
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => ['required', 'unique:positions,name,NULL,id,user_id,'.auth()->user()->id]]);

        $data['user_id'] = auth()->user()->id;
        $data['name'] = $request->name;
        $position = $this->positions->create($data);
        
        return response()->json($position, 200);
    }

    public function update(Request $request, $id)
    {
        
        $position = $this->positions->find($id);
        $this->authorize('update', $position);
        $this->validate($request, ['name' => ['required', 'unique:positions,name,NULL,id,user_id,'.auth()->user()->id]]);

        $position->name = $request->name;
        $position->update();
        
        return response()->json($position, 200);
    }

    public function destroy($id)
    {
        $position = $this->positions->find($id);
        $this->authorize('delete', $position);
        $position->delete();

        return response()->json([
            'message' => 'Position Deleted.'
        ], 200);
    }
}
