<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Document extends Model
{
    use Searchable;
    protected $fillable = [
        'title',
        'content',
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
        ];
    }

}
