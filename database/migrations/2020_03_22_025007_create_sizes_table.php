<?php

use App\Models\Size;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('abbr');
            $table->string('name');
            $table->string('color');
            $table->boolean('available');
            $table->integer('price');
            $table->timestamps();
        });

        $rows = [
            [
                'slug' => 'blackys',
                'abbr' => 'YS',
                'name' => 'Youth Small',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blackym',
                'abbr' => 'YM',
                'name' => 'Youth Medium',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blackyl',
                'abbr' => 'YL',
                'name' => 'Youth Large',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blackyxl',
                'abbr' => 'YXL',
                'name' => 'Youth Extra Large',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blacksm',
                'abbr' => 'SM',
                'name' => 'Small',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blackmd',
                'abbr' => 'MD',
                'name' => 'Medium',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blacklg',
                'abbr' => 'LG',
                'name' => 'Large',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blackxl',
                'abbr' => 'XL',
                'name' => 'Extra Large',
                'color' => 'Black',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'blackxxl',
                'abbr' => 'XXL',
                'name' => 'Extra Extra Large',
                'color' => 'Black',
                'available' => true,
                'price' => 2100,
            ],
            [
                'slug' => 'blackxxxl',
                'abbr' => 'XXXL',
                'name' => 'Extra Extra Extra Large',
                'color' => 'Black',
                'available' => true,
                'price' => 2200,
            ],
            [
                'slug' => 'grayys',
                'abbr' => 'YS',
                'name' => 'Youth Small',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'grayym',
                'abbr' => 'YM',
                'name' => 'Youth Medium',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'grayyl',
                'abbr' => 'YL',
                'name' => 'Youth Large',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'grayyxl',
                'abbr' => 'YXL',
                'name' => 'Youth Extra Large',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'graysm',
                'abbr' => 'SM',
                'name' => 'Small',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'graymd',
                'abbr' => 'MD',
                'name' => 'Medium',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'graylg',
                'abbr' => 'LG',
                'name' => 'Large',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'grayxl',
                'abbr' => 'XL',
                'name' => 'Extra Large',
                'color' => 'Gray',
                'available' => true,
                'price' => 2000,
            ],
            [
                'slug' => 'grayxxl',
                'abbr' => 'XXL',
                'name' => 'Extra Extra Large',
                'color' => 'Gray',
                'available' => true,
                'price' => 2100,
            ],
            [
                'slug' => 'grayxxxl',
                'abbr' => 'XXXL',
                'name' => 'Extra Extra Extra Large',
                'color' => 'Gray',
                'available' => true,
                'price' => 2200,
            ],
        ];

        foreach($rows as $row) {
            Size::create($row);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
