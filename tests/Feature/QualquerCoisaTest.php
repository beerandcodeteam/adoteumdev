<?php

it('has qualquercoisa page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
