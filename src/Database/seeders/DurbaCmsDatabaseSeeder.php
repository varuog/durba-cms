<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Career;
use App\Models\CmsPage;
use App\Models\DiagnosticPackage;
use App\Models\DiagnosticTest;
use App\Models\Manufacturer;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Bouncer;

class DurbaCmsDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Basic 

        // $this->call([
        //     AttributeSeeder::class,
        //     CategorySeeder::class,
        //     SettingSeeder::class,
        //     RbacSeeder::class,
        //     UserSeeder::class,
        // ]);

        CmsPage::factory(10)
            ->hasCmsMetas(20)
            ->create();

        //die();
     
    }
}
