@extends('layouts.admin.main')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row my-3">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('posts.index')}}" class="btn btn-link text-decoration-none text-dark">
                                <div class="card p-3">
                                    <div class="card-body">
                                        <h3>
                                            Posts {{\App\Models\Post::count()}}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-link text-decoration-none text-dark">
                                <div class="card p-3">
                                    <div class="card-body">
                                        <h3>
                                            Categories {{$categories->count()}}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection