<?php
namespace App\Models;

class Server extends BaseModel{
    protected $table = 'server';
    
    protected $fillable = ['name', 'ip'];
}