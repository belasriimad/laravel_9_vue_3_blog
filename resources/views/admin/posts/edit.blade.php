@extends('layouts.admin.main')

@section('title')
    Update
@endsection

@section('content')
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title text-center">
                    <h3 class="mt-3">
                        Update post
                    </h3>
                </div>
                <hr>
                <div class="card-body p-3">
                    <form action="{{route('posts.update',$post)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="title_en" class="col-sm-3 col-form-label">
                                        Title EN*
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title_en" 
                                            placeholder="Title EN"
                                            class="form-control @error('title_en') is-invalid @enderror"
                                            value="{{$post->title_en, old('title_en')}}">
                                        @error('title_en')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="title_fr" class="col-sm-3 col-form-label">
                                        Title FR*
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" 
                                            name="title_fr" 
                                            placeholder="Title FR"
                                            class="form-control @error('title_fr') is-invalid @enderror"
                                            value="{{$post->title_fr, old('title_fr')}}">
                                        @error('title_fr')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label">
                                        Category*
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="category_id" id="category_id" 
                                            class="form-control @error('category_id') is-invalid @enderror">
                                            <option selected disabled>Choose a category</option>
                                            @foreach ($categories as $category)
                                                <option
                                                {{$post->category_id === $category->id ? 'selected' : ''}}
                                                value="{{$category->id}}">{{$category->name_en}}</option>   
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="body_en" class="col-sm-3 col-form-label">
                                        Body EN*
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea 
                                            name="body_en" 
                                            placeholder="Body EN"
                                            class="form-control @error('body_en') is-invalid @enderror"
                                        >{{$post->body_en}}</textarea>
                                        @error('body_en')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="body_en" class="col-sm-3 col-form-label">
                                        Body FR*
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea 
                                            name="body_fr" 
                                            placeholder="Body FR"
                                            class="form-control @error('body_fr') is-invalid @enderror"
                                            >{{$post->body_fr}}</textarea>
                                        @error('body_fr')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <img src="{{asset($post->photo)}}" class="rounded" height="200" width="200" alt="{{$post->title}}">
                                </div>
                                <div class="form-group row">
                                    <label for="photo" class="col-sm-3 col-form-label">
                                        Image*
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="file" 
                                            name="photo" 
                                            placeholder="Body FR"
                                            class="form-control @error('photo') is-invalid @enderror"/>
                                        @error('photo')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="form-check d-flex justify-content-center">
                                    <label for="tags" class="form-check-label">
                                        Tags:
                                    </label>
                                    @foreach($tags as $tag)
                                        <input type="checkbox"
                                        {{$post->tags->contains($tag) ? 'checked' : ''}}
                                        class="form-check-input mx-2" name="tags[]" id="tags"
                                        value="{{$tag->id}}">
                                        {{$tag->name}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection