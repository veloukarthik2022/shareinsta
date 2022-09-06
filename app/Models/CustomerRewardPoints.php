<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRewardPoints extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id","referre_id","product_id","order_id","points","status"];

    protected $table = "customer_rewards_history";
}
