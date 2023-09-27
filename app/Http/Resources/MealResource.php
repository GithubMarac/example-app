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
        $translatedModel = $this->translateOrDefault($request->input('lang'));

        return [
            'id' => $this->id,
            'title' => $translatedModel->title,
            'description' => $translatedModel->description,
            'category' => $this->when(in_array('category', $withArray), CategoryResource::collection(Category::where('id', 'like', $this->category_id ?? '0')->get())),
            'tags' => $this->when(in_array('tags', $withArray), TagResource::collection($this->tags)),
            'ingredients' => $this->when(in_array('ingredients', $withArray), IngredientResource::collection($this->ingredients)),
            'status' => $this->status($diff_time, $this),
        ];
    }

    private function status($diff_time, $meal): string{
        if($diff_time == null){
            return 'created';
        }
        
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