<?php

namespace Database\Factories;

use App\Models\CmsPage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CmsPageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsPage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::whereIs(User::ROLE_SUPERADMIN)->first();
        $name = $this->faker->sentence();
        //dd($user);
        return [
            'created_by' => $user->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'content' => [config('app.locale') => $this->faker->paragraph(20)]
        ];
    }
}
