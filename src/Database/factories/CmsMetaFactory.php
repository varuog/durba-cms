<?php

namespace Database\Factories;

use App\Models\CmsMeta;
use App\Models\CmsPage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CmsMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsMeta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence();
        $type = $this->faker->randomElement(config('durba-cms.meta-types'));
        //['image', 'text', 'string', 'numeric', 'date']

        if($type == 'numeric') {
            $content = $this->faker->randomDigit();
        } else  if($type == 'date') {
            $content = $this->faker->date();
        }
        else  if($type == 'image') {
            $content = null; // @todo

        } else {
            $content = $this->faker->sentence();
        }

        return [

            'cms_page_id' => CmsPage::factory(),
            'type' =>  $type,
            'name' => $name,
            'slug' => Str::slug($name),
            //'group' => CmsPage::factory(),
            'content' => [config('app.locale') => $content]

        ];
    }


    public function configure()
    {
        return $this->afterCreating(function(CmsMeta $CmsMeta) {

        })->afterMaking(function(CmsMeta $CmsMeta) {

            // $cmsPage->copyMedia(storage_path('manufacturer.jpg'))
            // ->toMediaCollection(static::MEDIA_CON_LOGO);
        });
    }
}
