<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// #[ObservedBy([CartObserver::class])]
class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'cookie_id', 'user_id', 'product_id', 'quantity', 'options'
    ];

    #-- boot()  : called when the model is initialized.
    #--         : used to customize model behavior [when the model is first loaded].
    #--         : used with creating, updating, deleting, etc.).
    #--         : used to add global scopes.

    #-- booted(): called after the boot method has been fully executed.
    #--         : meant for performing actions after the model has been completely booted.

    #-- with observers, you can either use boot or booted methods
    // public static function boot()
    // {
    //     parent::boot();
    //     // static::creating(function (Cart $cart) {
    //     //     $cart->id = Str::uuid();
    //     // });
    //     static::observe(CartObserver::class);
    // }

    public static function booted()
    {
        static::observe(CartObserver::class);
    }


    #-- Relations
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous'
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
