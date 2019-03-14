<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Product;
use App\ProductType;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //QUẢN LÝ CÁC SẢN PHẨM (KHI ADMIN ĐĂNG NHẬP)
    public function getProductView(){
        $products = Product::all();
        $types = ProductType::all();
        return view('admin-product', compact('products', 'types'));
    }

    //THÊM SẢN PHẨM
    public function addProduct(Request $request){
        $this->validate($request,
            [
                'name'=>'required',
                'price'=>'required|numeric',
                'promotion_price'=>'required|numeric',
                'id_type'=>'required'
            ],
            [
                'name.required'=>'Chưa nhập tên sản phẩm',
                'price.required'=>'Chưa nhập giá sản phẩm',
                'price.numeric'=>'Giá không hợp lệ',
                'promotion_price.required'=>'Giá sản phẩm không được để trống',
                'promotion_price.numeric'=>'Giá không hợp lệ',
                'id_type.required'=>'Chưa chọn loại sản phẩm'
            ]
        );

        $product = new Product();
        $product->id_type = $request->id_type;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->promotion_price->$request->promotion_price;
        $product->rate = 0;
        $product->total_rate = 0;

        $product->save();
        return redirect()->back()->with('addproduct-success', 'Thêm sản phẩm thành công');
    }

    //CHỈNH SỬA THÔNG TIN SẢN PHẨMM
    public function editProduct($id_product, Request $request){
        $this->validate($request,
            [
                'name'=>'required',
                'price'=>'required|numeric',
                'promotion_price'=>'required|numeric',
                'id_type'=>'required'
            ],
            [
                'name.required'=>'Tên sản phẩm không được để trống',
                'price.required'=>'Giá sản phẩm không được để trống',
                'price.numeric'=>'Giá không hợp lệ',
                'promotion_price.required'=>'Giá sản phẩm không được để trống',
                'promotion_price.numeric'=>'Giá không hợp lệ',
                'id_type.required'=>'Loại sản phẩm không được để trống'
            ]
        );

        $product = Product::find($id_product);

        $product->id_type = $request->id_type;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->promotion_price = $request->promotion_price;
        $product->description = $request->description;
        $product->image = $request->image;

        $product->save();
        return redirect()->back()->with('edit-product-success', 'Chỉnh sửa thông tin sản phẩm thành công');
    }

    //XÓA SẢN PHẨM
    public function deleteProduct($id_product){
        Product::find($id_product)->delete();

        return redirect()->back()->with('delete-product-success', 'Xóa sản phẩm thành công');
    }

    //QUẢN LÝ CÁC ĐƠN ĐẶT HÀNG
    public function getBillView(){
        $bills = Bill::orderBy('id', 'desc')->get();

        $users = array();
        foreach ($bills as $bill){
            array_push($users, User::find($bill->id_user));
        }

        $bills_detail = array();
        $products_bill = array();
        foreach ($bills as $bill){
            $details = BillDetail::where('id_bill', $bill->id)->get();
            array_push($bills_detail, $details);
            $one = array();
            foreach ($details as $item){
                array_push($one, Product::find($item->id_product));
            }
            array_push($products_bill, $one);
        }

        return view('admin-order', compact('bills', 'users', 'bills_detail', 'products_bill'));
    }

    //Xác nhận đơn hàng
    public function confirmOrder($id_bill){
        $bill = Bill::where('id', $id_bill)->first();
        $bill->status = true;
        $bill->save();

        return redirect()->back();
    }

    //QUẢN LÝ CÁC USER
    public function getUserView(){
        $users = User::getAll();
        $count_bills = array();

        foreach ($users as $user){
            $count = Bill::where('id_user', $user->id)->count();
            array_push($count_bills, $count);
        }

        return view('admin-user', compact('users', 'count_bills'));
    }

    //XEM CÁC HÓA ĐƠN/ĐƠN HÀNG ĐÃ ĐẶT CỦA 1 USER
    public function getUserBill($id_user){
        $user = User::find($id_user);

        $bill = Bill::where('id_user', $id_user)->get();

        $bill_detail = array();

        foreach ($bill as $item) {
            $detail = BillDetail::where('id_bill', $item->id)->get();
            array_push($bill_detail, $detail);
        }

        return view('admin-user-bill', compact('user', 'bill', 'bill_detail'));
    }

    //Nâng quyền
    public function upgradeRole($id_user){
        $user = User::where('Id', $id_user)->first();
        $user->id_role = 1;
        $user->save();

        return redirect()->back()->with('upgrade-success', 'Cấp quyền thành công');
    }

    //Khóa tài khoản
    public function lockUser($id_user){
        $user = User::find($id_user);
        $user->status = false;
        $user->save();

        return redirect()->back()->with('lock-success', 'Khóa tài khoản thành công');
    }

    //Bỏ khóa tài khoản
    public function unlockUser($id_user){
        $user = User::find($id_user);
        $user->status = true;
        $user->save();

        return redirect()->back()->with('unlock-success', 'Bỏ khóa tài khoản thành công');
    }
}
