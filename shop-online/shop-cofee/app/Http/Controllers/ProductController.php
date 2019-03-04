<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\ProductType;
use App\ReplyComment;
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

        return view('trang-chu', compact('sale_products', 'count_sale'));
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
    public function getDetailsProduct(Request$request, $id){

        //Tạo session có id của product đã chọn
        $request->session()->put('id_product_picked', $id);

        //Lấy sản phẩm theo $id
        $product = Product::getProduct($id);

        //Lấy comment trong 1 sản phẩm
        $cmts = Comment::getComment($id);

        //Lấy tất cả repcomment
        $repComment = ReplyComment::getAll();

        return view('chi-tiet', compact('product', 'cmts', 'repComment'));
    }


}
