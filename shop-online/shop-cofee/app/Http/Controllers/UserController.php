<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Comment;
use App\Product;
use App\ReplyComment;
use App\User;
use App\UserRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //ĐÁNH GIÁ SẢN PHẨM (Rate)
    public function rateProduct($id_user, $id_product, Request $request){
        $rProduct = UserRate::where('id_product', $id_product)->get();
        $check = false;

        foreach ($rProduct as $one){
            if($one->id_user === $id_user){
                $check = true;
                break;
            }
        }

        $product = Product::where('id', $id_product)->first();

        if($check === false){

            $product->total_rate += 1;
            $product->rate = ($request->rate + $product->rate)/$product->total_rate;

            $product->save();

            $new_rate = new UserRate();
            $new_rate->id_user = $id_user;
            $new_rate->id_product = $id_product;
            $new_rate->rate = $request->rate;
        }
        else{
            $rate = UserRate::where('id_user', $id_user)->where('id_product', $id_product)->first();
            $product->rate = ($product->rate - $rate->rate + $request->rate)/$product->total_rate;
            $product->save();
            $rate->rate = $request->rate;
            $rate->save();
        }

        return redirect()->back();
    }

    //User click vào XEM THÔNG TIN CÁ NHÂN
    public function viewProfile($id_user){
        $user = User::find($id_user);
        $bill = Bill::where('id_user', $id_user)->get();
        $bill_detail = array();

        foreach ($bill as $item) {
            $detail = BillDetail::where('id_bill', $item->id)->get();
            array_push($bill_detail, $detail);
        }

        return view('thong-tin-ca-nhan', compact('user', 'bill_detail', 'bill'));
    }

    //ĐẶT HÀNG
    public function getOrder(){
        return view('dat-hang');
    }

    public function postOrder($id_user, Request $request){
        $cart = Session::get('cart');

        $bill = new Bill();
        $bill->id_user = $id_user;
        $bill->date_order = date('d-m-Y');
        $bill->total = $cart->totalPrice;
        $bill->note = $request->note;
        $bill->address = $request->address;
        $bill->status = false;
        $bill->save();

        foreach ($cart['items'] as $key => $value){
            $bill_detail = new BillDetail();

            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price']/$value['qty'];
            $bill_detail->save();
        }

        Session::forget('cart');

        return redirect()->back()->with('order-success', 'Đặt hàng thành công. Vui lòng đợi hệ thống xác nhận và giao hàng');
    }

    //SỬA THÔNG TIN CÁ NHÂN (Manage Account)
    public function editProfile($id, Request $request){
        $user = User::where('id', $id)->first();
        $id_role = ($request->role === 'Admin') ? 1:2;
        $this->validate($request,
            [
                'password'=>'required|min:6',
                'name'=>'required',
                'phone'=>'required|alpha_num|min:10|max:10'
            ],
            [
                'password.required'=>'Vui lòng nhập password',
                'password.min'=>'Password phải có ít nhất 6 ký tự',
                'phone.required'=>'Bạn chưa nhập SĐT',
                'phone.alpha_num'=>'Sai định dạng SĐT',
                'phone.min'=>'SĐT phải có 10 chữ số',
                'phone.max'=>'SĐT phải có 10 chữ số'
            ]
        );
        if($user->password != $request->password){
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->id_role = $id_role;

        $user->save();
        return redirect()->back()->with('edit-profile-success', 'Thay đổi thông tin thành công');
    }

    //COMMENT VÀO 1 SẢN PHẨM
    public function postComment($id_product, $id_user, Request $request){
        $comment = new Comment();
        $comment->content = $request->Content;
        $comment->id_user = $id_user;
        $comment->id_product = $id_product;

        $comment->save();

        return redirect()->back();
    }

    //REPLY MỘT COMMENT
    public function postRepComment($id_comment, $id_user, Request $request){
        $repComment = new ReplyComment();
        $repComment->id_comment = $id_comment;
        $repComment->id_user = $id_user;
        $repComment->content = $request->rep_content;

        $repComment->save();

        return redirect()->back();
    }

    //Khi ấn vào logout (LOG OUT)
    public function logout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

}
