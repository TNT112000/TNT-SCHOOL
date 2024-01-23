@extends('admin.layouts.main')
@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.layouts.sidebar')

            <div id="content" class="fl-right display_flex">
                <div class="col-12">
                    <div class="section" id="title-page">
                        <div class="title_update">
                            <h3 id="index" class="fl-left">Thêm mới học phần</h3>
                            <a href="{{ route('part_class.index') }}" class="back_create">Xem danh sách</a>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="section" id="detail-page">
                        <div class="section-detail">
                            <form method="POST" action="{{ route('part_class.store') }}">
                                @csrf
                                <div class="row col-12 ">
                                    <div class="request_input col-4">
                                        <label for="title">Mã học phần</label>
                                        <input type="text" name="code" id="title" class="with_input"
                                            value="{{ old('code') }}">
                                        @error('code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="request_input col-4">
                                        <label for="title">Tên học phần</label>
                                        <input type="text" name="name" id="title" class="with_input"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="request_input col-4">
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
                                    <div class="request_input col-4">
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

                                    <div class="request_input col-4">
                                        <label for="title">Chọn Lớp (Chọn ngành trước)</label>

                                        <select class="select_list" name="classroom_id" id="classroom_id">
                                            <option value="{{ old('classroom_id') ? old('classroom_id') : '' }}">
                                                {{ old('classroom_id') ? App\Models\classroom::find(old('classroom_id'))->name : '-- Chọn môn học --' }}
                                            </option>
                                        </select>

                                        @error('classroom_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="request_input col-4">
                                        <label for="title">Chọn Môn (Chọn ngành trước)</label>

                                        <select class="select_list" name="subject_id" id="subject_id">
                                            <option value="{{ old('subject_id') ? old('subject_id') : '' }}">
                                                {{ old('subject_id') ? App\Models\subject::find(old('subject_id'))->name : '-- Chọn môn học --' }}
                                            </option>
                                        </select>

                                        @error('subject_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="request_input col-4">
                                        <label for="title">Chọn giảng viên (Chọn khoa trước)</label>
                                        <select class="select_list" name="teacher_id" id="teacher_id">
                                            <option value="{{ old('teacher_id') ? old('teacher_id') : '' }}">
                                                {{ old('teacher_id') ? App\Models\teacher::find(old('teacher_id'))->name : '-- Chọn giảng viên --' }}
                                            </option>
                                        </select>

                                        @error('teacher_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="request_input col-4">
                                        <label for="title">Số lượng sinh viên</label>
                                        <input type="number" name="qty" class="d-block">
                                        @error('qty')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
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
                        $('#teacher_id').empty();
                        $('#subject_id').empty();
                        $('#specialized_id').append(
                            '<option value="">-- Chọn ngành --</option>'
                        );
                        $('#subject_id').append(
                            '<option value="">-- Chọn môn học --</option>'
                        );
                        $('#teacher_id').append(
                            '<option value="">-- Chọn giảng viên --</option>'
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
                    url: "{{ route('ClassShowSubject') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#subject_id').empty();
                        $('#teacher_id').empty();
                        $('#subject_id').append(
                            '<option value="">-- Chọn môn học --</option>'
                        );
                        $('#teacher_id').append(
                            '<option value="">-- Chọn giảng viên --</option>'
                        );
                        $('#classroom_id').empty();
                        $('#classroom_id').append(
                            '<option value="">-- Chọn môn học --</option>'
                        );


                        $.each(data.subject, function(index, value) {
                            $('#subject_id').append('<option value="' + value
                                .id + '">' +
                                value.name + '</option>');
                        });
                        $.each(data.classroom, function(index, value) {
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
                    url: "{{ route('ClassShowSubject') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var $tnt = {{ old('subject_id') ? old('subject_id') : 'null' }};
                        var $tnt1 = {{ old('classroom_id') ? old('classroom_id') : 'null' }};


                        $.each(data.subject, function(index, value) {
                            if (value.id != $tnt) {
                                $('#subject_id').append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            }
                        });
                        $.each(data.classroom, function(index, value) {
                            if (value.id != $tnt1) {
                                $('#subject_id').append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            }
                        });
                    }
                })
            }
            if ($('#subject_id').val() != '') {
                var id = $('#subject_id').val();

                var formData = new FormData();
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: "{{ route('subject.showTeacher') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var $tnt = {{ old('teacher_id') ? old('teacher_id') : 'null' }};


                        $.each(data, function(index, value) {
                            if (value.id != $tnt) {
                                $('#teacher_id').append('<option value="' + value
                                    .id + '">' +
                                    value.name + '</option>');
                            }
                        });
                    }
                })
            }
            $('#subject_id').change(function() {

                var id = $(this).val();

                var formData = new FormData();
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                $.ajax({
                    url: "{{ route('subject.showTeacher') }}",
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

                        $.each(data, function(index, value) {
                            $('#teacher_id').append('<option value="' + value.id +
                                '">' +
                                value.name + '</option>');
                        });
                    }
                })
            })
            $('.list_select').select2();
        })
    </script>
@endsection
