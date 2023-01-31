<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\DeclareDeclare;


class AdminProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;



    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag){
        $this->category= $category;
        $this->product= $product;
        $this->productImage= $productImage;
        $this->tag= $tag;
        $this->productTag= $productTag;



    }
    public  function  index(){
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index',compact('products'));
    }
    public function create(){
        $htmlOption = $this->getCategory($parentId = '');

        return view('admin.product.add',compact('htmlOption'));
    }
    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $dataProductCreate  = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id'=> auth()->id(),
                'category_id' => $request->category_id

            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)){
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            //insert data to product_image

            if ($request->hasFile('image_path')){
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem,'product');
                    $product->images()->create([
                        'image_path'=> $dataProductImageDetail['file_path'],
                        'image_name'=> $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //insert tags for product
            if (!empty($request->tags)){
                foreach ($request->tags as $tagItem){
                    $tagInstance = $this->tag->firstOrCreate(['name'=>$tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->attach($tagIds);
            DB::commit();


            return redirect()->route('product.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: ' .$exception->getMessage() . 'Line : ' .$exception->getLine());
        }


    }

    public function edit($id){
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($parentId = '');

        return view('admin.product.edit',compact('htmlOption','product'));
    }
}
