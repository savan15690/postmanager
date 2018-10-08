@extends('layouts.mainapp')

@section('content')
    <div class="container">
        {{-- @php
            print("<pre>");
            print_r($postData);
            print("</pre>");
        @endphp --}}
    </div>
    
    <div class="card border-primary mb-3">
        <div class="card-header">
            <h1>{{ $postData->title }}</h1>
        </div>
        <div class="card-body">
            <p class="card-text">{{ nl2br($postData->description) }}</p>
            @foreach ($postData->tags as $tags)
                <span class="badge badge-pill badge-primary">{{ $tags->name }}</span>
            @endforeach
        </div>
        <div class="card-footer">
            <p class="text-primary">Posted By :: {{ $postData->user->name }}</p>
            <p class="text-success">Posted On :: {{ date('jS F, Y', strtotime($postData->created_at)) }}</p>
            <p class="text-success">Last Updated On :: {{ date('jS F, Y', strtotime($postData->updated_at)) }}</p>
        </div>
    </div>
    {{ link_to(route('postcontroller.index'), 'Back', ['class' => 'btn btn-danger']) }}
@endsection