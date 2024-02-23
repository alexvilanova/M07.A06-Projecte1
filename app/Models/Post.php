<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Post extends Model
{
    use HasFactory;
    use HasSEO;

    protected $fillable = ['title', 'description', 'author_id', 'file_id', 'visibility_id'];

    protected function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: $this->description,
            author: $this->author->name,
        );
    }

    public function file()
    {
       return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    public function author()
    {
        return $this->belongsTo(User::class);
    }
    
    public function liked()
    {
       return $this->belongsToMany(User::class, 'likes');
    }
    public function visibility()
    {
        return $this->belongsTo(Visibility::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
