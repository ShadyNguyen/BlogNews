@extends('layout.layout_app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('lang.create') }}
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('lang.name') }}</th>
                                        <th>{{ __('lang.permission') }}</th>
                                        {{-- <td class="w-1">Assign</td> --}}
                                        <th class="w-1">{{ __('lang.manage') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $key => $ro)
                                        <tr>
                                            <th scope="row">{{ $key }}</th>
                                            <td>{{ $ro->name }}</td>
                                            <td>
                                                @foreach ($ro->permissions as $key => $per)
                                                    <span class="badge badge-info">{{ $per->name }}</span>
                                                @endforeach
                                            </td>
                                            {{-- <td><a href="{{route('roles.show',$ro->id)}}" class="btn btn-dark">Details</a></td> --}}
                                            <td>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['roles.destroy', $ro->id],
                                                    'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                                ]) !!}
            
                                                {!! Form::submit(trans('lang.delete'), ['class' => 'btn btn-danger']) !!}
            
                                                {!! Form::close() !!}
            
                                                <a href="{{route ('roles.edit',$ro->id) }}" class="btn btn-info">{{ __('lang.edit') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                                </tableclass="table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
