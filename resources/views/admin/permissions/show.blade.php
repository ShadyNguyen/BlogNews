@extends('layout.layout_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Quản Lý</h2>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
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

                        {!! Form::open(['route' => ['permissions.roles', $permission->id], 'method' => 'POST']) !!}

                        <div class="form-group">
                            {!! Form::label('role', 'Role', ['class' => 'form-label']) !!}
                            @foreach ($roles as $role)
                                {!! Form::checkbox('role', $role->id, false, [
                                    'class' => 'form-check-input',
                                    'id' => 'role_' . $role->id
                                ]) !!}
                                {!! Form::label('role_' . $role->id, $role->name, ['class' => 'form-label']) !!}
                            @endforeach
                        </div>
                        
                        {!! Form::submit('Phân Quyền', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
