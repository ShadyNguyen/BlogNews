@extends('layout.layout_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Quản lý Bài Viết</h2></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!@isset($post))   
                    {!! Form::open(['route' => 'post.store', 'method' => 'POST' ,'enctype' => 'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' => ['post.update', $post->id], 'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
                    @endif
                        
                    <div class="form-group">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', isset($post) ? $post->title : '', ['class' => 'form-control mt-auto', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', isset($post) ? $post->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'convert_slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Category', 'Category', []) !!}
                        {!! Form::select('category_id', $category, isset($post) ? $post->category_id : '', ['class' => 'form-control mt-auto']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content', 'Content', []) !!}
                        {!! Form::textarea('content', isset($post) ? $post->content : '', [
                            'style' => 'resize:none',
                            'class' => 'form-control mt-auto',
                            'placeholder' => 'Nhập dữ liệu...',
                        ]) !!}
                       
                    </div>
                    <div class="form-group">
                        {!! Form::label('Image', 'Image') !!}
                        {!! Form::file('image', ['class' => 'form-control mt-3']) !!}
                        @if (!empty($post))
                            <img width="50%" src="{{ asset('uploads/article/' . $post->image) }}">
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('author', 'Author', []) !!}
                        {!! Form::text('author', isset($post) ? $post->author : '', ['class' => 'form-control mt-auto', 'placeholder' => 'Nhập dữ liệu...']) !!}
                    </div>
                    @if(!isset($post))
                    {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) !!}
                    @else
                    {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) !!}
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection