class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'product_code' => $this->product_code,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category'))
        ];
    }
} 