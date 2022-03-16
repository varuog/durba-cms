<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\CmsPage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            //'cms_page_id' => CmsPage::factory(),
            'link' => $this->faker->url,
            'content' => $this->faker->sentence(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Banner $banner) {

        })->afterMaking(function(Banner $banner) {

        });
    }
}