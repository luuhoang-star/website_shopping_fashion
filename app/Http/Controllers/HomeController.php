<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\SystemSetting;
use App\Models\ContactUs;
use App\Mail\ContactUsMail;
use Auth;
use Mail;
use Session;
class HomeController extends Controller
{
  public function home()
  {
    $getPage = Page::getSlug('home');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('home', $data);
  }

  public function contact()
  {
    $first_number = mt_rand(0,9);
    $second_number = mt_rand(0,9);

    $data['first_number'] = $first_number;
     $data['second_number'] = $second_number;

     Session::put('total_sum', $first_number + $second_number);


    $getPage = Page::getSlug('contact');
    $data['getPage'] = $getPage;
    $data['getSystemSetting'] = SystemSetting::getSingle();
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.contact', $data);
  }

  public function submit_contact(Request $request) {

    if (!empty($request->verification) && !empty(Session::get('total_sum'))) {

   if(trim(Session::get('total_sum')) == $request->verification) {
   
    $save = new ContactUs;
    if(!empty(Auth::check())) {
      $save->user_id = Auth::user()->id;
    }
    $save->name = trim($request->name);
    $save->email = trim($request->email);
    $save->phone = trim($request->phone);
    $save->subject = trim($request->subject);
    $save->message = trim($request->message);
    $save->save();

    $getSystemSetting = SystemSetting::getSingle();
    Mail::to($getSystemSetting->submit_email)->send(new ContactUsMail($save));

    return redirect()->back()->with('success', "Thông tin của bạn đã gửi thành công");
  } else {
       return redirect()->back()->with('error', "Bạn nhập sai phép tính kiểm tra. ");
  }} else {
    return redirect()->back()->with('error', "Bạn chưa nhập phép tính xác minh.");

  }


}


  public function about()
  {
    $getPage = Page::getSlug('about');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;

    return view('page.about', $data);
  }
  public function faq()
  {
    $getPage = Page::getSlug('faq');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.faq', $data);
  }
  public function payment_method()
  {
    $getPage = Page::getSlug('payment-method');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.payment_method', $data);
  }
  public function money_back_guarantee()
  {
    $getPage = Page::getSlug('money-back-guarantee');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.money_back_guarantee', $data);
  }
  public function return()
  {
    $getPage = Page::getSlug('return');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.return', $data);
  }
  public function shipping()
  {
    $getPage = Page::getSlug('shipping');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.shipping', $data);
  }
  public function terms_condition()
  {
    $getPage = Page::getSlug('terms-condition');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.terms_condition', $data);
  }
  public function privacy_policy()
  {
    $getPage = Page::getSlug('privacy-policy');
    $data['getPage'] = $getPage;
    $data['meta_title'] = $getPage->meta_title;
    $data['meta_description'] = $getPage->meta_description;
    $data['meta_keyword'] = $getPage->meta_keyword;
    return view('page.privacy_policy', $data);
  }

}
