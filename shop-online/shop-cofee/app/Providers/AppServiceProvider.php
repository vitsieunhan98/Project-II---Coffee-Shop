<?php

namespace App\Providers;

use App\Cart;
use App\Product;
use App\ProductType;
use function foo\func;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(255);
        view()->composer('header', function ($view){
           $types = ProductType::all();

           $view->with('types', $types);
        });

        view()->composer('header', function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items,
                    'totalPrice'=>$cart->totalPrice, 'totalQty'=>$cart->totalQty]);
            }
        });

        view()->composer('dat-hang', function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items,
                    'totalPrice'=>$cart->totalPrice, 'totalQty'=>$cart->totalQty]);
            }
        });

        view()->composer('header', function($view){
            $products = Product::getAll();

            $view->with('products', $products);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
