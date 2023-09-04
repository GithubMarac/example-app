<?php
 
namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $with = $request->input('with');
        $withArray = explode(',', $with);
        $diff_time = $request->input('diff_time');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => in_array('category', $withArray) ? ($this->category_id ? CategoryResource::collection(Category::where('id', 'like', $this->category_id)->get()) : []) : [],
            'tags' => in_array('tags', $withArray) ? TagResource::collection($this->tags) : [],
            'ingredients' => in_array('ingredients', $withArray) ? IngredientResource::collection($this->ingredients) : [],
            'status' => $this->status($diff_time, $this),
        ];
    }

    private function status($diff_time, $meal): string{
        switch ($diff_time) {
            case $diff_time < $meal->deleted_at:
                return 'deleted';
            case $diff_time < $meal->updated_at && $meal->updated_at > $meal->created_at:
                return 'modified';
            default:
                return 'created';
        }
    }
}