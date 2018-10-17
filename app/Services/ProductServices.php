<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Common\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductServices
{
    protected $imageService;

    public function __construct(ImageServices $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Get catalog with products.
     * @param $idsCatalog
     * @return array|null
     */
    public function getWidgetCatalogsWithProducts($idsCatalog, $limit = 5)
    {
        $return = [];

        $dataCategory = Category::all();

        $idsCatalog = explode(',', $idsCatalog);

        if (count($idsCatalog) > 0) {

            foreach ($idsCatalog as $idCatalog) {
                $idsResult = [];

                // get all children id catalog.
                $this->getIdsCategoryByParent($dataCategory, $idCatalog, $idsResult);

                array_push($idsResult, $idCatalog);

                $products = Product::getProductsByIdsCategory($idsResult, $limit);

                $catalog = $dataCategory->where('id', $idCatalog)->first();

                if (count($products) > 0) {
                    $return[] = ['catalog' => $catalog, 'products' => $products];
                }
            }

            return $return;
        }

        return null;
    }

    /**
     * Get all children id category by id parent.
     * @param $dataCategory : all category.
     * @param null $idParent
     * @param $result
     */
    public function getIdsCategoryByParent($dataCategory, $idParent = null, &$result)
    {
        $children = [];

        if (count($dataCategory) > 0) {

            foreach ($dataCategory as $key => $item) {

                if ($item->parent_id == $idParent) {

                    $children[] = $item;

                    unset($dataCategory[$key]);
                }
            }
        }

        // get children and execute.
        if (isset($children) && $children) {

            foreach ($children as $item) {

                $result[] = $item->id;

                $this->getIdsCategoryByParent($dataCategory, $item->id, $result);
            }
        }
    }

    /**
     * Get all products.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getProducts()
    {
        return Product::getProductsWithCondition();
    }

    /**
     * Get all attribute.
     * @return Attribute[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAttributes()
    {
        return Attribute::all();
    }

    /**
     * Create product.
     * @param $request
     * @return string
     * @throws \Exception
     */
    public function createProduct($request)
    {
        try {
            DB::beginTransaction();

            $response = $this->createProductPackage($request);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Create product package.
     * @param \Request $request
     * @return string
     * @throws \Exception
     */
    public function createProductPackage($request)
    {
        $data = $request->all();
        // set user_id
        $data['user_id'] = \Auth::user()->id;

        $productImages = [];

        if ($request->hasFile('product_image')) {
            $files = $request->file('product_image');

            $isFirst = true;

            foreach ($files as $file) {
                $fileName = $this->imageService->uploads($file, 'products');

                $productImages[] = ['image' => $fileName];

                // set thumb product.
                if ($isFirst) {
                    $data['cover_image'] = $fileName;
                    $isFirst = false;
                }
            }
        }

        // create product.
        $product = Product::create($data);

        // create product images.
        if ($productImages) {
            $product->images()->createMany($productImages);
        }

        // create product catalogs.
        $product->catalogs()->attach($request->parent);

        if (!empty($request->attribute)) {
            foreach ($request->attribute as $idAttribute) {
                $attribute = AttributeValue::findOrFail($idAttribute);

                $product->product_attributes()->attach([
                    $idAttribute => ['attr_name' => $attribute->attribute->name, 'attr_value' => $attribute->attr_value]
                ]);
            }
        }

        return 'Create product "' . $request->name . '" successful';
    }

    /**
     * Update product.
     * @param $request
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function updateProduct($request, $id)
    {
        try {
            DB::beginTransaction();

            $response = $this->updateProductPackage($request, $id);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Update product package.
     * @param \Request $request
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function updateProductPackage($request, $id)
    {
        $product = Product::find($id);

        $data = $request->all();

        if ($request->hasFile('product_image')) {
            $files = $request->file('product_image');

            $productImages = [];

            $isUpdateCoverImage = false;

            if (empty($product->cover_image)) {
                $isUpdateCoverImage = true;
            }

            foreach ($files as $file) {
                $fileName = $this->imageService->uploads($file, 'products');

                $productImages[] = ['image' => $fileName];

                if ($isUpdateCoverImage) {
                    $data['cover_image'] = $fileName;
                    $isUpdateCoverImage = false;
                }
            }
        } else {
            if (empty($product->cover_image) && !empty($data['old_product_image'])) {
                $images = explode('|', $data['old_product_image']);

                if (count($images) > 0) {
                    $image = explode(':', $images[0]);
                    $data['cover_image'] = $image[0];
                }
            }
        }

        // update data product.
        $product->update($data);

        // insert product images.
        if (!empty($productImages)) {
            $product->images()->createMany($productImages);
        }

        // sync product category.
        $product->catalogs()->sync($request->parent);

        // detach product attribute values.
        $product->product_attributes()->detach();

        if (!empty($request->attribute)) {
            foreach ($request->attribute as $idAttribute) {
                $attribute = AttributeValue::findOrFail($idAttribute);

                // insert product attribute.
                $product->product_attributes()->attach([
                    $idAttribute => ['attr_name' => $attribute->attribute->name, 'attr_value' => $attribute->attr_value]
                ]);
            }
        }

        return 'Update product "' . $request->name . '" successful';
    }

    /**
     * Get data product.
     * @param Request $request
     * @param $idProduct
     * @return array
     */
    public function getDataProduct($request, $idProduct)
    {
        $product = Product::findOrFail($idProduct);

        // get product category.
        $productCatalogs = [];
        foreach ($product->catalogs as $i) {
            $productCatalogs[] = $i->id;
        }

        // get product images.
        $productImages = [];
        foreach ($product->images as $i) {
            $productImages[] = $i->image . ':' . $i->id;
        }

        // get product attribute.
        $productAttribute = [];
        foreach ($product->product_attributes as $i) {
            $productAttribute[] = $i->id;
        }

        $name = $request->old('name') ? $request->old('name') : ($product->name ? $product->name : '');
        $slug = $request->old('slug') ? $request->old('slug') : ($product->slug ? $product->slug : '');

        $parent = $request->old('parent') ? $request->old('parent') : ($productCatalogs ? $productCatalogs : '');

        $attributes = $request->old('attribute') ? $request->old('attribute') : $productAttribute;

        $return = [
            'product' => $product,
            'parent' => $parent,
            'productImages' => $productImages,
            'productAttribute' => $attributes,
            'name' => $name,
            'slug' => $slug
        ];

        return $return;
    }

    /**
     * Delete product by product id.
     * @param int $idProduct
     * @throws \Exception
     */
    public function deleteProductById($idProduct)
    {
        $product = Product::findOrFail($idProduct);

        $product->delete();
    }

    /**
     * Delete product image by id.
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteProductImageById($id)
    {
        $productImage = ProductImage::findOrFail($id);

        if (empty($productImage)) {
            throw new NotFoundHttpException('Not found image');
        }

        $this->imageService->deleteImage($productImage->image);

        $productImage->delete();

        if ($productImage->product->cover_image === $productImage->image) {
            $productImage->product()->update(['cover_image' => '']);
        }

        return ['message' => 'Delete file successful'];
    }

    /**
     * Set product cover image.
     * @param $idProduct
     * @param $coverImage
     * @return array
     */
    public function setProductCoverImage($idProduct, $coverImage)
    {
        $product = Product::find($idProduct);

        $product->cover_image = $coverImage;

        $product->save();

        return ['message' => 'This product has been update cover image'];
    }

    /**
     * Copy product
     * @param $product_id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function copyProduct($product_id)
    {
        $product = Product::find($product_id);

        // duplicate instance of product.
        $newProduct = $product->replicate();

        // check if product has number of copy
        $versionCopy = 0;
        $countCopy = Product::where('sku', 'like', '%copyof' . $product->sku . '%')->count();
        if ($countCopy > 0) {
            $versionCopy = $countCopy + 1;
        }

        // set new attribute unique.
        $newProduct->name = 'Copy of ' . $product->name;
        $newProduct->slug = 'copy-of-' . $product->slug . $versionCopy;
        $newProduct->sku = 'copyof' . $product->sku . $versionCopy;

        $newProduct->push();

        $isFirst = true;

        foreach ($product->images as $image) {
            // copy image.
            $fileName = $this->imageService->copyImage($image->image);
            // create new product image.
            $newProduct->images()->create([
                'image' => $fileName
            ]);

            if ($isFirst) {
                $newProduct->update(['cover_image' => $fileName]);
                $isFirst = false;
            }

            unset($fileName);
        }

        foreach ($product->catalogs as $catalog) {
            // create new product category.
            $newProduct->catalogs()->attach($catalog);
        }

        foreach ($product->tags as $tag) {
            // create new product tags.
            $newProduct->tags()->attach($tag);
        }

        foreach ($product->product_attributes as $attribute) {
            // create new product attribute values.
            $newProduct->product_attributes()->attach([
                $attribute->id => ['attr_name' => $attribute->attribute->name, 'attr_value' => $attribute->attr_value]
            ]);
        }

        return $newProduct;
    }

    public function getMostViewProducts($limit)
    {
        return Product::orderByDesc('view')->limit($limit)->get();
    }

    public function getPopularProducts($limit)
    {
        // TODO: Implement getPopularProducts() method.
    }

    public function getRelatedProducts($product, $limit)
    {
        $idCategory = [];
        foreach ($product->catalogs as $catalog) {
            $idCategory[] = $catalog->id;
        }

        $products = $this->getProductsByIdsCategory($idCategory)->limit($limit)->get();

        return $products;
    }

    public function getAllProductsByCategory($category_id, $columns = [], $post_type = 1)
    {
        $ids_category = [];

        $allCategory = DB::table('category')->get();

        $this->getIdsCategoryByParent($allCategory, null, $ids_category);

        $products = $this->getProductsByIdsCategory($ids_category);

        return $products;
    }
}