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
                            <h3 id="index" class="fl-left">Thêm mới ngành</h3>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="section" id="detail-page">
                        <div class="section-detail">
                            <form action="{{ route('specialized.update', ['specialized' => $specialized->id]) }}"
                                method="Post">
                                @csrf
                                @method('Put')
                                <div class="request_input">
                                    <label for="title">Mã ngành</label>
                                    <input type="text" name="code" id="slug" class="with_input"
                                        value="{{ $specialized->code }}" readonly>
                                    @error('code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Chọn khoa </label>
                                    <select class="select_list" name="faculty_id" id="faculty_id">
                                        <option value="{{ old('faculty_id') ? old('faculty_id') : $specialized->faculty_id }}">
                                            {{ old('faculty_id') ? App\Models\Faculty::find(old('faculty_id'))->name : $specialized->faculty->name }}
                                        </option>
                                        @foreach ($faculty as $item)
                                            @if ( old('faculty_id') ? ($item->id != old('faculty_id')) : ($item->id != $specialized->faculty_id))
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>


                                    @error('faculty_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Tên ngành </label>
                                    <input type="text" class="with_input" name="name" value="{{ old('name') ? old('name') : $specialized->name }}" required>


                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="request_input">
                                    <label for="title">Số tín chỉ</label>
                                    <input type="number" name="qty" id="slug" class="with_input"
                                        value="{{ old('qty') ? old('qty') : $specialized->qty }}">
                                    @error('qty')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="display_flex box_btn">
                                    <button type="submit" name="btn-submit" class="btn_submit" id="btn-submit">Cập
                                        nhập</button>
                                    <a href="{{ route('specialized.destroy', ['specialized' => $specialized->id]) }}"
                                        class="back_create delete_btn">Xóa</a>
                                </div>



                                <a href="{{ route('specialized.create') }}" class="back_create">Về thêm mới</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">


                    <div class="section" id="title-page">
                        <div class="clearfix">
                            <h3 id="index" class="fl-left">Danh sách ngành</h3>
                        </div>
                    </div>

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
                                            <td><span class="tfoot-text">Mã ngành</span></td>
                                            <td><span class="tfoot-text">Tên ngành</span></td>
                                            <td><span class="tfoot-text">Tín chỉ</span></td>
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
                                                    <td><span class="tbody-text">{{ $item->qty }}</span></td>
                                                    <td class="clearfix">

                                                        <ul class="list-operation ">
                                                            <li><a href="{{ route('specialized.edit', ['specialized' => $item->id]) }}"
                                                                    title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i></a>
                                                            </li>

                                                            <li><a href="{{ route('specialized.destroy', ['specialized' => $item->id]) }}"
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
                                            <td><span class="tfoot-text">Mã ngành</span></td>
                                            <td><span class="tfoot-text">Tên ngành</span></td>
                                            <td><span class="tfoot-text">Tín chỉ</span></td>
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
