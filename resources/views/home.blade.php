@extends('layouts.app')

@section('title', 'Todo App Laravel')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3">
      
      <div class="my-3">
        
        @if (count($todos) > 0)

          <ul class="list-group">
          @foreach ($todos as $todo)

            <li class="list-group-item">
              <div>
                <a data-toggle="collapse" href="#collapse-id-{{ $todo->id }}">{{ $todo->title }}</a>
                <div class="btn-group btn-group-sm float-right" role="group" aria-label="Basic example">
                  <a href='/todo/{{ $todo->id }}' 
                     class="btn btn-secondary"><i class="fa fa-pencil"></i>
                  </a>
                  <a class="btn btn-secondary todo-delete-btn"
                    onclick="event.preventDefault();
                    document.getElementById('delete-form-{{$todo->id}}').submit();">
                    <i class="fa fa-trash"></i> 
                  </a>
                  <form id="delete-form-{{ $todo->id }}" 
                    + action="/todo/{{$todo->id}}"
                    method="post">
                    @csrf @method('DELETE')
                  </form>
                </div>
              </div>
              <div class="collapse" id="collapse-id-{{ $todo->id }}">
                <div class="card card-body">
                  <div class="todo-description">{{ $todo->description }}</div>
                  <hr>
                  <p>Status: {{ $todo->status }}</p>
                  <p title="{{ $todo->created_at }}">Created: {{ $todo->created_at->diffForHumans() }}</p>
                </div>
              </div>
            </li>

          @endforeach
          </ul>

        @else
          <p class="lead">No ACTIVE todo tasks</p>
        @endif

      </div>

    </div>
  </div>
</div>
@endsection