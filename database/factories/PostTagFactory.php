<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $tag = Tag::pluck('id');
        // $post = Post::pluck('id');

        $tag = \DB::table('tags')->pluck('id');
        $post = \DB::table('posts')->pluck('id');
        return [
            'tag_id' => $this->faker->randomElement($tag),
            'post_id' => $this->faker->randomElement($post),
            
            
        ];
    }
}
