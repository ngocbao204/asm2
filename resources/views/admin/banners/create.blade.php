@extends('admin.layout.master')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row mt-3">
        <div class="card col-8 mx-auto p-5">
            <h2>Thêm banner</h2>
            <form action="{{ route('banners.store') }}" method="post" class="mt-4" enctype="multipart/form-data">
                @csrf
                
                <div>
                    <label for="" class="fs-4 fw-bold">Ảnh</label>
                    <input type="file" name="image" class="form-control mt-2">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Thêm mới</button>
            </form>
        </div>
    </div>
@endsection
