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
        {!! Form::model($postInfo, ['route' => 'postcontroller.update', 'files' => true]) !!}
        
            @include('post_form')

            {{ Form::hidden('postId', $id) }}

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    {{ Form::submit('Update Post', ['class' => 'btn btn-primary']) }}
                    {{ link_to(route('postcontroller.index'), 'Back', ['class' => 'btn btn-danger']) }}
                </div>
            </div>

        {{-- Close Form --}}
        {!! Form::close() !!}
    </div>
@endsection