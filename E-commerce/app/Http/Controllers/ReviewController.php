<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class ReviewController extends Controller
{
    public function displayReview($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $id_user =  $request->query('user_id');
        return view('review', compact('product', 'id_user'));
    }


    public function review(Request $request)
    {

        $review = new Review([
            'id_user' => Auth::id(),
            'id_product' => $request->input('id_product'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'status' => 'approved'
        ]);

        $review->save();

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
        $review = Review::find($id);

        if (!$review) {
            return redirect()->back()->with('error', 'Duyệt không hợp lệ');
        }

        if ($review->status === 'approved' || $review->status === 'hide') {
            $review->status = 'browse';
        } else {
            $review->status = 'browse';
            return redirect()->back()->with('message', 'Duyệt thất bại');
        }
        $review->save();
        return redirect()->back()->with('message', 'Cập nhật đánh giá thành công');
    }
    //Trạng thái ẩn
    public function hide($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return redirect()->back()->with('error', 'Ẩn không hợp lệ');
        }

        if ($review->status === 'browse' || $review->status === 'approved' || $review->status === 'hide') {
            $review->status = 'hide';
        }
        $review->save();
        return redirect()->back()->with('message', 'Đánh giá đã được ẩn!');
    }
    //Trạng thái xóa
    public function delete($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return redirect()->back()->with('error', 'Xóa không hợp lệ');
        }
        $review->delete();
        return redirect()->back()->with('message', 'Xóa đánh giá thành công');
    }
}
