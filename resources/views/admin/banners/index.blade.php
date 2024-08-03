@extends('admin.layout.master')

@section('content')
    <div class="card">
        <div class="card-header w-100 ">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Danh sách banner</h4>
                <a href="{{ route('banners.create') }}"><button class="btn btn-primary mt-3">Thêm mới</button></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>
                                    <img src="{{ asset($banner->image) }}" width="100px" alt="">
                                </td>
                                <td>{{ $banner->is_active == 1 ? 'Kích hoạt' : 'Khóa'}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('banners.edit',$banner->id)}}"><button class="btn btn-success">Chỉnh sửa</button></a>
                                        <form action="{{ route('banners.destroy', $banner->id) }}" method="POST"
                                            class="ms-3">
                                            @csrf
                                            @method('DELETE')
                                            <a href=""
                                                onclick="return confirm('Bạn có chắc muốn xóa không?')"><button
                                                    class="btn btn-danger ">Xóa</button></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script_libs')
    
@endsection
