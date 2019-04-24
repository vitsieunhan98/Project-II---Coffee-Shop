<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function getLogin(){
        return view('dang-nhap');
    }

    //Kiểm tra có phải Admin không
    public function isAdmin($email){
        $user = User::where('email', $email)->first();

        if($user->id_role == 1){
            return true;
        }
        return false;
    }

    //Khi submit form đăng nhập (LOGIN)
    public function postLogin(Request $req){
        $this->validate($req,
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'password.required'=>'Vui lòng nhập password'
            ]
        );
        $data = array('email'=>$req->email, 'password'=>$req->password);

        $user = User::where('email', $req->email)->first();
        if(Auth::attempt($data)){
            if($user->status) {
                if ($this->isAdmin($data['email'])) {
                    return redirect()->route('xem-product');
                }
                return redirect()->route('trang-chu');
            }
            else{
                return redirect()->back()->with('login-fail', 'Tài khoản của bạn đã bị khóa');
            }
        }
        else{
            return redirect()->back()->with('login-fail', 'Sai tên đăng nhập hoặc mật khẩu');
        }


    }

    //Khi click register (SIGN UP)
    public function getRegister(){

        return view('dang-ky');
    }

    //Khi gửi form đăng ký (SIGN UP)
    public function postRegister(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6',
                're_password'=>'required|same:password',
                'name'=>'required',
                'phone'=>'required|alpha_num|min:10|max:10'
            ],
            [
                'email.required'=>'Vui lòng nhập Email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
                'phone.required'=>'Bạn chưa nhập SĐT',
                'phone.alpha_num'=>'Sai định dạng SĐT',
                'phone.min'=>'SĐT phải có 10 chữ số',
                'phone.max'=>'SĐT phải có 10 chữ số'
            ]
        );

        $new_user = new User();
        $new_user->email = $req->email;
        $new_user->password = Hash::make($req->password);
        $new_user->id_role = 2;
        $new_user->name = $req->name;
        $new_user->phone = $req->phone;
        $new_user->status = true;
        $new_user->save();

        return redirect()->back()->with('signup-success', "Đăng ký tài khoản thành công");
    }
}
