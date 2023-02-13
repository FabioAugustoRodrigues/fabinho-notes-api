<?php

namespace App\Http\Resources;

use App\Models\Note;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public static $wrap = null;
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "note_id" => $this->note_id,
            "slug" => $this->slug,
            "title" => $this->title,
            "content" => $this->content,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "child_notes" => Note::where('note_id', $this->id)
                ->with('childNotes')
                ->get()
        ];
    }
}
