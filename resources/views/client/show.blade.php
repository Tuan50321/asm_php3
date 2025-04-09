<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - Cửa hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2, h3 {
            font-weight: bold;
            color: #333;
        }

        .product-card, .related-product-card .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease-in-out;
        }

        .product-card:hover,
        .related-product-card .card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            height: 420px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .product-images {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            border-radius: 30px;
        }

        .action-buttons a,
        .action-buttons form {
            margin-right: 10px;
        }

        .action-buttons form {
            display: inline;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="mb-1">Chi tiết sản phẩm</h2>
            <p class="text-muted">Thông tin chi tiết về sản phẩm bạn đã chọn</p>
        </div>

        <div class="card product-card mb-5">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid product-image" alt="{{ $product->name }}">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h3>{{ $product->name }}</h3>
                        <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                        
                        <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                        <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                        
                        <div class="action-buttons mt-4">
                            <a href="{{ route('client.list') }}" class="btn btn-outline-secondary">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="text-center mb-4">
            <h3>Sản phẩm liên quan</h3>
            <p class="text-muted">Bạn có thể quan tâm</p>
        </div>
        <div class="row">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-2 mb-2 related-product-card">
                    <div class="card h-100">
                        @if ($relatedProduct->image)
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="product-images" alt="{{ $relatedProduct->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="product-image" alt="Không có ảnh">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p><strong>Giá:</strong> {{ number_format($relatedProduct->price, 0, ',', '.') }} VNĐ</p>
                            <a href="{{ route('client.show', $relatedProduct->id) }}" class="btn btn-info mt-auto w-100">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
