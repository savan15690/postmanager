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

        {{-- Check if user is logged in and show Add New Post button --}}
        @if (session()->has('is_loggedin'))
            <a class="btn btn-success" href="{{ route('postcontroller.create') }}">Create New Post</a><br/><br/>
        @endif

        @if(empty($postInfo))
            <span class="text-danger"><h3>No Records Found</h3></span>
        @else

            {{-- Display Pagination --}}
            {{ $postInfo->links() }}

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-left">Title</th>
                        <th scope="col" class="text-left">Posted By</th>
                        <th scope="col" class="text-center">Image</th>
                        <th scope="col" class="text-center">Posted Date</th>
                        <th scope="col" class="text-center">Last Modified</th>
                        @if (session()->has('is_loggedin'))
                            <th scope="col" class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($postInfo as $postData)
                        <tr>
                            <td class="text-left">{{ link_to(route('postcontroller.postdetails', ['id' => $postData->id]), $postData->title) }}</td>
                            <td class="text-left"><a href="{{ route('postcontroller.userpost', ['userid' => $postData->user_id]) }}">@php echo $postData->user->name; @endphp</a></td>

                            {{-- Check if file name is empty or not --}}
                            @if(empty($postData->postimage))
                                <td class="text-center">N/A</td>
                            @else
                                @php
                                    $postImagePath = asset('public/postimages/') . '/' . $postData->postimage;
                                @endphp
                                <td class="text-center"><img src="<?php echo $postImagePath; ?>" height="90" width="90"></td>
                            @endif

                            <td class="text-center">@php echo date('d/m/Y', strtotime($postData->created_at)); @endphp</td>
                            <td class="text-center">@php echo date('d/m/Y', strtotime($postData->updated_at)); @endphp</td>
                            @if (session()->has('is_loggedin'))
                                <td class="text-center">
                                    {{-- Edit and Delete links are available for logged in user's posts only --}}
                                    @if ($postData->user_id == session('user_id'))
                                        {{ link_to(route('postcontroller.edit', ['id' => $postData->id]), 'Edit', ['class' => 'btn btn-success']) }}
                                        {{ link_to(route('postcontroller.delete', ['id' => $postData->id]), 'Delete', ['class' => 'btn btn-danger']) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Display Pagination --}}
            {{ $postInfo->links() }}

        @endif
    </div>
@endsection