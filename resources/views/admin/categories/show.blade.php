{{-- filepath: d:\laragon\www\wd19305\resources\views\categories\show.blade.php --}}
@extends('admin.layouts.app')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('title', 'Chi tiết danh mục')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2 class="card-title">Chi tiết danh mục</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="text">{{ $category->name }}</h3>
                        <p>
                            <strong>Trạng thái:</strong> 
                            <span class="badge {{ $category->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $category->status == 1 ? 'Hoạt động' : 'Ngừng hoạt động' }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection