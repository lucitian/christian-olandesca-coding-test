<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_list_product () {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
