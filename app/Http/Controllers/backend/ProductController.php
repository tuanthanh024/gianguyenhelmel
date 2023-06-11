<?php

namespace App\Http\Controllers\backend;

use App\Helpers\ProductCodeHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        $jsonPath = public_path('json/');
        if (!is_dir($jsonPath)) {
            mkdir($jsonPath, 0777, true);
        }
        File::put($jsonPath . 'products.json', json_encode(Product::all()));

        return view('backend.product.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('backend.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('featured_image')) {
                if ($request->file('featured_image')->isValid()) {
                    $featuredImage = $request->file('featured_image');
                    $featuredImageName = md5(time() . rand()) . '.' . $featuredImage->getClientOriginalExtension();
                    $featuredImage->storeAs('public/products', $featuredImageName);
                }
            }

            $product = new Product();
            $product->code = ProductCodeHelper::generateCode();
            $product->name = $request->name;
            $product->slug = Str::slug($product->name);
            $product->price = preg_replace('/[,. ]/', '', $request->price);
            $product->description = $request->description;
            $product->featured_image = $featuredImageName;
            $product->category_id = $request->category_id;
            $product->status = $request->status;
            $product->quantity = $request->quantity;
            $product->discount = preg_replace('/[,. ]/', '', $request->discount);
            $product->color = $request->color;
            $product->screen_technology = $request->screen_technology;
            $product->os = $request->os;
            $product->cpu = $request->cpu;
            $product->resolution = $request->resolution;
            $product->front_camera = $request->front_camera;
            $product->rear_camera = $request->rear_camera;
            $product->ram = $request->ram;
            $product->rom = $request->rom;
            $product->sim = $request->sim;
            $product->pin = $request->pin;
            $product->save();

            foreach ($this->uploadMultipleImages($request) as $item) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->name = $item;
                $productImage->save();
            }
            if (!empty($request->tags)) {
                foreach ($request->tags as $item) {
                    $tag = Tag::firstOrCreate(['name' => $item]);
                    $product->tags()->attach($tag->id);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (Exception $e) {
            DB::rollBack();
            return "Them san pham khong thanh cong";
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $imagePaths = [];
            $product = Product::find($id);

            if ($request->hasFile('featured_image')) {
                if ($request->file('featured_image')->isValid()) {
                    $featuredImage = $request->file('featured_image');
                    $featuredImageName = md5(time() . rand()) . '.' . $featuredImage->getClientOriginalExtension();
                    $featuredImage->storeAs('public/products', $featuredImageName);
                    $imagePaths[] = 'public/products/' . $product->featured_image;
                }
            }

            $product->name = $request->name;
            $product->slug = Str::slug($product->name);
            $product->price = preg_replace('/[,. ]/', '', $request->price);
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->discount = preg_replace('/[,. ]/', '', $request->discount);
            $product->color = $request->color;
            $product->screen_technology = $request->screen_technology;
            $product->os = $request->os;
            $product->cpu = $request->cpu;
            $product->resolution = $request->resolution;
            $product->front_camera = $request->front_camera;
            $product->rear_camera = $request->rear_camera;
            $product->ram = $request->ram;
            $product->rom = $request->rom;
            $product->sim = $request->sim;
            $product->pin = $request->pin;
            $product->category_id = $request->category_id;
            $product->status = $request->status;
            if (isset($featuredImageName)) {
                $product->featured_image = $featuredImageName;
            }
            $product->update();

            $imageLists = $this->uploadMultipleImages($request);
            if (!empty($imageLists)) {
                /**
                 * xóa ảnh cũ
                 */
                $productImages = $product->productImages;
                foreach ($productImages as $item) {
                    $imagePaths[] = 'public/products/' . $item->name;
                    $item->delete();
                }
                Storage::delete($imagePaths);

                foreach ($imageLists as $item) {
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->name = $item;
                    $productImage->save();
                }
            }

            foreach ($request->tags as $item) {
                $tag = Tag::firstOrCreate(['name' => $item]);
                $tagIds[] = $tag->id;
            }
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function destroy($id)
    {
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $productImages = $product->productImages;
        $imagePaths[] = 'public/products/' . $product->featured_image;
        foreach ($productImages as $item) {
            $imagePaths[] = 'public/products/' . $item->name;
            $item->delete();
        }
        Storage::delete($imagePaths);
        $product->tags()->detach();
        $product->delete();
        return response()->json([
            'message' => 'You don\'t have any products yet, please click the add button to add a new product.',
            'empty' => Product::all()->count() == 0
        ]);
    }

    public function setFeaturedProduct(Request $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($request->id);
            $product->featured = $product->featured == 1 ? 0 : 1;
            $product->update();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollBack();
        }
        return response()->json(['status' => false]);
    }




    function uploadMultipleImages(Request $request, $folder = 'public/products')
    {
        $fileNames = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $item) {
                if ($item->isValid()) {
                    $fileName = md5(time() . rand()) . '.' . $item->getClientOriginalExtension();
                    $item->storeAs($folder, $fileName);
                    array_push($fileNames, $fileName);
                }
            }
        }
        return $fileNames;
    }
}
