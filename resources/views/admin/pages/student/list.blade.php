@extends('admin.layouts.main')
@section('content')
<script>
    $(document).ready(function() {

        $('#myTable').DataTable({
            "lengthMenu": [5,8, 10, 25, 50, 100],
            "pageLength": 8 // Số lượng hàng mặc định hiển thị trên mỗi trang
        });

    });
</script>
    <div id="main-content-wp" class="add-cat-page">
        <div class="wrap clearfix">
            @include('admin.layouts.sidebar')

            <div id="content" class="fl-right display_flex">
               
                <div class="col-12">
                    <div class="section" id="title-page">
                        
                        <div class="title_update width-300px">
                            <h3 id="index" class="fl-left">Danh sách sinh viên</h3>
                            <a href="{{ route('student.create') }}" class="back_create">Về thêm mới</a>
                        </div>
                    </div>
                    @if(!empty(session('delete')) )
                          
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

                            <div class="total_all">
                                <p class="">Tổng số khoa </p>
                                <p class="total_all_color"> {{ $total }}</p>
                            </div>
                            <div class="table-responsive">
                                {{-- class="table list-table-wp --}}
                                <table id="myTable" class="table list-table-wp">
                                    <thead class="thead_color">
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Mã sinh viên</span></td>
                                            <td><span class="tfoot-text">Tên sinh viên</span></td>
                                            <td><span class="tfoot-text">Tên khoa</span></td>
                                            <td><span class="tfoot-text">Chuyên ngành</span></td>
                                            <td><span class="tfoot-text">Giới tính</span></td>
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
                                                    <td><span class="tbody-text">{{ $item->code }}</h3></span>
                                                    <td><span class="tbody-text">{{ $item->name }}</span></td>
                                                    <td><span class="tbody-text">{{ $item->faculty->name }}</span></td>
                                                    <td><span class="tbody-text">{{ $item->specialized->name }}</span></td>
                                                    <td><span class="tbody-text">{{ $item->gender }}</span></td>
                                                    
                                                    <td class="clearfix">

                                                        <ul class="list-operation ">
                                                            <li><a href="{{ route('student.edit', ['student' => $item->id]) }}"
                                                                    title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i></a>
                                                            </li>
                                                            <li><a href="{{ route('student.destroy', ['student' => $item->id]) }}"
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
                                            <td><span class="tfoot-text">Mã sinh viên</span></td>
                                            <td><span class="tfoot-text">Tên sinh viên</span></td>
                                            <td><span class="tfoot-text">Tên khoa</span></td>
                                            <td><span class="tfoot-text">Chuyên ngành</span></td>
                                            <td><span class="tfoot-text">Giới tính</span></td>
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
