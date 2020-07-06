<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Ad extends Model
{
    use Notifiable;

    protected $fillable = [
        'title',
        'price',
        'texte',
        'category_id',
        'region_id',
        'user_id',
        'departement',
        'commune',
        'commune_name',
        'commune_postal',
        'pseudo',
        'email',
        'limit',
        'active',
    ];

    // Obtenez la région propriétaire de l'annonce.
    private $user_id;
    private $active;

    public function whereHas(string $string, \Closure $param)
    {
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    //Obtenez la catégorie à laquelle appartient l'annonce.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // et les photos de l'annonce
    public function photos()
    {
        return $this->hasMany(Upload::class);
    }
}
