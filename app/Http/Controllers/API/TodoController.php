<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\StoreUpdateTodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return Todo::where('user_id', Auth::id())->get();
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreUpdateTodoRequest $request)
  {
    $validated_data = $request->validated();
    $todo = new Todo($validated_data);
    $todo->user_id = Auth::id();
    $todo->save($validated_data);
    return response()->json($validated_data);
  }

  /**
   * Display the specified resource.
   */
  public function show(Todo $todo)
  {
    if (Auth::id() === $todo->user_id) {
      return response()->json($todo);
    } else {
      return response()->json(['error' => 'Unauthorized'], 403);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreUpdateTodoRequest $request, Todo $todo)
  {
    $validated_data = $request->validated();
    $todo->update($validated_data);
    return $request;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Todo $todo)
  {
    $todo->delete();
    return response()->json(['message' => 'Todo deleted successfully']);
  }
}
