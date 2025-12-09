<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\ContactUs;
use App\Models\SystemSetting;
use Auth;
use Str;
class PageController extends Controller
{

    public function contactus() {
        
        $data['getRecord'] = ContactUs::getRecord();
        $data['header_title'] = 'Danh sách liên hệ';
        return view('admin.contactus.list', $data);
    }

    public function contactus_delete($id) {
        ContactUs::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', "Danh sách liên hệ đã xóa thành công");
    }
    public function list()
    {
        $data['getRecord'] = Page::getRecord();
        $data['header_title'] = 'Page';
        return view('admin.page.list', $data);
    }

    public function edit($id)
    {
        $data['getRecord'] = Page::getSingle($id);
        $data['header_title'] = "Chỉnh sửa trang";
        return view('admin.page.edit', $data);
    }

    public function update($id, Request $request)
    {
        $page = Page::getSingle($id);
        $page->name = trim($request->name);
        $page->title = trim($request->title);
        $page->description = trim($request->description);
        $page->meta_title = trim($request->meta_title);
        $page->meta_description = trim($request->meta_description);
        $page->meta_keyword = trim($request->meta_keyword);
        $page->save();

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $page->id . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/page/', $filename);

            $page->image_name = trim($filename);
            $page->save();
        }

        return redirect('admin/page/list')->with('success', "Cập nhật trang thành công");

    }

    public function system_setting()
    {
        $data['getRecord'] = SystemSetting::getSingle();
        $data['header_title'] = 'Cài đặt hệ thống';
        return view('admin.setting.system_setting', $data);
    }

    public function update_system_setting(Request $request)
    {
        $save = SystemSetting::getSingle();
        $save->website_name = trim($request->website_name);
        $save->footer_description = trim($request->footer_description);
        $save->address = trim($request->address);
        $save->phone = trim($request->phone);
        $save->phone_two = trim($request->phone_two);
        $save->submit_email = trim($request->submit_email);
        $save->email = trim($request->email);
        $save->email_two = trim($request->email_two);
        $save->working_hour = trim($request->working_hour);
        $save->facebook_link = trim($request->facebook_link);
        $save->twitter_link = trim($request->twitter_link);
        $save->instagram_link = trim($request->instagram_link);
        $save->youtube_link = trim($request->youtube_link);
        $save->pinterest_link = trim($request->pinterest_link);

        if (!empty($request->file('logo'))) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);

            $save->logo = trim($filename);
        }

        if (!empty($request->file('fevicon'))) {
            $file = $request->file('fevicon');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);

            $save->fevicon = trim($filename);
        }

        if (!empty($request->file('footer_payment_icon'))) {
            $file = $request->file('footer_payment_icon');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);

            $save->footer_payment_icon = trim($filename);
        }

        $save->save();

        return redirect()->back()->with('success', "Cập nhật cài đặt thành công");
    }
}
