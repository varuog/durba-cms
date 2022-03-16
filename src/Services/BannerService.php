<?php
namespace Varuog\DurbaCms\Services;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Product;
use Http; 
use Auth;
use Traversable;

class BannerService {

    //protected CategoryService $categoryService;

    public function __construct()
    {
        //$this->categoryService = $categoryService;
    }

    /**
     * @todo
     */
    public function search(array $filter = [], array $sort=[], $perPage=null) : Traversable {
        //Default sorting
        if(empty($sort)) {
            $sort['created_at'] = 'desc';
        }

        /**
         * Filter
         */

        //$category = $filter['category_id'];
        $link = $filter['link'] ?? '';
        $content = $filter['content'] ?? '';

        /**
         * Sorting
         */
        $sortField = array_keys($sort);
        $sortOrder = array_values($sort);

        $bannerQuery = Banner::query();

        /*
        * Filters
        */
        if(!empty($content)) {
            $bannerQuery->where("content", 'like', "{$content}%");
        }

        if(!empty($link)) {
            $bannerQuery->where("link", 'like', "{$link}%");
        }


        /**
         * Sorting
         */
        foreach($sort as $field => $order) {
            $bannerQuery->orderBy($field, $order);
        }

        if($perPage) {
            $banners = $bannerQuery->paginate($perPage);
        } else {
            $banners = $bannerQuery->get();
        }

        return $banners;
    }


    // public function fetchByCategory($category = null) {

    // }


    public function fetchById($id) {
        $bannerQuery = Banner::where('id', $id);
        //$bannerQuery->with('media', 'categories.ancestors');

        $banner = $bannerQuery->firstOrFail();
        return $banner;
    }

     /**
     * 
     */
    public function deleteById($pageId) {
        $banner = $this->fetchById($pageId);
        $banner->delete();
        return $banner;
    }


    /**
     * 
     */
    public function delete($banner) {
        $oldBanner = $banner;
        $oldBanner->delete();
        return $oldBanner;
    }
}