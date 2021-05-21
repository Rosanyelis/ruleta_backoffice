<?php

namespace App\Traits;
 
use Webpatser\Uuid\Uuid;
 
trait AutoGenerateUuid
{
    public static function boot()
    {
        parent::boot();
 
        static::creating(function($model){
        	$model->keyType = 'string';
            $model->incrementing = false;
            $model->{$model->getKeyName()} = $model->{$model->getKeyName()} ?: (string) Uuid::generate(4); ;
        });
    }

    public function getIncrementing()
    {
        return false;
    }
    
    public function getKeyType()
    {
        return 'string';
    }
}