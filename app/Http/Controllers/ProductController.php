<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Color;
use App\Models\Brand;
use Auth;
class ProductController extends Controller
{
    public function my_wishlist()
    {
        $data['meta_title'] = 'Danh sách yêu thích';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';

        $data['getProduct'] = Product::getMyWishlist(Auth::user()->id);

        return view('product.my_wishlist', $data);
    }

    public function getProductSearch(Request $request)
    {
        $data['meta_title'] = 'Tìm kiếm';
        $data['meta_description'] = '';
        $data['meta_keyword'] = '';



        $getProduct = Product::getProduct();

        $page = 0;

        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl);
            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        $data['page'] = $page;
        $data['getProduct'] = $getProduct;


        $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

        return view('product.list', $data);

    }

    public function getCategory($slug, $subslug = '')
    {
        $getProductSingle = Product::getSingleSlug($slug);
        $getCategory = Category::getSingleSlug($slug);
        $getSubCategory = SubCategory::getSingleSlug($subslug);

        $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

        if (!empty($getProductSingle)) {
            $data['meta_title'] = $getProductSingle->title;

            $data['meta_description'] = $getProductSingle->short_description;
            $data['getProduct'] = $getProductSingle;
            $data['getRelatedProduct'] = Product::getRelatedProduct($getProductSingle->id, $getProductSingle->sub_category_id);

            return view('product.detail', $data);
        } else if (!empty($getCategory) && !empty($getSubCategory)) {
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keyword'] = $getSubCategory->meta_keyword;

            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;


            $getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);

            $page = 0;

            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl);
                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            $data['page'] = $page;

            $data['getProduct'] = $getProduct;

            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id); // lọc subcategory theo category(để khi ấn vô category thì hiện danh sách subcategory tương ứng)

            return view('product.list', $data);
        } else if (!empty($getCategory)) {

            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);

            $data['getCategory'] = $getCategory;
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keyword'] = $getCategory->meta_keyword;
            $getProduct = Product::getProduct($getCategory->id);

            $page = 0;

            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl);
                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            $data['page'] = $page;
            $data['getProduct'] = $getProduct;
            return view('product.list', $data);
        } else {
            abort(404);
        }
    }

    public function getFilterProductAjax(Request $request)
    {
        $getProduct = Product::getProduct();

        $page = 0;

        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl);
            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        return response()->json([
            "status" => true, // thành công
            "page" => $page,
            "success" => view("product._list", [
                "getProduct" => $getProduct,
            ])->render(),
        ], 200);
    }

}
