@extends('welcome');

@section('content')
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="">Category</a></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row">
                <style>
                    .post {
                        clear: both;
                        overflow: auto;
                        margin-bottom: 20px;
                    }

                    .post img {
                        float: left;
                        /* Hình ảnh ở bên trái */
                        margin-right: 10px;
                        width: 200px;
                        /* Điều chỉnh kích thước hình ảnh nếu cần */
                        height: auto;
                    }

                    .post h4 {
                        font-style: italic;
                        margin-top: 0;
                        /* Loại bỏ margin top mặc định của tiêu đề */
                    }
                </style>

                <div class="contact-form">
                    @foreach ($post as $key => $p)
                        <div class="post">
                            <img src="{{ asset('uploads/article/' . $p->image) }}" alt="">
                            <div class="tn-title">
                                <a href="{{ route('bai-viet', $p->slug) }}">
                                    <h4>{{ $p->title }}</h4>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>



            <div class="col-md-4">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra
                        dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus.
                    </p>
                    <h4><i class="fa fa-map-marker"></i>123 News Street, NY, USA</h4>
                    <h4><i class="fa fa-envelope"></i>info@example.com</h4>
                    <h4><i class="fa fa-phone"></i>+123-456-7890</h4>
                    <div class="social">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Contact End -->
@endsection
