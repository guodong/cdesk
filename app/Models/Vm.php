<?php
namespace App\Models;

class Vm extends BaseModel{
    protected $table = 'vm';
    
    protected $fillable = ['name', 'cpu', 'memory', 'os', 'server_id', 'port'];
}