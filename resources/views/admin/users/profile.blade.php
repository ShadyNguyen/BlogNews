@extends('layout.layout_app')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Account Settings
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-3 d-none d-md-block border-end">
                            <div class="card-body">
                                <h4 class="subheader">Business settings</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="{{ route('profile') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center active">My
                                        Account</a>
                                </div>
                                <div class="list-group list-group-transparent">
                                    <a href="{{ route('profile.pwd') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center ">
                                        Password</a>
                                </div>

                            </div>
                        </div>
                        <div class="col d-flex flex-column">
                            <div class="card-body">
                                {{-- <form action="{{route('update-profile',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h2 class="mb-4">My Account</h2>
                                    <h3 class="card-title">Profile Details</h3>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="{{asset('uploads/avt'.Auth::user()->avatar)}}" alt="" class="avatar avatar-2xl">
                                        </div>
                                        <div class="col-auto">
                                            
                                        </div>
                                    </div>
                                    <h3 class="card-title mt-4">Profile</h3>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <div class="form-label">Name</div>
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name">
                                        </div>

                                    </div>
                                    <h3 class="card-title mt-4">Email</h3>
                                    <p class="card-subtitle">This contact will be shown to others publicly, so choose it
                                        carefully.</p>
                                    <div>
                                        <div class="row g-2">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control w-full"
                                                    value="{{ Auth::user()->email }}" disabled name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-list justify-content-end bg-transparent" style="margin-top:15px">
                                        <a href="#" class="btn">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-ghost-primary" name="update">Submit</button>
                                    </div>
                                </form> --}}
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                           
                            {!! Form::open(['route' => ['update-profile', Auth::user()->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
                           
                            <h1>Profile</h1>
                             <p> Account Setting</p>   
                            <div class="form-group">
                                <img src="{{asset('uploads/avt/'.Auth::user()->avatar)}}" alt="" class="avatar avatar-2xl">
                                {!! Form::file('avatar', ['class' => 'form-control mt-4']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['style' => 'margin-top:10px']) !!}
                                {!! Form::text('name', Auth::user()->name , ['class' => 'form-control mt-auto', 'placeholder' => 'Nhập dữ liệu...']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email', ['style' => 'margin-top:10px']) !!}
                                {!! Form::text('email',  Auth::user()->email , ['class' => 'form-control mt-auto', 'placeholder' => 'Nhập dữ liệu...', 'readonly']) !!}
                            </div>
                            
                            {!! Form::submit('Update', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px; float:right']) !!}
                            
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank"
                                        class="link-secondary" rel="noopener">Documentation</a></li>
                                <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a>
                                </li>
                                <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank"
                                        class="link-secondary" rel="noopener">Source code</a></li>
                                <li class="list-inline-item">
                                    <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary"
                                        rel="noopener">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon text-pink icon-filled icon-inline" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                        </svg>
                                        Sponsor
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; 2023
                                    <a href="." class="link-secondary">Tabler</a>.
                                    All rights reserved.
                                </li>
                                <li class="list-inline-item">
                                    <a href="./changelog.html" class="link-secondary" rel="noopener">
                                        v1.0.0-beta19
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    @endsection
