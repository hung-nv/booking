<?php

namespace App\Services;

use App\Models\ArticleContent;
use App\Models\Category;
use App\Models\MetaField;
use App\Models\Article;
use App\Models\Services;
use App\Services\Common\ImageServices;
use App\Utilities\MultiLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleServices
{
    use MultiLevel;

    private $imageServices, $menuServices;

    public function __construct(ImageServices $imageServices, MenuServices $menuServices)
    {
        $this->imageServices = $imageServices;
        $this->menuServices = $menuServices;
    }

    public function getAllIstayByLang($lang, $systemLinkType)
    {
        $result = [];

        $istays = Article::getIstay($systemLinkType, $lang)->toArray();

        foreach ($istays as $istay) {
            $iStayField = MetaField::getDataLandingById($istay['id_content'])->toArray();
            $result[] = array_merge($istay, $iStayField);
        }

        return $result;
    }

    public function getSearchInformation($dataRequest)
    {
        $isIstay = true;
        $isValidPrice = true;
        $params = [];

        if (!empty($dataRequest['where'])) {
            $isIstay = Article::findIstayById($dataRequest['where']);

            $params['where'] = $dataRequest['where'];
        }

        if (!empty($dataRequest['min']) and !empty($dataRequest['max'])) {
            if (!is_numeric($dataRequest['min']) || !is_numeric($dataRequest['max'])) {
                $isValidPrice = false;
            }

            $params['min'] = $dataRequest['min'];
            $params['max'] = $dataRequest['max'];
        }

        if (!empty($dataRequest['dateRange'])) {
            $params['dateRange'] = $dataRequest['dateRange'];
        }

        if (!empty($dataRequest['lang']) and $dataRequest['lang'] !== config('const.lang.en.alias')) {
            $params['lang'] = $dataRequest['lang'];
        }

        $valid = $isIstay and $isValidPrice;

        return ['valid' => $valid, 'params' => $params];
    }

    public function getRooms($search)
    {
        $rooms = Article::getAllRooms($search);

        return $rooms;
    }

    public function getInformationRoom($room, $lang)
    {
        $roomInformation = Article::findRoom($room, $lang)->toArray();

        $roomOption = MetaField::getDataLandingById($roomInformation['id'])->toArray();

        $roomDetails = array_merge($roomInformation, $roomOption);

        return $roomDetails;
    }

    public function getInformationIstayById($istayId, $lang)
    {
        $istayInformation = Article::findIstayInformation($istayId, $lang)->toArray();

        $iStayOption = MetaField::getDataLandingById($istayId)->toArray();

        $istayDetails = array_merge($istayInformation, $iStayOption);

        return $istayDetails;
    }

    public function getServicesByIstay($istayId, $lang)
    {
        return Services::getServices($istayId, $lang);
    }

    /**
     * Get index posts.
     * @param $request
     * @param $postType
     * @return array
     */
    public function getIndexPosts($request, $postType)
    {
        $name = empty($request['name']) ? '-1' : $request['name'];

        $posts = Article::getPostsByName($name, 20, $postType);

        return ['name' => $name, 'posts' => $posts];
    }

    /**
     * Get all pages.
     * @param array $type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getIndexPages(array $type)
    {
        $pages = Article::getAllPages($type);

        $pages = $this->resolveCollectionPage($pages);

        return $pages;
    }

    /**
     * Resolve all language of page to one record.
     * @param $pages
     * @return array
     */
    public function resolveCollectionPage($pages)
    {
        $result = [];

        foreach ($pages as $item) {
            if (array_key_exists($item['id'], $result)) {
                $result[$item['id']]['id_content_' . $item['lang']] = $item['id_content'];

                $result[$item['id']]['name_' . $item['lang']] = $item['name'];
            } else {
                $result[$item['id']] = [
                    'id' => $item['id'],
                    'id_content_' . $item['lang'] => $item['id_content'],
                    'name_' . $item['lang'] => $item['name'],
                    'landing_type' => $item['landing_type'],
                    'status' => $item['status'],
                    'created_at' => $item['created_at'],
                    'system_link_type_id' => $item['system_link_type_id'],
                ];
            }
        }

        return $result;
    }

    public function getCurrentPage($dataRequest)
    {
        if (empty($dataRequest) || empty($dataRequest['article_id'])) {
            return null;
        }

        $article = Article::findOriginArticleById($dataRequest['article_id']);

        if (!$article) {
            return null;
        }

        return $article;
    }

    /**
     * Get all istay to select parent for room.
     */
    public function getAllIstay($systemLinkType)
    {
        return Article::getIstay($systemLinkType);
    }

    /**
     * Get template checkbox category.
     * @param $categoryType
     * @param $parent
     * @param string $name
     * @return string
     * @throws \Throwable
     */
    public function getCheckboxCategory($categoryType, $parent, $name = 'parent')
    {
        $category = Category::getCategoryByType($categoryType);

        $template = $this->getTemplateCheckboxCategory($category, $parent, $name);

        return $template;
    }

    public function getTemplateCheckboxServices($parent, $name)
    {
        $services = Services::getServicesDefault();

        $template = $this->getTemplateCheckbox($services, $parent, $name);

        return $template;
    }

    /**
     * Create post.
     * @param Request $request
     * @param $postType
     * @return string
     * @throws \Exception
     */
    public function createArticle($request, $postType)
    {
        try {
            DB::beginTransaction();

            $respon = $this->storeArticle($request, $postType);

            DB::commit();

            return $respon;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Store article.
     * @param Request $request
     * @param $postType
     * @return string
     */
    public function storeArticle($request, $postType)
    {
        $data = $request->all();

        $data['user_id'] = \Auth::user()->id;
        $data['system_link_type_id'] = $postType;

        if ($request->hasFile('image')) {
            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'posts');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        if (empty($data['article_id'])) {
            // create article.
            $article = Article::create($data);
        } else {
            // code here if translate.
            $article = Article::find($data['article_id']);
        }

        $article->articleContent()->create($data);

        if (!empty($data['parent'])) {
            $article->category()->attach($data['parent']);
        }

        $message = 'Create "' . $data['name'] . '" successful';

        return $message;
    }

    /**
     * Get post by id.
     * @param Request $request
     * @param $id
     * @return array
     */
    public function getPostInformationById($request, $id)
    {
        $post = Article::findOrFail($id);

        $post_category = [];
        foreach ($post->category as $i) {
            $post_category[] = $i->id;
        }

        $name = $post->name ? $post->name : $request->old('name');
        $slug = $post->slug ? $post->slug : $request->old('slug');

        $return = [
            'post' => $post,
            'post_category' => $post_category,
            'name' => $name,
            'slug' => $slug
        ];

        return $return;
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function getArticleInformationById($request, $id)
    {
        $article = Article::getArticleContentById($id);

        $name = $article->name ? $article->name : $request->old('name');
        $slug = $article->slug ? $article->slug : $request->old('slug');

        $return = [
            'article' => $article,
            'name' => $name,
            'slug' => $slug
        ];

        return $return;
    }

    /**
     * Get data landing page.
     * @param Request $request
     * @param $id
     * @return array
     */
    public function getLandingInformationById($request, $id)
    {
        $articleContent = ArticleContent::find($id);

        $article = $articleContent->article;

        $articleServices = [];
        foreach ($article->services as $i) {
            $articleServices[] = $i->id;
        }

        $selectedServices = $request->old('services') ? $request->old('services') : $articleServices;

        $name = $articleContent->name ? $articleContent->name : $request->old('name');
        $slug = $article->slug ? $article->slug : $request->old('slug');

        $dataLanding = MetaField::getDataLandingById($id);

        $return = [
            'page' => $articleContent,
            'selectedServices' => $selectedServices,
            'name' => $name,
            'slug' => $slug,
            'dataLanding' => $dataLanding
        ];

        return $return;
    }

    /**
     * Update post.
     * @param $request
     * @param $id
     * @param bool $updateMenu
     * @return string
     * @throws \Exception
     */
    public function updatePost($request, $id, $updateMenu = false)
    {
        try {
            DB::beginTransaction();

            $response = $this->updatePostPackage($request, $id, $updateMenu);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Update post.
     * @param Request $request
     * @param int $id
     * @param bool $updateMenu
     * @return string
     * @throws \Exception
     */
    public function updatePostPackage($request, $id, $updateMenu)
    {
        $data = $request->all();

        $articleContent = ArticleContent::find($id);

        $article = $articleContent->article;

        if ($request->hasFile('image')) {
            // delete old image if exist.
            if (isset($request->old_image) && $request->old_image) {
                $this->imageServices->deleteImage($request->old_image);
            }

            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'posts');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        // update category if edit version english.
        if ($request->has(['slug'])) {
            $article->update([
                'slug' => $request->slug,
                'image' => $data['image']
            ]);
        }

        // update menu if page.
//        if ($updateMenu) {
//            $this->menuServices->updatePageToMenu($article->slug, $request->name, $request->slug);
//        }

        $articleContent->update($data);

        $message = '"' . $request->name . '" has been updated!';

        return $message;
    }

    /**
     * Create landing page.
     * @param $request
     * @param int $systemLinkType
     * @param int $landingType : default is istay.
     * @return string
     * @throws \Exception
     */
    public function createIstay($request, $systemLinkType, $landingType = Article::ISTAY_TYPE)
    {
        try {
            DB::beginTransaction();

            $response = $this->storeIstayPackage($request, $systemLinkType, $landingType);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Store landing page package.
     * @param Request $request
     * @param int $systemLinkType
     * @return string
     * @throws \Exception
     */
    public function storeIstayPackage($request, $systemLinkType, $landingType)
    {
        $istayContent = $this->storeIstay($request, $systemLinkType, $landingType);

        $data = $request->all();

        $data = $this->resolveBeforeInsertLanding($data);

        if (!empty($data)) {
            foreach ($data as $key => $v) {
                if (!empty($key) && $v) {

                    if (strlen(strstr($key, 'image')) > 0 and $request->hasFile($key)) {
                        // if input file: upload image.
                        $value = $this->imageServices->uploads($request->file($key), 'fields');
                    } else {
                        $value = $v;
                    }

                    $istayContent->fields()->create([
                        'key_name' => $key,
                        'key_value' => $value
                    ]);
                }
            }
        }

        return 'Landing page "' . $request->name . '" create successful.';
    }

    /**
     * Remove key of request not use.
     * @param $dataRequest
     * @return mixed
     */
    public function resolveBeforeInsertLanding($dataRequest)
    {
        $fillableArticle = Article::FILLABLE;

        $fillableArticleContent = ArticleContent::FILLABLE;

        $fillable = array_merge($fillableArticle, $fillableArticleContent);

        foreach ($fillable as $key) {
            unset($dataRequest[$key]);
        }

        unset($dataRequest['_token']);
        unset($dataRequest['_method']);

        // remove key services: many to many article-services.
        unset($dataRequest['services']);

        // remove key to recognize origin language.
        unset($dataRequest['language']);
        unset($dataRequest['originName']);
        unset($dataRequest['article_id']);
        unset($dataRequest['old_image']);

        return $dataRequest;
    }

    /**
     * Store istay.
     * @param Request $request
     * @param $systemLinkType
     * @param $landingType
     * @return string
     * @throws \Exception
     */
    public function storeIstay($request, $systemLinkType, $landingType)
    {
        $data = $request->all();

        if (empty($data['article_id'])) {
            // set user
            $data['user_id'] = \Auth::user()->id;
            // set system type.
            $data['system_link_type_id'] = $systemLinkType;
            // set landing type is istay.
            $data['landing_type'] = $landingType;

            if ($request->hasFile('image')) {
                // delete old image if exist.
                if (isset($request->old_image) && $request->old_image) {
                    $this->imageServices->deleteImage($request->old_image);
                }

                // upload image to folder.
                $fileName = $this->imageServices->uploads($request->file('image'), 'posts');

                if (empty($fileName)) {
                    return 'Fail';
                }

                $data['image'] = $fileName;
            }

            // create article.
            $istay = Article::create($data);
        } else {
            // code here if translate.
            $istay = Article::find($data['article_id']);
        }

        $istayContent = $istay->articleContent()->create($data);

        // save article services.
        if ($request->services) {
            $istay->services()->attach($request->services);
        }

        return $istayContent;
    }

    /**
     * Update landing package.
     * @param Request $request
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function updateLanding($request, $id)
    {
        $iStayContent = $this->saveIstay($request, $id);

        $data = $request->all();

        $data = $this->resolveBeforeInsertLanding($data);

        foreach ($data as $key => $v) {
            if ($v) {
                if (strlen(strstr($key, 'old')) > 0 and strlen(strstr($key, 'image')) > 0) {
                    continue;
                }

                $field = MetaField::getFieldByArticleIdAndName($id, $key);

                if ($request->hasFile($key)) {
                    // delete old image.
                    if (!empty($field)) {
                        $this->imageServices->deleteImage($field->key_value);
                    }

                    $value = $this->imageServices->uploads($request->file($key), 'fields');

                } else {
                    $value = $v;
                }

                if ($field) {
                    $field->update(['key_value' => $value]);
                } else {
                    $iStayContent->fields()->create([
                        'key_name' => $key,
                        'key_value' => $value
                    ]);
                }
            }
        }

        return 'Landing page "' . $request->name . '" update successful.';
    }

    /**
     * Save istay.
     * @param Request $request
     * @param $id
     * @return ArticleContent|ArticleContent[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|string
     * @throws \Exception
     */
    public function saveIstay($request, $id)
    {
        $articleContent = ArticleContent::find($id);

        $article = $articleContent->article;

        $data = $request->all();

        if (!empty($request->slug)) {
            // update english version.
            if ($request->hasFile('image')) {
                // delete old image if exist.
                if (isset($request->old_image) && $request->old_image) {
                    $this->imageServices->deleteImage($request->old_image);
                }

                // upload image to folder.
                $fileName = $this->imageServices->uploads($request->file('image'), 'posts');

                if (empty($fileName)) {
                    return 'Fail';
                }

                $data['image'] = $fileName;
            }

            $article->update($data);

            // save article services.
            if ($request->services) {
                $article->services()->sync($request->services);
            }
        }

        $articleContent->update($data);

        return $articleContent;
    }

    /**
     * Delete post image by id.
     * @param $articleId
     * @return array
     */
    public function deleteImageByPostId($articleId)
    {
        $articleContent = ArticleContent::findOrFail($articleId);

        if (!$articleContent) {
            throw new NotFoundHttpException('Not found post');
        } else {
            $deleteFile = $this->imageServices->deleteImage($articleContent->article->image);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image');
            }

            $articleContent->article->update(['image' => null]);

            return ['message' => 'Delete file successful'];
        }
    }

    /**
     * Delete image of landing page.
     * @param $pageId
     * @param $optionName
     * @return array
     * @throws \Exception
     */
    public function deleteImageLandingByPageId($pageId, $optionName)
    {
        $field = MetaField::getFieldByArticleIdAndName($pageId, $optionName);

        if (!$field) {
            throw new NotFoundHttpException('Not found page');
        } else {
            $deleteFile = $this->imageServices->deleteImage($field->key_value);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image');
            }

            $field->delete();

            return ['message' => 'Delete file successful'];
        }
    }

    /**
     * Delete page.
     * @param $pageId
     * @param $landingType
     * @return string
     * @throws \Exception
     */
    public function deletePage($pageId, $landingType)
    {
        try {
            DB::beginTransaction();

            $this->deletePagePackage($pageId, $landingType);

            DB::commit();

            return 'Your page has been deleted.';
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Delete post.
     * @param $postId
     * @return string
     * @throws \Exception
     */
    public function deletePost($postId)
    {
        try {
            DB::beginTransaction();

            $this->deletePostPackage($postId);

            DB::commit();

            return 'Your post has been deleted.';
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Delete post package.
     * @param $postId
     * @throws \Exception
     */
    public function deletePostPackage($postId)
    {
        $post = Article::find($postId);

        $post->category()->detach();

        if ($post->delete()) {
            $this->imageServices->deleteImage($post->image);
        }
    }

    /**
     * Delete page package.
     * @param int $pageId
     * @param int $landingType
     * @throws \Exception
     */
    public function deletePagePackage($pageId, $landingType)
    {
        $page = Article::find($pageId);

        $this->imageServices->deleteImage($page->image);

        $page->services()->detach();

        if ($page->system_link_type_id === $landingType) {

            // delete image of landing page.
            MetaField::whereIn('article_content_id', $page->articleContent->pluck('id'))->get()->each(function ($field) {
                if (strlen(strstr($field->key_name, 'image')) > 0) {
                    $this->imageServices->deleteImage($field->key_value);
                }
            });
        }

        $page->delete();
    }

    public function getAllPostsByParentCategory($category_id, $allCategory, $columns = [], $post_type = 1)
    {
        $ids_category = [];

        $this->getIdsCategoryByParent($allCategory, $category_id, null, $ids_category);

        $posts = DB::table('posts')->select('posts.name', 'posts.slug', 'posts.description', 'posts.image', 'posts.created_at', 'posts.type')
            ->where('posts.status', 1)
            ->where('posts.type', $post_type)
            ->join('post_category', 'posts.id', '=', 'post_category.post_id');

        $posts->where(function ($query) use ($ids_category) {
            foreach ($ids_category as $id) {
                $query->orWhere('post_category.category_id', '=', $id);
            }
        });

        $posts->orderByDesc('posts.created_at')->groupBy('posts.id');
        return $posts;
    }

    public function getIdsCategoryByParent($data, $category_id = null, $parent_id = null, &$result)
    {
        $cate_child = [];
        if (count($data) > 0) {
            foreach ($data as $key => $item) {
                // Nếu không phải danh mục được chỉ định thì bỏ qua phần tử này
                if (empty($parent_id) && isset($category_id) && $category_id) {
                    if ($item->id !== $category_id) {
                        continue;
                    }
                }

                if (empty($parent_id)) {
                    # Nếu lấy danh mục cha theo 1 danh mục cụ thể
                    $cate_child[] = $item;
                    unset($data[$key]);
                    continue;
                } else if ($item->parent_id == $parent_id) {
                    $cate_child[] = $item;
                    unset($data[$key]);
                }
            }
        }

        // Lấy danh sách chuyên mục con để xử lý tiếp
        if (isset($cate_child) && $cate_child) {
            foreach ($cate_child as $item) {
                $result[] = $item->id;
                $this->getIdsCategoryByParent($data, null, $item->id, $result);
            }
        }
    }
}