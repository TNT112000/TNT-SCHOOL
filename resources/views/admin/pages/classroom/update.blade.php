@extends('admin.layouts.main')
@section('content')
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.layouts.sidebar')

            <div id="content" class="fl-right display_flex">
                <div class="col-4">
                    <div class="section" id="title-page">
                        <div class="clearfix">
                            <div class="title_update">
                                <h3 id="index" class="fl-left">Chỉnh sửa lớp học</h3>
                                <a href="{{ route('classroom.index') }}" class="back_create">Xem danh sách</a>
                            </div>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="section" id="detail-page">
                        <div class="section-detail">
                            <form method="POST" action="{{ route('classroom.update', ['classroom' => $classroom->id]) }}">
                                @method('PUT')
                                @csrf
                                <div class="request_input">
                                    <label for="title">Mã lớp học</label>
                                    <input type="text" name="code" id="title" class="with_input"
                                        value="{{ old('code') ? old('code') : $classroom->code }}" readonLy>
                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Tên lớp học</label>
                                    <input type="text" name="name" id="title" class="with_input"
                                        value="{{ old('name') ? old('name') : $classroom->name }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="request_input">
                                    <label for="title">Chọn khoa </label>
                                    <select class="select_list" name="faculty_id" id="faculty_id">

                                        <option
                                            value="{{ old('faculty_id') ? old('faculty_id') : $classroom->faculty_id }}">
                                            {{ old('faculty_id') ? App\Models\Faculty::find(old('faculty_id'))->name : $classroom->faculty->name }}
                                        </option>
                                        @foreach ($faculty as $item)
                                            @if (old('faculty_id') ? $item->id != old('faculty_id') : $item->id != $classroom->faculty_id)
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
                                        @if (old('specialized_id') == 'null')
                                            <option value="null">-- Chọn ngành --</option>
                                        @else
                                            <option
                                                value="{{ old('specialized_id') ? old('specialized_id') : $classroom->specialized_id }}">
                                                {{ old('specialized_id') ? App\Models\Specialized::find(old('specialized_id'))->name : $classroom->specialized->name }}
                                            </option>
                                        @endif
                                        {{-- @foreach ($specialized as $item)
                                            @if (old('specialized_id') ? $item->id != old('specialized_id') : $item->id != $classroom->specialized_id)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach --}}
                                    </select>
                                    @error('specialized_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="display_flex box_btn">
                                    <button type="submit" name="btn-submit" class="btn_submit" id="btn-submit">Cập
                                        nhập</button>
                                    <a href="{{ route('classroom.destroy', ['classroom' => $classroom->id]) }}"
                                        class="back_create delete_btn">Xóa</a>
                                </div>
                                <a href="{{ route('classroom.create') }}" class="back_create">Về thêm mới</a>
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
                        

                        $.each(data, function(index, value) {
                            if (value.id != $('#specialized_id').val())
                                $('#specialized_id').append('<option value="' + value
                                    .id + '">' +
                                    value.name + '</option>');
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
                        $('#specialized_id').append(
                            '<option value="null">-- Chọn ngành --</option>'
                        );

                        $.each(data, function(index, value) {
                            $('#specialized_id').append('<option value="' + value
                                .id + '">' +
                                value.name + '</option>');
                        });
                    }
                })
            })
        })
    </script>
@endsection
