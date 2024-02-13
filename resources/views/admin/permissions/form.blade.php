@extends('layout.layout_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Quản lý Permission</h2></div>
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
                    @if(!@isset($permission))   
                    {!! Form::open(['route' => 'permissions.store', 'method' => 'POST']) !!}
                    @else
                    {!! Form::open(['route' => ['permissions.update', $permission->id], 'method' => 'PUT']) !!}
                    @endif
                        
                    <div class="form-group">
                        {!! Form::label('name', 'Name', []) !!}
                        {!! Form::text('name', isset($permission) ? $permission->name : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...' , 'id' => 'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                    </div>
                   
                    @if(!isset($permission))
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