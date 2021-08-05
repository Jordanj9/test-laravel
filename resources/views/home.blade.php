@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Task List') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                            <div class="col-md-12 d-flex justify-content-end" style="padding-bottom: 10px" >
                                <a class="btn btn-success" href="{{route('task.create')}}" style="text-decoration: none">New Task</a>
                            </div>
                        <div class="row clearfix">
                            @foreach($tasks as $task)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding-bottom: 15px">
                                    <div class="card border-{{$task->is_task_expired ? 'danger':'primary'}}"
                                         style="width: 18rem;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title">{{$task->user->name}}</h5>
                                                <div class="col-md-2">
                                                <span>
                                                    <a href="{{route('log.new',$task->id)}}" title="New Log"
                                                       style="text-decoration: none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </a>
                                                </span>
                                                    <span>
                                                        <form action="{{route('task.destroy',$task->id)}}"
                                                              method="post" style="display: inline-block">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <button type="submit" title="Task Delete"
                                                                    style="background: 0px;border: 0px;width: 15px">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     style="width: 15px"
                                                                     fill="none" viewBox="0 0 24 24"
                                                                     stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                </span>
                                                </div>
                                            </div>
                                            <p class="card-text">{{$task->description}}</p>
                                            <a href="#"
                                               class="btn btn-{{$task->is_task_expired ? 'danger':'primary'}}">{{$task->maximum_execution_date}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
