@extends('admin.layout.master')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row mt-3">
        <div class="card col-8 mx-auto p-5">
            <h2>Cập nhật sản phẩm</h2>
            <form action="{{ route('Product.update', $model->id) }}" method="post" class="mt-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="fs-4 fw-bold">Tên sản phẩm</label>
                    <input type="text" placeholder="Nhập tên danh mục" name="name" class="form-control mt-2"
                        value="{{ $model->name_product }}">
                </div>
                <div>
                    <label for="" class="fs-4 fw-bold">Giá khuyến mãi</label>
                    <input type="number" placeholder="Nhập giá" name="price_new" class="form-control mt-2" min="100000" value="{{ $model->price_new }}">
                </div>
                <div>
                    <label for="" class="fs-4 fw-bold">Giá bình thường</label>
                    <input type="number" placeholder="Nhập giá" name="price_old" class="form-control mt-2" min="100000" value="{{ $model->price_old }}">
                </div>
                <div>
                    <label for="" class="fs-4 fw-bold">Ảnh</label>
                    <input type="file" name="image" class="form-control mt-2">
                    <img src="{{ Storage::url($model->image) }}" alt="" width="50px" height="50px" value="{{ $model->image }}">
                    
                    
                </div>
                <div>
                    <label for="" class="fs-4 fw-bold">Mô tả</label>
                    <input type="text" placeholder="Nhập mô tả" name="description" class="form-control mt-2"  value="{{ $model->description }}">
                </div>
                <div>
                    <label for="" class="fs-4 fw-bold mt-3">Danh mục</label>
                    <select name="category_id" id="" class="form-select mt-2" value="{{ $model->category_id }}">
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="fs-4 fw-bold">Tình trạng</label>
                    <select name="status" id="" class="form-select">
                        <option {{ $model->status == "Còn hàng" ? 'selected' : '' }} value="Còn hàng">Còn hàng</option>
                        <option {{ $model->status == "Hết hàng" ? 'selected' : '' }} value="Hết hàng">Hết hàng</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
