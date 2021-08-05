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

                        <form action="{{route('task.store')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="description"
                                           class="col-md-4 col-form-label text-md-right"><strong>{{ __('Description') }}</strong></label>
                                    <input type="text" name="description" value="{{ old('description') }}"
                                           class="form-control @error('description') is-invalid @enderror">
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="user_id"
                                           class="col-md-4 col-form-label text-md-right"><strong>{{ __('User') }}</strong></label>
                                    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                        @foreach($users as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="maximum_execution_date"
                                           class="col-md-6 col-form-label text-md-right"><strong>{{ __('Maximum execution date') }}</strong></label>
                                    <input type="datetime-local" name="maximum_execution_date"
                                           value="{{old('maximum_execution_date')}}"
                                           class="form-control @error('maximum_execution_date') is-invalid @enderror">
                                    @error('maximum_execution_date')
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
