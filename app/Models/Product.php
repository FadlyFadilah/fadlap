<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'harga', 'img'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function orderProducts($order_by)
    {
        $query = 'SELECT * FROM products ORDER BY created_at DESC';

        if ($order_by == 'best_seller') {
            $query = "SELECT p.*, oi.quantity FROM products AS p
                        LEFT JOIN (
                            SELECT product_id, SUM(quantity) AS quantity FROM order_items
                                GROUP BY product_id
                            ) AS oi ON oi.product_id = p.id
                            ORDER BY oi.quantity DESC";
        } else if ($order_by == 'terbaik') {
            $query = 'SELECT p.*, pr.rating FROM products AS p
                        LEFT JOIN (
                            SELECT product_id, AVG(rating) AS rating FROM product_reviews
                                GROUP BY product_id
                            ) AS pr ON pr.product_id = p.id
                            ORDER BY pr.rating DESC';
        } else if ($order_by == 'termurah') {
            $query = 'SELECT * FROM products ORDER BY harga desc';
        } else if ($order_by == 'termahal') {
            $query = 'SELECT * FROM products ORDER BY harga asc';
        } else if ($order_by == 'terbaru') {
            $query = 'SELECT * FROM products ORDER BY created_at DESC';
        }

        return DB::select($query);
    }
}
