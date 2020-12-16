<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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


class ProductController extends Controller
{
    use StorareImageTrait;

    private $product;
    private $category;
    private $brand;
    private $tag;
    private $productTag;

    public function __construct(Product $product,Category $category,Brand $brand,Tag $tag, ProductTag $productTag) {
        $this->product = $product;
        $this->category = $category;
        $this->brand = $brand;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.modules.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = ' ');
        $brands = $this->brand->all();
        return view ('admin.modules.product.create',\compact('htmlOption','brands'));
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
    public function store(Request $request)
    {
;
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
         foreach($request->tags as $tagItem) {
            // Insert to tags
            $tagInstance = $this->tag->firstOrCreate(['name'=>$tagItem]);
            $tagIds[] = $tagInstance->id;
         }

         $product->tags()->attach($tagIds);



       return back()->with('message','Insered SuccessFully');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
