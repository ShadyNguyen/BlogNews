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
                        <div class="container">
                            <div class="row">
                                {!! Form::open(['route' => ['users.roles', $user->id], 'method' => 'POST']) !!}
                                <div class="form-check">
                                    <h3 class="">Role</h3>
                                    @foreach ($roles as $key => $rule)
                                        @if (@isset($user))
                                            {!! Form::checkbox('role[]', $rule->id, isset($all_roles) && $all_roles->contains($rule->id) ? true : false, [
                                                'class' => 'form-check-input-inline',
                                            ]) !!}
                                            {!! Form::label('Role', $rule->name, ['class' => 'form-check-label-inline']) !!}
                                        @else
                                            {!! Form::checkbox('role[]', $rule->id, '', ['class' => 'form-check-input-inline']) !!}
                                            {!! Form::label('Role', $rule->name, ['class' => 'form-check-label-inline']) !!}
                                        @endif
                                    @endforeach
                                </div>
                                <div class="form-check">
                                    <h3 class="">Permission</h3>
                                    @foreach ($permissions as $key => $per)
                                        @if (@isset($user))
                                            {!! Form::checkbox('permission[]', $per->id, isset($all_permission) && $all_permission->contains($per->id) ? true : false, [
                                                'class' => 'form-check-input-inline',
                                            ]) !!}
                                            {!! Form::label('Permission', $per->name, ['class' => 'form-check-label-inline']) !!}
                                        @else
                                            {!! Form::checkbox('permission[]', $per->id, '', ['class' => 'form-check-input-inline']) !!}
                                            {!! Form::label('Permission', $per->name, ['class' => 'form-check-label-inline']) !!}
                                        @endif
                                    @endforeach
                                </div>
                                {!! Form::submit('Phân Quyền', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
