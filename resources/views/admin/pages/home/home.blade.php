@extends('admin.layouts.main')
@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.layouts.sidebar')
            <div id="content" class="fl-right display_flex">
                <div class="col-12">
                    <div class="container-fluid py-5">
                        <div class="row">
                            <div class="col-4">
                                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Tổng số khoa</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$faculty}}</h5>
                                        <p class="card-text">Khoa hiện đang làm việc</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Chuyên ngày</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$specialized}}</h5>
                                        <p class="card-text">Ngành hiện đang làm việc</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Giảng viên</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$teacher}}</h5>
                                        <p class="card-text">Giảng viên đang làm việc</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Sinh viên</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$student}}</h5>
                                        <p class="card-text">Sinh viên hiện đang làm việc</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Môn học</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$subject}}</h5>
                                        <p class="card-text">Môn học hiện đang làm việc</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Lớp học</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$classroom}}</h5>
                                        <p class="card-text">Lớp học hiện đang làm việc</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Học phần</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$part_class}}</h5>
                                        <p class="card-text">Học phần hiện đang làm việc</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-4">
                                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Tổng số khoa</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$faculty}}</h5>
                                        <p class="card-text">Khoa hiện đang làm việc</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <!-- end analytic  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
