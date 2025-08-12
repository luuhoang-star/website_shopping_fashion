<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\SubCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductImage;



use Illuminate\Support\Str;

use Auth;
class ProductController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Product::getRecord();
        $data['header_title'] = 'Product';
        return view('admin.product.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Product';
        return view('admin.product.add', $data);
    }

    public function insert(Request $request)
    {
        $title = trim($request->title);
        $product = new Product;
        $product->title = $title;
        $product->created_by = Auth::user()->id;
        $product->save();

        $slug = Str::slug($title, "-"); // tạo slug từ title,dùng Str::slug để hiện slug cách nhau -

        $checkSlug = Product::checkSlug($slug); // kiểm tra xem giống slug nhập giống ở csdl k
        if (empty($checkSlug))  // nếu slug k rỗng vs k trùng csdl thì lưu vào csdl 
        {
            $product->slug = $slug;
            $product->save();  // 1 slug duy nhất
        } else { //còn nếu slug trùng thì tạo slug mới và thêm id đằng sau rồi lưu
            $new_slug = $slug . '-' . $product->id;
            $product->slug = $new_slug;
            $product->save(); // 1 slug có nhiều id
        }
        return redirect('/admin/product/edit/' . $product->id);

    }

    public function edit($product_id)// truyền hàm vào
    {
        $product = Product::getSingle($product_id); //id trong sql của product
        if (!empty($product)) {

            $data['getCategory'] = Category::getRecordActive(); // lấy dữ liệu bảng category
            $data['getBrand'] = Brand::getRecordActive(); // lấy dữ liệu bảng brand
            $data['getColor'] = Color::getRecordActive(); // lấy dữ liệu bảng Color
            $data['product'] = $product; // dữ liệu theo id của bảng product
            $data['getSubCategory'] = SubCategory::getRecordSubCategory($product->category_id); // lấy danh sách các danh mục con của sản phẩm
            $data['header_title'] = 'Edit Product';
            return view('admin.product.edit', $data);

        }
    }

    public function update($product_id, Request $request)
    {
        $product = Product::getSingle($product_id);
        if (!empty($product)) {




            $product->title = trim($request->title);
            $product->sku = trim($request->sku);
            $product->category_id = trim($request->category_id);
            $product->sub_category_id = trim($request->sub_category_id);
            $product->brand_id = trim($request->brand_id);
            $product->price = trim($request->price);
            $product->old_price = trim($request->old_price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->additional_information = trim($request->additional_information);
            $product->shipping_returns = trim($request->shipping_returns);
            $product->status = trim($request->status);
            $product->save();

            ProductColor::DeleteRecord($product->id); // Xoá tất cả màu cũ của sản phẩm theo ID

            if (!empty($request->color_id)) { // Nếu người dùng có chọn ít nhất một màu
                foreach ($request->color_id as $color_id) { // Lặp qua từng ID màu được chọn
                    $color = new ProductColor; // Tạo bản ghi mới cho bảng product_color
                    $color->color_id = $color_id; // Gán ID màu vừa chọn
                    $color->product_id = $product->id; // Gán ID sản phẩm hiện tại
                    $color->save(); // Lưu vào database
                }
            }

            ProductSize::DeleteRecord($product->id);

            if (!empty($request->size)) {
                foreach ($request->size as $size) {
                    if (!empty($size['name'])) {
                        $saveSize = new ProductSize;
                        $saveSize->name = $size['name'];
                        $saveSize->price = !empty($size['price']) ? $size['price'] : 0;
                        $saveSize->product_id = $product->id;
                        $saveSize->save();
                    }
                }
            }

            if (!empty($request->file('image'))) { // Nếu có file ảnh được gửi
                foreach ($request->file('image') as $value) { // Lặp qua từng ảnh
                    if ($value->isValid()) { // Nếu ảnh hợp lệ
                        $ext = $value->getClientOriginalExtension(); // Lấy đuôi file ảnh
                        $randomStr = $product->id . Str::random(20); // Tạo chuỗi tên ngẫu nhiên
                        $filename = strtolower($randomStr) . '.' . $ext; // Tạo tên file đầy đủ
                        $value->move('upload/product/', $filename); // Di chuyển ảnh vào thư mục

                        $imageupload = new ProductImage; // Tạo đối tượng ảnh mới
                        $imageupload->image_name = $filename; // Gán tên ảnh
                        $imageupload->image_extension = $ext; // Gán đuôi ảnh
                        $imageupload->product_id = $product->id; // Gán ID sản phẩm
                        $imageupload->save(); // Lưu vào CSDL
                    }
                }
            }




            return redirect('admin/product/list')->with('success', 'Cập nhật sản phẩm thành công');
        } else {
            abort(404);
        }

    }

    public function image_delete($id)
    {
        $image = ProductImage::getSingle($id); // tìm kiếm bảng product_images theo id

        if (!empty($image->image_name) && !empty($image->image_extension)) {
            $filePath = public_path('upload/product/' . $image->image_name . '.' . $image->image_extension);

            if (file_exists($filePath)) {
                unlink($filePath); // xóa file ảnh
            }
        }

        $image->delete(); // xóa ảnh khỏi CSDL

        return redirect()->back()->with('success', "Ảnh sản phẩm đã được xóa thành công");
    }


    public function product_image_sortable(Request $request)
    {
        if (!empty($request->photo_id)) {
            $i = 1;
            foreach ($request->photo_id as $photo_id) {
                $image = ProductImage::getSingle($photo_id); // Sửa đúng ở đây
                $image->order_by = $i;
                $image->save();
                $i++;
            }
        }

        return response()->json(['success' => true]);
    }

}
