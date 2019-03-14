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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //ĐÁNH GIÁ SẢN PHẨM (Rate)
    public function rateProduct($id_product, Request $request){
        if(!Auth::check()) return redirect()->route('an-dang-nhap');
        else{
            $rProduct = UserRate::where('id_product', $id_product)->get();
            $check = false;

            foreach ($rProduct as $one){
                if($one->id_user == Auth::id()){
                    $check = true;
                    break;
                }
            }

            $product = Product::where('id', $id_product)->first();

            if(!$check){
                $product->total_rate += 1;
                $product->rate = ($request->rate + $product->rate)/$product->total_rate;

                $product->save();

                $new_rate = new UserRate();
                $new_rate->id_user = Auth::id();
                $new_rate->id_product = $id_product;
                $new_rate->rate = $request->rate;
                $new_rate->save();
            }
            else{
                $rate = UserRate::where('id_user', Auth::id())->where('id_product', $id_product)->first();
                $product->rate = ($product->rate - $rate->rate + $request->rate)/$product->total_rate;
                $product->save();
                $rate->rate = $request->rate;
                UserRate::where('id_user', Auth::id())->where('id_product', $id_product)->update(['rate'=>$request->rate]);
            }

            return redirect()->back();
        }
    }

    //User click vào XEM THÔNG TIN CÁ NHÂN
    public function viewProfile(){
        $user = User::find(Auth::id());
        $bills = Bill::where('id_user', Auth::id())->get();
        $bill_detail = array();
        $products_bill = array();
        foreach ($bills as $item) {
            $detail = BillDetail::where('id_bill', $item->id)->get();
            array_push($bill_detail, $detail);
            $one = array();
            foreach ($detail as $item){
                array_push($one, Product::find($item->id_product));
            }
            array_push($products_bill, $one);
        }

        return view('thong-tin-ca-nhan', compact('user', 'bill_detail', 'bills', 'products_bill'));
    }

    //ĐẶT HÀNG
    public function getOrder(){
        return view('dat-hang');
    }

    public function postOrder(Request $request){
        $this->validate($request,
            [
                'address'=>'required'
            ],
            [
                'address.required'=>'Yêu cầu nhập địa chỉ giao hàng'
            ]
        );
        $cart = Session::get('cart');
        $bill = new Bill();
        $bill->id_user = Auth::id();
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        if($request->note != null){
            $bill->note = $request->note;
        }
        else{
            $bill->note = 'Không có';
        }

        $bill->address = $request->address;
        $bill->status = false;
        $bill->save();

        foreach ($cart->items as $key => $value){
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
    public function editProfile(Request $request){
        $user = User::where('id', Auth::id())->first();
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
        $user->name = $request->name;
        $user->phone = $request->phone;

        $user->save();
        return redirect()->back()->with('edit-profile-success', 'Thay đổi thông tin thành công');
    }

    //COMMENT VÀO 1 SẢN PHẨM
    public function postComment($id_product, Request $request){
        $comment = new Comment();
        $comment->content = $request->Content;
        $comment->id_user = Auth::id();
        $comment->id_product = $id_product;

        $comment->save();

        return redirect()->back();
    }

    //REPLY MỘT COMMENT
    public function postRepComment($id_comment, Request $request){
        $repComment = new ReplyComment();
        $repComment->id_comment = $id_comment;
        $repComment->id_user = Auth::id();
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
