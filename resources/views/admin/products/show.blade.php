@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="container mt-4">
        <h2>Chi tiết sản phẩm</h2>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                        @else
                            <p class="text-muted">Không có ảnh</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h3>{{ $product->name }}</h3>
                        <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                        <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
                        <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                        <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                        <p><strong>Trạng thái:</strong> {{ $product->status ? "Hoạt động" : "Tạm dừng" }}</p>
                        
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection