@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="container">
                        <div class="card-header row justify-content-between">
                            <div>Create new Post</div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row flex-column">
                                    <div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="row flex-column">
                                            <label for="title">Titolo: </label>
                                            <input class="form-control @error('title') is-invalid @enderror" type="text"
                                                name="title" value="{{ $post->title }}" />
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row flex-column">
                                            <label for="content">Contenuto: </label>
                                            <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                                value="{{ $post->content }}"></textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit">Edit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
