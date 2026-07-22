@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">الفتيح</h1>
        <p>لبيع جميع انواع الدرجات النارية, نوفر لك أقوى الدراجات النارية وأجود قطع الغيار العالمية لتنطلق بلا حدود.</p>
        <a href="{{ route('products.index') }}" class="btn hero-btn">اكتشف منتجاتنا</a>
    </div>
    <div class="hero-image">
        <div class="badge-container mobile-only">
            <div class="badge badge-top">
                <span class="badge-icon">⚡</span>
                <span class="badge-text">قيادة سلسة</span>
            </div>
            <div class="badge badge-bottom">
                <span class="badge-text">تحكم ذكي</span>
                <span class="badge-icon">⚙️</span>
            </div>
        </div>
        <!-- Using original on desktop and motorbike.png on mobile -->
        <picture>
            <source srcset="{{ asset('images/motorcycleSmallhieght.png') }}" media="(max-width: 768px)">
            <img src="{{ asset('images/motorcycle.png') }}" alt="Motorcycle" class="main-motorcycle">
        </picture>
    </div>
</section>

<section id="products" class="products-section">
    <div class="container">
        <h2 class="section-title">المتوفر لدينا</h2>
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
                <p style="text-align: center; width: 100%;">لا توجد درجات متوفرة حالياً.</p>
            @endforelse
        </div>
        <div style="text-align: center; margin-top: 50px;">
            <a href="{{ route('products.index') }}" class="btn">عرض الكل</a>
        </div>
    </div>
</section>

<section id="location" class="locations">
    <div class="map-container">
        <div class="map-dots"></div>
        <div class="map-graphic" style="background-image: url('{{ asset('images/map.png') }}'); background-size: cover; background-position: center;">
            <!-- Real Map Overlay -->
            <div class="map-overlay"></div>
            
            <!-- Pulsing Location Points -->
            <div class="location-pin" style="top: 25%; left: 35%;" title="فرع 1">
                <div class="pin-pulse"></div>
                <div class="pin-dot"></div>
                <div class="pin-label">الفرع 1</div>
            </div>
            
            <div class="location-pin" style="top: 55%; left: 65%;" title="فرع 2">
                <div class="pin-pulse"></div>
                <div class="pin-dot"></div>
                <div class="pin-label">الفرع 2</div>
            </div>
        </div>
    </div>
    <div class="locations-text">
        <h2 class="section-title" style="text-align: right;">موقعنا</h2>
        <div class="location-item">
            <h3>فرع 1</h3>
            <p>جولة النسيرية - مقابل استراحة الرئيس</p>
        </div>
        <div class="location-item">
            <h3>فرع 2</h3>
            <p>جولة وادي المعسل - بجور مياه الفرات</p>
        </div>
    </div>
</section>

<section id="contact" style="padding: 100px 0; text-align: center; border-top: 1px solid #222;">
    <h2 class="section-title">تواصل معنا</h2>
    <p style="margin-bottom: 30px; font-size: 1.2rem;">لمعرفة المزيد أو التواصل يمكنك النقر هنا</p>
    <a href="https://wa.me/967778083339" target="_blank" class="btn">تواصل عبر واتساب</a>
</section>
@endsection
