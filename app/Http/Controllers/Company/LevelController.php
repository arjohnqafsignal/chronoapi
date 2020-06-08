<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Company\Contracts\ILevel;

class LevelController extends Controller
{
   
    protected $levels;

    public function __construct(ILevel $levels)
    {
        $this->levels = $levels;
    }

    public function index()
    {
        return response()->json($this->levels->allMine(), 200);
    }

    public function show($id)
    {
        $level = $this->levels->find($id);
        $this->authorize('view', $level);
        return response()->json($level, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => ['required', 'unique:levels,name,NULL,id,user_id,'.auth()->user()->id]]);

        $data['user_id'] = auth()->user()->id;
        $data['name'] = $request->name;

        $level = $this->levels->create($data);
        
        return response()->json($level, 200);
    }

    public function update(Request $request, $id)
    {
        $level = $this->levels->find($id);

        $this->authorize('update', $level);
        $this->validate($request, ['name' => ['required', 'unique:levels,name,NULL,id,user_id,'.auth()->user()->id]]);

        $level->name = $request->name;
        $level->update();
        
        return response()->json($level, 200);
    }

    public function destroy($id)
    {
        $level = $this->levels->find($id);
        $this->authorize('delete', $level);
        $level->delete();

        return response()->json([
            'message' => 'Level Deleted.'
        ], 200);
    }
}
