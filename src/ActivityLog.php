<?php

namespace Tuto1902\Activity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['user','ip_address','action','model_name','model_id','payload'];

}
