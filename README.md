Step 1
composer create-project --prefer-dist laravel/laravel project
2.Define Routes
Route::get("barcharts", "ProductController@get_all_products");
3.Make migration and database factory for testing
php artisan make:model Product -fm
4.Modify Product model

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
}

5.modify the products tables

Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string("name")->nullable();
    $table->string("sku")->nullable();
    $table->string("description")->nullable();
    $table->string("price")->nullable();
    $table->integer("quantity");
    $table->integer("sales");
    $table->timestamps();
});

6.migrate:

php artisan migrate

7.Gnerate Factory

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name"          =>  $faker->word,
        "sku"           =>  $faker->unique()->randomNumber,
        "description"   =>  \Str::random(20),
        "price"         =>  $faker->numberBetween(1000, 10000),
        "quantity"      =>  $faker->numberBetween(1,100),
        "sales"         =>  $faker->numberBetween(1,100)
    ];
});

8.make a controller

php artisan make:controller ProductController

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get_all_products()
    {
       $products = \App\Product::all();
       return view('product',['products' => $products]);   
    }
}

9.Create the blade files in project directory
10.php artisan  serve.
