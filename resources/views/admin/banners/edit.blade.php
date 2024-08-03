@extends('admin.layout.master')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row mt-3">
        <div class="card col-8 mx-auto p-5">
            <h2>Sửa banner</h2>
            <form action="{{ route('banners.update', ['banner' => $banner->id]) }}" method="post" class="mt-4" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div>
                    <label for="" class="fs-4 fw-bold">Ảnh</label>
                    <img src="{{ asset($banner->image) }}" width="100px" alt=""> <br>
                    <input type="file" name="image" class="form-control mt-2">
                </div>
                <div class="mt-3">
                    <select name="is_active" id="" class="form-select">
                        <option {{ $banner->is_active == 1 ? 'selected' : '' }} value="1">Kích hoạt</option>
                        <option {{ $banner->is_active == 2 ? 'selected' : '' }} value="2">Khóa</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Sửa</button>
            </form>
        </div>
    </div>
@endsection
