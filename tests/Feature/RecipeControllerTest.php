<?php

use App\Models\Recipe;

it('can show a recipe', function (Recipe $recipe) {
    $this->get('/recepten/'.$recipe->slug)
        ->assertStatus(200)
        ->assertSee($recipe->title)
        ->assertSee($recipe->created_at->format('j F Y'))
        ->assertSee($recipe->created_at->toAtomString());
})->with([
    'Test recipe 1' => fn () => Recipe::factory()->create(),
    'Test recipe 2' => fn () => Recipe::factory()->create(),
]);
