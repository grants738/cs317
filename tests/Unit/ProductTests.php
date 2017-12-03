<?php

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTests extends TestCase
{
    /**
     * Test that a product can be added to the database
     *
     * @return void
     */
    public function testProductCanBeInserted()
    {
    	$data = [
    		'title' => "A product",
    		'slug' => 'product',
    		'description' => 'Some awesome product',
    		'price' => 9.99,
    		'image' => 'http://someurl.com/image.jpg',
    		'stock' => 5
    	];

    	Product::create($data);

        $this->assertDatabaseHas('products',$data);
    }

    /**
     * Test that a product can be retrieved by it's slug
     *
     * @return void
     */
    public function testProductCanBeRetrievedBySlug()
    {
    	$product = Product::where('slug', 'product')->first();

    	$this->assertEquals($product->title, 'A product');
    }

    /**
     * Test that a product can be updated in the database
     *
     * @return void
     */
    public function testProductCanBeUpdated()
    {
    	$product = Product::where('slug', 'product')->first();

    	$product->title = 'An updated product';
    	$product->price = 10.99;

    	$product->save();

    	$this->assertDatabaseHas('products',[
    		'title' => 'An updated product',
    		'price' => 10.99
    	]);
    }

    /**
     * Test that a product can be deleted from the database
     *
     * @return void
     */
    public function testProductCanBeDeleted()
    {
    	$product = Product::where('slug', 'product')->first();

    	$product->delete();

    	$this->assertDatabaseMissing('products',[
    		'title' => 'An updated product',
    		'slug' => 'product'
    	]);
    }
}
