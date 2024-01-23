@extends('admin.layouts.main')
@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.layouts.sidebar')

            <div id="content" class="fl-right display_flex">
                <div class="col-4">
                    <div class="section" id="title-page">
                        <div class="title_update">
                            <h3 id="index" class="fl-left">Thêm mới sinh viên</h3>
                            <a href="{{ route('student.index') }}" class="back_create">Xem danh sách</a>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="section" id="detail-page">
                        <div class="section-detail">
                            <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="request_input">
                                    <label for="title">Mã sinh viên</label>
                                    <input type="text" name="code" id="title" class="with_input"
                                        value="{{ old('code') }}">
                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Tên sinh viên</label>
                                    <input type="text" name="name" id="title" class="with_input"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="request_input">
                                    <label for="title">Chọn khoa </label>
                                    <select class="select_list" name="faculty_id" id="faculty_id">
                                        <option value="{{ old('faculty_id') ? old('faculty_id') : '' }}">
                                            {{ old('faculty_id') ? App\Models\Faculty::find(old('faculty_id'))->name : '-- Chọn khoa --' }}
                                        </option>
                                        @foreach ($faculty as $item)
                                            @if (old('faculty_id') ? $item->id != old('faculty_id') : $item->id != null)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('faculty_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Chọn ngành (Chọn khoa trước)</label>

                                    <select class="select_list" name="specialized_id" id="specialized_id">
                                        <option value="{{ old('specialized_id') ? old('specialized_id') : '' }}">
                                            {{ old('specialized_id') ? App\Models\specialized::find(old('specialized_id'))->name : '-- Chọn ngành --' }}
                                        </option>
                                    </select>

                                    @error('specialized_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="request_input">
                                    <label for="title">Chọn Lớp (Chọn ngành trước)</label>
                                    <select class="select_list " name="classroom_id" id="classroom_id">
                                        <option value="{{ old('classroom_id') ? old('classroom_id') : '' }}">
                                            {{ old('classroom_id') ? App\Models\classroom::find(old('classroom_id'))->name : '-- Chọn Lớp --' }}
                                            </option>
                                    </select>

                                    @error('classroom_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="request_input">
                                    <label for="title">Giới tính</label>
                                    <select name="gender" id="" {{ old('gender') }}>
                                        @if (old('gender'))
                                            @if (old('gender') == 'Nam')
                                                <option value="{{ old('gender') }}">{{ old('gender') }}</option>
                                                <option value="Nữ">Nữ</option>
                                            @else
                                                <option value="{{ old('gender') }}">{{ old('gender') }}</option>
                                                <option value="Nữ">Nam</option>
                                            @endif
                                        @else
                                            <option value="">Chọn</option>
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                        @endif

                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" name="btn-submit" id="btn-submit" class="btn_submit">Thêm
                                    mới</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            if ($('#faculty_id').val() != '') {

                var id = $('#faculty_id').val();
                var formData = new FormData();
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: "{{ route('faculty.showSpecialized') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var $tnt = {{ old('specialized_id') ? old('specialized_id') : 'null' }};
                        // $('#specialized_id').empty();
                        // $('#specialized_id').append(
                        //     '<option value="{{ old('specialized_id') ? old('specialized_id') : '' }}"> {{ old('specialized_id') ? App\Models\Specialized::find(old('specialized_id'))->name : '-- Chọn ngành --' }}</option>'
                        // );

                        $.each(data, function(index, value) {
                            if (value.id != $tnt) {
                                $('#specialized_id').append('<option value="' + value
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
                    url: "{{ route('faculty.showSpecialized') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#specialized_id').empty();
                        $('#classroom_id').empty();
                        $('#specialized_id').append(
                            '<option value="">-- Chọn ngành --</option>'
                        );
                        $('#classroom_id').append(
                            '<option value="">-- Chọn lớp --</option>'
                        );

                        $.each(data, function(index, value) {
                            $('#specialized_id').append('<option value="' + value
                                .id + '">' +
                                value.name + '</option>');
                        });
                    }
                })
            })

            $('#specialized_id').change(function() {

                var id = $(this).val();
                var formData = new FormData();
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: "{{ route('specialized.showClass') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#classroom_id').empty();
                        $('#classroom_id').append(
                            '<option value="">-- Chọn lớp --</option>'
                        );

                        $.each(data, function(index, value) {
                            $('#classroom_id').append('<option value="' + value
                                .id + '">' +
                                value.name + '</option>');
                        });
                    }
                })
            })

            if ($('#specialized_id').val() != '') {

                var id = $('#specialized_id').val();
                var formData = new FormData();

                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: "{{ route('specialized.showClass') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var $tnt = {{ old('classroom_id') ? old('classroom_id') : 'null' }};
                        // $('#classroom_id').empty();
                        // $('#classroom_id').append(
                        //     '<option value="{{ old('classroom_id') ? old('classroom_id') : '' }}"> {{ old('classroom_id') ? App\Models\classroom::find(old('classroom_id'))->name : '-- Chọn lớp --' }}</option>'
                        // );

                        $.each(data, function(index, value) {
                            if (value.id != $tnt) {
                                $('#classroom_id').append('<option value="' + value
                                    .id + '">' +
                                    value.name + '</option>');
                            }
                        });
                    }
                })
            }
            $('.list_select').select2();
        })
    </script>
@endsection
