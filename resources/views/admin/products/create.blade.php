@extends('layouts.app')

@section('content')
<div style="padding: 50px 0; max-width: 600px; margin: 0 auto;">
    <h1 style="margin-bottom: 30px;">إضافة دراجة نارية جديدة</h1>

    <div style="background: var(--bg-card); padding: 30px; border-radius: 20px; border: 1px solid #222;">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>اسم الدراجة</label>
                <input type="text" name="name" class="form-control" required placeholder="مثال: Yamaha R1">
            </div>

            <div class="form-group">
                <label>الماركة / النوع</label>
                <input type="text" name="brand" class="form-control" required placeholder="مثال: Yamaha, Kawasaki, Scooter">
            </div>

            <div class="form-group">
                <label>السعر ($)</label>
                <input type="number" name="price" class="form-control" required placeholder="0.00">
            </div>

            <div class="form-group">
                <label>صورة المنتج</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn" style="width: 100%;">حفظ المنتج</button>
            </div>
            <div style="margin-top: 15px; text-align: center;">
                <a href="{{ route('admin.products.index') }}" style="color: #888; text-decoration: none;">إلغاء والعودة</a>
            </div>
        </form>
    </div>
</div>
@endsection
