@extends('layout.layout_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Manage Assign</h2>
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

                        {!! Form::open(['route' => ['roles.permissions', $roles->id], 'method' => 'POST']) !!}

                        <div class="form-group">
                            {!! Form::label('role', 'Role', ['class' => 'form-label']) !!}
                            @foreach ($permission as $key => $per)
                                @if (@isset($roles))
                                    {!! Form::checkbox('permission[]', $per->id, isset($all_permission) && $all_permission->contains($per->id) ? true : false, [
                                        'class' => 'form-check-input',
                                    ]) !!}
                                @else
                                    {!! Form::checkbox('permission[]', $per->id, '', ['class' => 'form-check-input']) !!}
                                @endif
                                {!! Form::label('Role', $per->name, ['class' => 'form-check-label']) !!}
                            @endforeach
                        </div>
                        {!! Form::submit('Assign', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
