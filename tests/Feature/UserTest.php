<?php

declare(strict_types=1);

test('example', function (): void {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('see products on products page', function (): void {
    $request = $this->get('/products');

    $request->assertSee('products');
});
