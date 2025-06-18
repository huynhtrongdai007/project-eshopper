<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Traits\StorareImageTrait;
use Storage;
use DateTime;
use App\Components\Recursive;   
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\ProductTag;
use DB;
use App\Http\Requests\ProductAddRequest;

class ProductController extends Controller
{
    use StorareImageTrait;

    private $product;
    private $category;
    private $brand;
    private $tag;
    private $productTag;

    public function __construct(Product $product,Category $category,Brand $brand,Tag $tag, ProductTag $productTag,ProductImage $productImage) {
        $this->product = $product;
        $this->category = $category;
        $this->brand = $brand;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productImage = $productImage;
        $brands = $this->brand->all();
 
        view()->share('brands',$brands);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();
        return view ('admin.modules.product.index',\compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view ('admin.modules.product.create',\compact('htmlOption'));
    }

    public function getCategory($parent_id) {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),   
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'content' => $request->content,
                'created_at' => new DateTime()
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request,'feature_image','products');
            if(!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image'] =  $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] =  $dataUploadFeatureImage['file_path'];
            }
            $product =  $this->product->create($dataProductCreate);
    
            //Insert data to product_iamge
                if($request->hasFile('image_path')) {
                foreach($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem,'products');
                    $product->images()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //insert tags for product
            $tagIds = [];
            if(!empty($request->tags)) {
            foreach($request->tags as $tagItem) {
                // Insert to tags
                $tagInstance = $this->tag->firstOrCreate(['name'=>$tagItem]);
                $tagIds[] = $tagInstance->id;
                }

            }
            $product->tags()->attach($tagIds);

            DB::commit();
            return back()->with('message','Insered SuccessFully');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
        }
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.modules.product.edit',\compact('product','htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),   
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'content' => $request->content, 
                'created_at' => new DateTime()
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request,'feature_image','products');
            dd($dadataUploadFeatureImageta);
            if(!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image'] =  $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] =  $dataUploadFeatureImage['file_path'];
            }
             $this->product->find($id)->update($dataProductUpdate);
             $product = $this->product->find($id);
             //Insert data to product_iamge
             if($request->hasFile('image_path')) {
                $this->productImage->where('product_id',$id)->delete();
        
                foreach($request->image_path as $fileItem) {
                  $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem,'products');
                  $product->images()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image' => $dataProductImageDetail['file_name']
                  ]);
                }
             }
    
             //insert tags for product
             $tagIds = [];
             if(!empty($request->tags)) {
                foreach($request->tags as $tagItem) {
                    // Insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name'=>$tagItem]);
                    $tagIds[] = $tagInstance->id;
                 }
             }

             $product->tags()->sync($tagIds);
             DB::commit();
             return redirect()->route('admin.product.index')->with('message','Insered SuccessFully');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);

        }catch(\Exception $exception) {
            Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());

            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }
    }

    
    public function StatusActive(Request $request) {
        $id = $request->id;
        $this->product->where('id',$id)->update(['status'=>1]);
    }

    public function StatusUntive(Request $request) {
        $id = $request->id;
        $this->product->where('id',$id)->update(['status'=>0]);
    }
}
