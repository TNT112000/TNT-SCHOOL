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
                                <h3 id="index" class="fl-left">Chỉnh sửa giảng viên</h3>
                                
                                <a href="{{ route('teacher.index') }}" class="back_create">Xem danh sách</a>
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
                            <form method="POST" action="{{ route('teacher.update', ['teacher' => $teacher->id]) }}">
                                @method('PUT')
                                @csrf

                                <div class="request_input">
                                    <label for="title">Mã giảng viên</label>
                                    <input readonly type="text" name="code" id="title" class="with_input"
                                        value="{{ old('code') ? old('code') : $teacher->code }}">
                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Tên giảng viên</label>
                                    <input type="text" name="name" id="title" class="with_input"
                                        value="{{ old('name') ? old('name') : $teacher->name }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="request_input">
                                    <label for="title">Chọn khoa </label>
                                    <select class="select_list" name="faculty_id" id="faculty_id">
                                        <option value="{{ old('faculty_id') ? old('faculty_id') : $teacher->faculty_id }}">
                                            {{ old('faculty_id') ? App\Models\Faculty::find(old('faculty_id'))->name : $teacher->faculty->name }}
                                        </option>
                                        @foreach ($faculty as $item)
                                            @if (old('faculty_id') ? $item->id != old('faculty_id') : $item->id != $teacher->faculty_id)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('faculty_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Giới tính</label>
                                    <select name="gender" id="">
                                        @if (old('gender'))
                                            @if (old('gender') == 'Nam')
                                                <option value="{{ old('gender') }}">{{ old('gender') }}</option>
                                                <option value="Nữ">Nữ</option>
                                            @else
                                                <option value="{{ old('gender') }}">{{ old('gender') }}</option>
                                                <option value="Nữ">Nam</option>
                                            @endif
                                        @else
                                            @if ($teacher->gender == 'Nam')
                                                <option value="{{ $teacher->gender }}">{{ $teacher->gender }}</option>
                                                <option value="Nữ">Nữ</option>
                                            @else
                                                <option value="{{ $teacher->gender }}">{{ $teacher->gender }}</option>
                                                <option value="Nam">Nam</option>
                                            @endif
                                        @endif
                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="display_flex box_btn">
                                    <button type="submit" name="btn-submit" class="btn_submit" id="btn-submit">Cập
                                        nhập</button>
                                    <a href="{{ route('teacher.destroy', ['teacher' => $teacher->id]) }}"
                                        class="back_create delete_btn">Xóa</a>
                                </div>
                                <a href="{{ route('teacher.create') }}" class="back_create">Về thêm mới</a>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click', '#image_main', function() {
                // Kích hoạt sự kiện click cho input file
                $('.image_input_main').click();
            });

            $('.image_input_main').change(function() {
                var newImages = this.files;
                // Lưu trữ các hình ảnh từ thứ 8 trở đi để xóa giá trị
                // Tạo một đối tượng DataTransfer mới

                if (newImages.length >= 1) {

                    var newImageElement = $('<img>');

                    // Gán thuộc tính id cho hình ảnh mới
                    newImageElement.attr('id', 'image_main_add');
                    newImageElement.attr('class', 'image_main_add');

                    // Gán đường dẫn của hình ảnh mới
                    var imageURL = URL.createObjectURL(newImages[0]);
                    newImageElement.attr('src', imageURL);

                    // Thêm hình ảnh mới vào DOM
                    $('.image_product_box_main').append(newImageElement);
                    $('.image_product_box_main').append('<div class="delete-icon_main">X</div>')
                    $('#image_main').remove();

                }

            });

            $(document).on('click', '.delete-icon_main', function() {
                // Kích hoạt sự kiện click cho input file
                $('#image_main_add').remove();
                $('.delete-icon_main').remove();
                var imgThumbPath = "{{ asset('admin/images/img-thumb.png') }}";
                $('.image_product_box_main').prepend("<img src=" + imgThumbPath +
                    " id='image_main' class='image_main_add'>");
            });
        })
    </script>
@endsection
