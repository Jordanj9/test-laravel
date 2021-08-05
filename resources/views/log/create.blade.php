@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Task Logs') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('log.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="description"
                                           class="col-md-4 col-form-label text-md-right"><strong>{{ __('Comment') }}</strong></label>
                                    <input type="text" name="comment" value="{{ old('comment') }}"
                                           class="form-control @error('comment') is-invalid @enderror">
                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="date"
                                           class="col-md-4 col-form-label text-md-right"><strong>{{ __('Date') }}</strong></label>
                                    <input type="datetime-local" name="date" value="{{old('date')}}"
                                           class="form-control @error('date') is-invalid @enderror">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <br/><br/><a href="{{route('home')}}" class="btn btn-danger waves-effect">Cancel</a>
                                <button class="btn btn-primary waves-effect" type="reset">Clean Form</button>
                                <button class="btn btn-success waves-effect" type="submit">Save</button>
                            </div>
                        </form>
                        <br><h4>Task Logs</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->comment}}</td>
                                    <td>{{$item->date}}</td>
                                    <td class="d-flex justify-content-end">
                                        <form action="{{route('log.destroy',$item->id)}}" method="post"
                                              style="display: inline-block">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger">
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
