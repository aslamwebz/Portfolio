<?php

declare(strict_types=1);

test('get products page', function (): void {
    $response = $this->get('/products');

    $response->assertStatus(200);
});

test('products page table contains products', function (): void {
    $request = $this->get('/products');

});
