<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

use function Laravel\Prompts\alert;

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
    public function approve($id)
    {
        $review = Review::findOrFail($id);

        if ($review->status === 'approved' || $review->status === 'hide') {
            $review->status = 'browse';
        }else {
            $review->status = 'browse';
            return redirect()->back()->with('message', 'Duyệt thất bại');
        }
        $review->save();
        return redirect()->back()->with('message', 'Duyệt thành công');
    }
    //Trạng thái ẩn
    public function hide($id)
    {
        $review = Review::findOrFail($id);
        if($review->status === 'browse' || $review->status === 'approved' || $review->status === 'hide') {
            $review->status = 'hide';
        }
        $review->save();
        return redirect()->back()->with('message', 'Đánh giá đã được ẩn!');
    }
    //Trạng thái xóa
    public function delete($id)
    {
        $review = Review::findOrFail( $id);
        $review->delete();
        return redirect()->back()->with('message', 'Xóa đánh giá thành công');
    }
}
