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
                    {{-- <div class="section" id="title-page">
                        <div class="clearfix">
                            
                        </div>
                    </div> --}}
                    <div class="title_update width-300px">
                        <h3 id="index" class="fl-left">Danh sách môn học</h3>
                        <a href="{{ route('subject.create') }}" class="back_create">Về thêm mới</a>
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
                                            <td><span class="tfoot-text">Mã môn học</span></td>
                                            <td><span class="tfoot-text">Tên môn học</span></td>
                                            <td><span class="tfoot-text">Tên khoa</span></td>
                                            <td><span class="tfoot-text">Tên ngành</span></td>
                                            <td><span class="tfoot-text">Ngày làm</span></td>
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
                                                    <td><span class="tbody-text">{{ $item->created_at->format('d-m-Y') }}</span></td>
                                                    <td class="clearfix">

                                                        <ul class="list-operation ">
                                                            <li><a href="{{ route('subject.edit', ['subject' => $item->id]) }}"
                                                                    title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i></a>
                                                            </li>

                                                            <li><a href="{{ route('subject.destroy', ['subject' => $item->id]) }}"
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
                                            <td><span class="tfoot-text">Mã môn học</span></td>
                                            <td><span class="tfoot-text">Tên môn học</span></td>
                                            <td><span class="tfoot-text">Tên khoa</span></td>
                                            <td><span class="tfoot-text">Tên ngành</span></td>
                                            <td><span class="tfoot-text">Ngày làm</span></td>
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
    
@endsection
