{{-- Form thông báo lỗi --}}
@if (session('error'))
    <div class="alert alert-danger text-center mt-2">{{ session('error') }}</div>
@endif

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang người dùng - Cửa hàng sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(to right, #f0f4f8, #e9eff5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .product-card {
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 0.95rem;
            color: #555;
        }

        h1,
        h3 {
            font-weight: 700;
        }

        .btn-outline-info {
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-outline-info:hover {
            background-color: #0dcaf0;
            color: white;
        }

        .sidebar-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }

        .form-select,
        .form-control {
            border-radius: 50px !important;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="position-relative">
            <h1 class="text-center text-primary">Chào mừng đến với cửa hàng!</h1>
            <p class="text-center lead text-secondary">Khám phá những sản phẩm mới nhất và chất lượng nhất.</p>

            @if (Auth::check())
                <form action="{{ route('logout') }}" method="POST" class="logout-btn">
                    @csrf
                    <button type="submit" class="btn btn-danger">Đăng xuất</button>
                </form>
            @endif
        </div>

        <div class="row mt-5">
            {{-- Cột trái: tìm kiếm và lọc --}}
            <div class="col-md-3">
                <div class="sidebar-box mb-4">
                    <h5 class="mb-3 text-center text-info"><i class="bi bi-funnel"></i> Bộ lọc</h5>
                    <form method="GET">
                        <div class="mb-3">
                            <input type="text" name="search" class="form-control shadow-sm px-4"
                                placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
                        </div>
                        <div class="mb-3">
                            <select name="price_range" class="form-select shadow-sm px-3">
                                <option value="">Lọc theo giá</option>
                                <option value="under_500" {{ request('price_range') == 'under_500' ? 'selected' : '' }}>Dưới 500.000đ</option>
                                <option value="500_1000" {{ request('price_range') == '500_1000' ? 'selected' : '' }}>500.000đ - 1.000.000đ</option>
                                <option value="above_1000" {{ request('price_range') == 'above_1000' ? 'selected' : '' }}>Trên 1.000.000đ</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-info rounded-pill shadow-sm">
                                <i class="bi bi-search"></i> Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Cột phải: danh sách sản phẩm --}}
            <div class="col-md-9">
                <div class="row g-4">
                    @forelse ($products as $product)
                        <div class="col-md-4">
                            <div class="card product-card h-100">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-image card-img-top"
                                        alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/300x200?text=No+Image"
                                        class="product-image card-img-top" alt="Không có ảnh">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text"><strong>Giá:</strong> {{ number_format($product->price) }} đ</p>
                                    <p class="card-text text-muted">
                                        {{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>
                                </div>
                                <div class="card-footer text-center bg-white border-0">
                                    <a href="{{ route('client.show', $product->id) }}" class="btn btn-outline-info w-100">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">Không tìm thấy sản phẩm nào.</div>
                        </div>
                    @endforelse
                </div>

                {{-- Phân trang --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
