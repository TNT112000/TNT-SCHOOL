<div id="sidebar" class="fl-left">
    <ul id="sidebar-menu">
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Quản lý chung</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('home')}}" title="" class="nav-link">Tổng quan chung</a>
                </li>
            </ul>
        </li> 

        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Giảng viên</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('teacher.create')}}" title="" class="nav-link">Thêm mới giảng viên</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('teacher.index')}}" title="" class="nav-link">Danh sách giảng viên</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('teacher_subject.create')}}" title="" class="nav-link">Giảng viên môn học</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Sinh viên</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('student.create')}}" title="" class="nav-link">Thêm mới sinh viên</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('student.index')}}" title="" class="nav-link">Danh sách sinh viên</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Lớp học</span>
            </a>
            <ul class="sub-menu">
                
                <li class="nav-item">
                    <a href="{{route('classroom.create')}}" title="" class="nav-link">Thêm mới lớp học</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('classroom.index')}}" title="" class="nav-link">Danh sách lớp học</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Môn học</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('subject.create')}}" title="" class="nav-link">Thêm mới môn học</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('subject.index')}}" title="" class="nav-link">Danh sách môn học</a>
                </li>
                
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Khoa</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('faculty.create')}}" title="" class="nav-link">Thông tin Khoa</a>
                </li>
                
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Chuyên ngành</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('specialized.create')}}" title="" class="nav-link">Thông tin Chuyên ngành</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span class="title">Lớp học phần</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('part_class.create')}}" title="" class="nav-link">Thêm mới Lớp học phần</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('part_class.index')}}" title="" class="nav-link">Danh sách Lớp học phần</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
