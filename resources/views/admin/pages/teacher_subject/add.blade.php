@extends('admin.layouts.main')
@php

@endphp
@section('content')
    <script>
        $(document).ready(function() {

            $('#myTable').DataTable({
                "lengthMenu": [5, 10, 25, 50, 100],
                "pageLength": 5 // Số lượng hàng mặc định hiển thị trên mỗi trang
            });
        });
    </script>
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.layouts.sidebar')
            <div id="content" class="fl-right display_flex">
                <div class="col-4">
                    <div class="section" id="title-page">
                        <div class="clearfix">
                            <h3 id="index" class="fl-left">Giảng viên môn học</h3>
                        </div>
                    </div>
                    @if (!empty(session('delete')))
                        <div class="alert-box">
                            <div class="display_flex title_box_delete">
                                <p class="title_yes_no">{{ session('delete') }}</p>
                            </div>
                            <div class="yes_no_delete">
                                <a href="" class="check_delete">Xác nhận</a>
                            </div>
                        </div>
                        <div class="overlay"></div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="section" id="detail-page">
                        <div class="section-detail">
                            <form action="{{ route('teacher_subject.store') }}" method="Post">
                                @csrf
                                <div class="request_input">
                                    <label for="title">Chọn khoa </label>
                                    <select class="select_list" name="faculty_id" id="faculty_id">
                                        <option value="{{ old('faculty_id') ? old('faculty_id') : '' }}">
                                            {{ old('faculty_id') ? App\Models\Faculty::find(old('faculty_id'))->name : '-- Chọn khoa --' }}
                                        </option>
                                        @foreach ($faculty as $item)
                                            @if ( old('faculty_id') ? ($item->id != old('faculty_id')) :(($item->id )!=null))
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('faculty_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Tên giảng viên</label>
                                    <select class="select_list list_input" name="teacher_id" id="teacher_id">
                                        <option value="">-- Chọn giảng viên --</option>
                                    </select>
                                    @error('teacher_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Tên Môn học</label>
                                    <select class="select_list" name="subject_id" id="subject_id">
                                        <option value="">-- Chọn môn học --</option>
                                    </select>
                                    @error('subject_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" name="btn-submit" class="btn_submit" id="btn-submit">Thêm
                                    mới</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">

                    <div class="section" id="title-page">
                        <div class="clearfix">
                            <h3 id="index" class="fl-left">Danh sách giảng viên bộ môn</h3>
                        </div>
                    </div>

                    <div class="section" id="detail-page">
                        <div class="section-detail">

                            <div class="total_all">
                                <p class="">Tổng số giảng viên bộ môn </p>
                                <p class="total_all_color"> {{ $total }}</p>
                            </div>
                            <div class="table-responsive">
                                {{-- class="table list-table-wp --}}
                                <table id="myTable" class="table list-table-wp">
                                    <thead class="thead_color">

                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Giảng viên</span></td>
                                            <td><span class="tfoot-text">Môn học</span></td>
                                            <td><span class="tfoot-text">Thao tác</span></td>



                                        </tr>

                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 1;
                                        @endphp
                                        @if (!empty($data))
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                                    <td><span class="tbody-text">{{ $stt++ }}</h3></span>
                                                    <td><span class="tbody-text">{{ $item->teacher->name }}</h3></span>
                                                    <td><span class="tbody-text">{{ $item->subject->name }}</span></td>
                                                    <td class="clearfix">

                                                        <ul class="list-operation ">
                                                            <li><a href="{{ route('teacher_subject.edit', ['teacher_subject' => $item->id]) }}"
                                                                    title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i></a>
                                                            </li>

                                                            <li><a href="{{ route('teacher_subject.destroy', ['teacher_subject' => $item->id]) }}"
                                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                                        aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot class="thead_color">
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Giảng viên</span></td>
                                            <td><span class="tfoot-text">Môn học</span></td>
                                            <td><span class="tfoot-text">Thao tác</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.list_input').select2();

            if ($('#faculty_id').val() != '') {
                
                var id = $('#faculty_id').val();
                var formData = new FormData();
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: "{{ route('teacher_subject') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var $tnt = {{ old('subject_id') ? old('subject_id') : 'null' }};
                        $('#subject_id').empty();
                        $('#subject_id').append(
                            '<option value="{{ old('subject_id') ? old('subject_id') : '' }}"> {{ old('subject_id') ? App\Models\subject::find(old('subject_id'))->name : '-- Chọn môn học --' }}</option>'
                        );
                        var $tnt1 = {{ old('teacher_id') ? old('teacher_id') : 'null' }};
                        $('#teacher_id').empty();
                        $('#teacher_id').append(
                            '<option value="{{ old('teacher_id') ? old('teacher_id') : '' }}"> {{ old('teacher_id') ? App\Models\teacher::find(old('teacher_id'))->name : '-- Chọn giảng viên --' }}</option>'
                        );

                        $.each(data.subject, function(index, value) {
                            if (value.id != $tnt) {
                                $('#subject_id').append('<option value="' + value
                                    .id + '">' +
                                    value.name + '</option>');
                            }
                        });
                        $.each(data.teacher, function(index, value) {
                            if (value.id != $tnt1) {
                                $('#teacher_id').append('<option value="' + value
                                    .id + '">' +
                                    value.name + '</option>');
                            }
                        });
                    }
                })
            }

            $('#faculty_id').change(function() {
                var id = $(this).val();
                var formData = new FormData();
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: "{{ route('teacher_subject') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#teacher_id').empty();
                        $('#teacher_id').append(
                            '<option value="">-- Chọn giảng viên --</option>'
                        );
                        $('#subject_id').empty();
                        $('#subject_id').append(
                            '<option value="">-- Chọn môn học --</option>'
                        );

                        $.each(data.teacher, function(index, value) {
                            $('#teacher_id').append('<option value="' + value
                                .id + '">' +
                                value.name + '</option>');
                        });
                        $.each(data.subject, function(index, value) {
                            $('#subject_id').append('<option value="' + value
                                .id + '">' +
                                value.name + '</option>');
                        });
                    }
                })
            })
        })
    </script>
@endsection
