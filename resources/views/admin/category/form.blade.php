@extends('layout.layout_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Category Manage</h2></div>
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
                    @if(!@isset($category))   
                    {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                    @else
                    {!! Form::open(['route' => ['category.update', $category->id], 'method' => 'PUT']) !!}
                    @endif
                        
                    <div class="form-group">
                        {!! Form::label('name', trans('lang.name'), []) !!}
                        {!! Form::text('name', isset($category) ? $category->name : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...' , 'id' => 'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', trans('lang.slug'), []) !!}
                        {!! Form::text('slug', isset($category) ? $category->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'convert_slug']) !!}
                    </div>
                    @if(!isset($category))
                    {!! Form::submit(trans('lang.create'), ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) !!}
                    @else
                    {!! Form::submit(trans('lang.update'), ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) !!}
                    @endif
                    {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection