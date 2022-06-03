@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="container">
                        <div class="card-header row justify-content-between">
                            <div>{{ $post->title }}</div>

                        </div>
                        <div class="card-body">
                            <div>
                                <p>{{ $post->content }}</p>
                                <h5>Slug:</h5>
                                <div>{{ $post->slug }}</div>
                                <div>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                    <a href="">Delete</a>
                                    <a href="{{ route('admin.posts.index') }}">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
