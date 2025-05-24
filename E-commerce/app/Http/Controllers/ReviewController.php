<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function displayReview() 
    {
        return view('review');
    }
    
    public function review(Request $request)
    {
        // dd($request->all());
        // Kiểm tra tính hợp lệ của dữ liệu
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_product' => 'required|exists:products,id_product',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);


        // Lưu vào bảng reviews
        Review::create([
            'id_user' => $validated['id_user'],
            'id_product' => $validated['id_product'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->back()->with('message', 'Đánh giá của bạn đã được gửi thành công!');
    }
    public function managerReview() 
    {
        return view('managerreview');
    }

    public function displayManagerReview()
    {
        $reviews = Review::with(['users', 'product'])
        ->orderBy('created_at', 'desc')
        ->paginate(9);
        return view('managerreview', compact('reviews'));
    }

    //Trạng thái đang chờ duyệt
    public function apporve($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'Đang chờ duyệt';
        $review->save();
        return redirect()->back()->with('message', 'Đánh giá đã được duyệt!');
    }
    //Trạng thái ẩn
    public function hide($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'Ẩn';
        $review->save();
        return redirect()->back()->with('message', 'Đánh giá đã được ẩn!');
    }
    //Trạng thái xóa
    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'Xóa';
        $review->save();
        return redirect()->back()->with('message', 'Đánh giá đã được xóa!');
    }
}
