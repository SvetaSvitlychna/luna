<?php

namespace Database\Factories;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;
    public function definition()
    { $categories= \DB::table('categories')->pluck('id');
            $users = \DB::table('users')->pluck('id');
            $title = $this->faker->sentence($nbWords =6, $variableNbWords = true);
        return [
        
            'title' => $title,
            'slug' => SlugService::createSlug(Post::class, 'slug', $title),
            'content'=> $this->faker->paragraph($nbSentence =3, $variableNbSentences = true),
            'votes'=>$this->faker->randomDigit,
            'status'=>$this->faker->randomDigitNotNull,
            'category_id'=>$this->faker->randomElement($categories),
            'user_id'=>$this->faker->randomElement($users),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
