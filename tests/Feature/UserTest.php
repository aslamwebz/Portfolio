<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('see products on products page', function () {
    $request = $this->get('/products');

    $request->assertSee('products');
});
