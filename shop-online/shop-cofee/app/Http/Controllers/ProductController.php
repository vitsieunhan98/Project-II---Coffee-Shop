<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\ProductType;
use App\ReplyComment;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //ĐỔ DỮ LIỆU SẢN PHẨM RA TRANG CHỦ
    public function getMainPage(){
        $products = Product::getAll();
        $sale_products = array();

        foreach ($products as $item) {
            if($item->price !== $item->promotion_price){
                array_push($sale_products, $item);
            }
        }

        $count_sale = count($sale_products);

        $top_products = Product::orderBy('rate', 'desc')->paginate(4);

        return view('trang-chu', compact('sale_products', 'count_sale', 'top_products'));
    }

    //XEM TỪNG LOẠI SẢN PHẨM
    public function getType($id){
        $type = ProductType::all();

        if($id == 1){
            $products = Product::getDrinks();
            $label = 'Các đồ uống';
            $count = count($products);
            return view('loai-san-pham', compact('type', 'products', 'label', 'count'));
        }
        else {
            $products = Product::getFoods();
            $label = 'Các đồ ăn';
            $count = count($products);
            return view('loai-san-pham', compact('type', 'products', 'label', 'count'));
        }
    }

    //XEM CHI TIẾT 1 SẢN PHẨM
    public function getDetailsProduct(Request$request, $id_product){

        //Tạo session có id của product đã chọn
        $request->session()->put('id_product_picked', $id_product);

        //Lấy sản phẩm theo $id
        $product = Product::getProduct($id_product);

        //Lấy comment trong 1 sản phẩm
        $cmts = Comment::getComment($id_product);
        //User tương ứng với từng comment trên
        $users_cmt = array();

        foreach ($cmts as $cmt){
            array_push($users_cmt, User::find($cmt->id_user));
        }

        //Lấy tất cả repcomment
        $rep_cmts = array();

        foreach ($cmts as $cmt){
            array_push($rep_cmts, ReplyComment::where('id_comment', $cmt->id)->get());
        }

        //User tương ứng với từng rep comment trên
        $users_rep_cmts = array();

        if(count($rep_cmts ) > 0){
            foreach ($rep_cmts as $rep_cmt){
                $users_rep_cmt = array();
                foreach ($rep_cmt as $one){
                        array_push($users_rep_cmt, User::where('id', $one->id_user)->first());
                }
                array_push($users_rep_cmts, $users_rep_cmt);
            }
        }

        //Sale Product và Top Product
        $products = Product::getAll();
        $sale_products = array();

        foreach ($products as $item) {
            if($item->price !== $item->promotion_price){
                array_push($sale_products, $item);
            }
        }

        $top_products = Product::orderBy('rate', 'desc')->paginate(4);

        return view('chi-tiet', compact('product', 'cmts', 'rep_cmts', 'sale_products', 'top_products', 'users_cmt', 'users_rep_cmts'));
    }


}
