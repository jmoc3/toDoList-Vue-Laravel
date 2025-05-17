<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Todo::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "descripcion"=>'required|min:3|max:60',
            "user_id"=>'exists:users,id'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],422);
        }
        $validated = $validator -> validated();

        return Todo::create($validated); 

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $validator = Validator::make($request->all(),[
            "descripcion"=>'required|min:15|max:60',
            "user_id"=>'exists:users,id'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],422);
        }
        $validated = $validator -> validated();

        $todo->update($validated);

        return response()->json(["message"=>"Updated successfully"]);
        
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {   
        $todo->delete();
        return response()->json(["message"=>"Delete Successfully"]);
    }
}
