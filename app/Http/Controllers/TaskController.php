<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
  public function list()
  {
    return response()->json( Task::all()->load('category'), 200 );
  }

  public function add( Request $request )
  {
    $task = new Task();

    // Validation
    $this->validate( $request, [
      "title"      => "required|min:5|max:128|unique:tasks",
      "completion" => "numeric|integer|min:0|max:100",
      "status"     => "numeric|integer|min:1|max:2",
      "categoryId" => "required|numeric|exists:categories,id"
    ] );

    $task->title       = $request->input( "title" );
    $task->completion  = $request->input( "completion", 0 );
    $task->status      = $request->input( "status", 1 );
    $task->category_id = $request->input( "categoryId" );

    if( $task->save() )
    {
      return response()->json( $task, Response::HTTP_CREATED );
    }

    return response( "", Response::HTTP_INTERNAL_SERVER_ERROR );
  }

  public function edit( Request $request, $id )
  {
    $taskToUpdate = Task::find( $id );

    if( $taskToUpdate !== null )
    {
      if( $request->isMethod( "put" ) )
      {
        if( $request->filled( [ "title", "categoryId", "completion", "status" ] ) )
        {
          $taskToUpdate->title       = $request->input( "title" );
          $taskToUpdate->category_id = $request->input( "categoryId" );
          $taskToUpdate->completion  = $request->input( "completion" );
          $taskToUpdate->status      = $request->input( "status" );
        }
        else
        {
          return response( "", Response::HTTP_BAD_REQUEST );
        }        
      }
      else
      {
        $oneDataAtLeast = false;

        if( $request->filled('title')) 
        {
          $taskToUpdate->title = $request->input('title');
          $oneDataAtLeast = true;
        }

        if( $request->filled('categoryId') ) 
        {
          $taskToUpdate->category_id = $request->input('categoryId');
          $oneDataAtLeast = true;
        }

        if( $request->filled('completion') ) 
        {
          $taskToUpdate->completion = $request->input('completion');
          $oneDataAtLeast = true;
        }

        if( $request->filled('status') ) 
        {
          $taskToUpdate->status = $request->input('status');
          $oneDataAtLeast = true;
        }

        if( !$oneDataAtLeast )
        {
          return response( "", Response::HTTP_BAD_REQUEST );
        }
      }

      if( $taskToUpdate->save() )
      {
        return response( "", Response::HTTP_NO_CONTENT );
      }
      else
      {
        return response( "", Response::HTTP_INTERNAL_SERVER_ERROR );
      }
    }

    //
    return response( "", Response::HTTP_NOT_FOUND );
  }

  public function delete( $id )
  {
    Task::destroy( $id );
    return response()->json( null, 204 );
  }
}
