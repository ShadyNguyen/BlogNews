@extends('layout.layout_auth')

@section('content')
    <div class="container container-tight py-4">
        <form class="card card-md" action="{{route('register')}}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">{{ __('Tạo Tài Khoản')}}</h2>
                <div class="mb-3">
                    <label class="form-label">{{ __('Tên Tài Khoản')}}</label>
                    <input type="text" class="form-control" placeholder="Nhập tên tài khoản" name="name" value="{{old('name')}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Email')}}</label>
                    <input type="email" class="form-control" placeholder="Nhập địa chỉ email" name="email" value={{old('email')}}>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Mật Khẩu')}}</label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control" placeholder="Mật Khẩu" autocomplete="off" name="password">
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Hiển thị mật khẩu" data-bs-toggle="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Nhập Lại Mật Khẩu')}}</label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control" placeholder="Nhập Lại Mật Khẩu" autocomplete="off" name="password_confirmation">
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Hiển thị mật khẩu" data-bs-toggle="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
                
                {{-- <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms and
                                policy</a>.</span>
                    </label>
                </div> --}}
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Đăng Ký')}}</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            {{ __('Bạn đã có tài khoản?')}} <a href="{{route('showLoginForm')}}" tabindex="-1">{{ __('Đăng Nhập')}}</a>
        </div>
    </div>
@endsection
