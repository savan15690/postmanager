@extends('layouts.mainapp')

@section('content')
<div class="container">

    {{-- For Displaying Success Message if any --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- For Displaying Fail Message if any --}}
    @if (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
    @endif

    {{-- Open Form --}}
    {!! Form::open(['url' => route('usercontroller.login')]) !!}
    <div class="form-group row">
        {{ Form::label('email', '*&nbsp;Email', ['class' => 'col-sm-4 col-form-label text-md-right']) }}

        <div class="col-md-6">
            {{ Form::email('email', '', ['class' => 'form-control']) }}
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        </div>
    </div>

    <div class="form-group row">
        {{ Form::label('password', '*&nbsp;Password', ['class' => 'col-sm-4 col-form-label text-md-right']) }}

        <div class="col-md-6">
            {{ Form::password('password', ['class' => 'form-control']) }}
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            {{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{-- Close Form --}}
    {!! Form::close() !!}
</div>
@endsection