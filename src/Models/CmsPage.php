<?php

namespace Varuog\DurbaCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class CmsPage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;
    
    public $translatable = ['content'];

    public function CmsMetas() {
        return $this->hasMany(CmsMeta::class, 'cms_page_id');
    }

    // public function banners() {
    //     return $this->hasMany(Banner::class);
    // }
}
