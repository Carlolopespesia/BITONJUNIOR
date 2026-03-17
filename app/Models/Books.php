<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Book extends Model

{

    protected $table = 'books';
 
    protected $fillable = [

        'title',

        'isbn',

        'publication_year',

        'publisher_id',

        'category_id',

        'author_id',

    ];
 
    public function author()

    {

        return $this->belongsTo(Author::class);

    }
 
    public function category()

    {

        return $this->belongsTo(Category::class);

    }
 
    public function publisher()

    {

        return $this->belongsTo(Publisher::class);

    }

}
 