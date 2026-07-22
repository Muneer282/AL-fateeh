@extends('layouts.app')

@section('content')
<div style="padding: 50px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1>إدارة المنتجات</h1>
        <a href="{{ route('admin.products.create') }}" class="btn">إضافة منتج جديد</a>
    </div>

    @if(session('success'))
        <div style="background: #1a4d1a; color: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: var(--bg-card); padding: 20px; border-radius: 20px; border: 1px solid #222;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>الصورة</th>
                    <th>الاسم</th>
                    <th>الماركة</th>
                    <th>السعر</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td><img src="{{ $product->image_url }}" width="80" style="border-radius: 8px;"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>${{ number_format($product->price) }}</td>
                        <td>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #cc0000; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">لا توجد منتجات مضافة.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
