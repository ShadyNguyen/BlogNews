@extends('layout.layout_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Quản lý Role</h2></div>
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
                    @if(!@isset($role))   
                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    @else
                    {!! Form::open(['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}
                    @endif
                        
                    <div class="form-group">
                        {!! Form::label('name', 'Name', []) !!}
                        {!! Form::text('name', isset($role) ? $role->name : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...' ,]) !!}
                    </div>
                    
                    @if(!isset($role))
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