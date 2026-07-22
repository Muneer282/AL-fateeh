@extends('layouts.app')

@section('content')
<div style="padding: 50px 0;">
    <h1 class="section-title">جميع المنتجات</h1>
    
    <div style="text-align: center; margin-bottom: 50px;">
        <nav style="display: inline-flex; gap: 10px; background: #111; padding: 10px; border-radius: 50px;">
            <a href="{{ route('products.index', ['brand' => 'all']) }}" class="btn {{ request('brand') == 'all' || !request('brand') ? '' : 'btn-outline' }}" style="background: {{ request('brand') == 'all' || !request('brand') ? '' : 'transparent' }}; border: 1px solid var(--primary-color);">الكل</a>
            @foreach($brands as $brand)
                <a href="{{ route('products.index', ['brand' => $brand]) }}" class="btn" style="background: {{ request('brand') == $brand ? '' : 'transparent' }}; border: 1px solid var(--primary-color);">{{ $brand }}</a>
            @endforeach
        </nav>
    </div>

    <div class="products-grid">
        @forelse($products as $product)
            <a href="https://wa.me/967778083339?text={{ urlencode('السلام عليكم، أود الاستفسار عن الدراجة: ' . $product->name . ' (' . $product->brand . ')') }}" target="_blank" class="product-card-link">
                <div class="product-card">
                    <img src="{{ $product->image_url }}" class="product-image" alt="{{ $product->name }}">
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->brand }}</p>
                        <div class="price">${{ number_format($product->price) }}</div>
                    </div>
                </div>
            </a>
        @empty
            <p style="text-align: center; width: 100%;">لا توجد منتجات مطابقة لهذا النوع.</p>
        @endforelse
    </div>
</div>
@endsection
