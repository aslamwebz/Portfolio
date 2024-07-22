<?php

test('get products page', function () {
    $response = $this->get('/products');

    $response->assertStatus(200);
});

test('products page table contains products',function (){
    $request = $this->get('/products');

    
});
