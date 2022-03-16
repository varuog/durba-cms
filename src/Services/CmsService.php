<?php
namespace Varuog\DurbaCms\Services;

use Varuog\DurbaCms\Models\CmsPage;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;

class CmsService {

    //will need it later
    //protected UserServiceInterface $userService;
    protected $userService;
    protected BannerService $bannerService;

    private const MEDIA_TYPES = ['banner', 'social_meta_image', 'attachment'];


    public function __construct(UserServiceInterface $userService, BannerService $bannerService)
    {
        $this->userService = $userService;
        $this->bannerService = $bannerService;

    }

    public function search(array $filter = [], array $sort=[], $perPage=null) {
        //Default sorting
        if(empty($sort)) {
            $sort['created_at'] = 'desc';
        }

        /**
         * Filter
         */

        //$category = $filter['category_id'];
        $search = $filter['search'] ?? '';
        $name = $filter['name'] ?? '';


        /**
         * Sorting
         */
        // $sortField = array_keys($sort);
        // $sortOrder = array_values($sort);

        $cmsQuery = CmsPage::query();
        
        /*
        * Filters
        */
        if(!empty($name)) {
            // $locale = config('app.locale');
            //dd($name);
            $cmsQuery->where("name", 'like', "{$name}%");
        }


        /**
         * Sorting
         */
        foreach($sort as $field => $order) {
            $cmsQuery->orderBy($field, $order);
        }

        if($perPage) {
            $cmsPages = $cmsQuery->paginate($perPage);
        } else {
            $cmsPages = $cmsQuery->get();
        }

        return $cmsPages;
    }


    /**
     * @param User $user ownser user of address
     */
    public function add(User $user, array $cmsData) {

        $patient = new CmsPage();
        $patient->name = $cmsData['name'];
        $patient->slug = $cmsData['slug'];
        $patient->content = $cmsData['content'];
        $patient->seo_title = $cmsData['seo_title'];
        $patient->social_meta = $cmsData['social_meta'];
        $patient->social_image = $cmsData['social_image'];


        $patient->user()->associate($user);
        $patient->save();

        return $patient;
    }


    /**
     * 
     */
    public function update(CmsPage $cms, array $cmsData) {

        $cms->first_name = $cmsData['first_name'];
        $cms->middle_name = $cmsData['middle_name'];
        $cms->last_name = $cmsData['last_name'];
        $cms->relation = $cmsData['relation'];
        $cms->dr_name = $cmsData['dr_name'];
        $cms->dr_mobile = $cmsData['dr_mobile'];
        $cms->dob = $cmsData['dob'];

        return $cms;
    }


    /**
     * 
     */
    public function deleteById($pageId) {
        $cms = $this->fetchById($pageId);
        $cms->delete();
        return $cms;
    }


    /**
     * 
     */
    public function delete($cms) {
        $oldCms = $cms;
        $oldCms->delete();
        return $oldCms;
    }


    /**
     * 
     */
    public function fetchById($cmsPageId) {
        $cms = CmsPage::find($cmsPageId);
        $cms->load('cmsMetas');
        return $cms;
    }

}