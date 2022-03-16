<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CmsMeta extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['content'];

    public function CmsPage() {
        return $this->belongsTo(CmsPage::class)->withDefault();
    }
}
