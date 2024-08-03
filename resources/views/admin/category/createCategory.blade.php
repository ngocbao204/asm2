@extends('admin.layout.master')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row mt-3">
        <div class="card col-8 mx-auto p-5">
            <h2>Thêm danh mục mới</h2>
            <form action="{{ route('Category.store') }}" method="post" class="mt-4">
                @csrf
                <div>
                    <label for="" class="fs-4 fw-bold">Tên danh mục</label>
                    <input type="text" placeholder="Nhập tên danh mục" name="name" class="form-control mt-2">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Thêm mới</button>
            </form>
        </div>
    </div>
@endsection
