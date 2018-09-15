<?php

namespace App;
use Illuminate\Support\Facades\Redis;

trait Viewable {
    public function view()
    {
        if (!Redis::get($this->getResourceViewersId())) {
            Redis::pipeline(function ($pipe) {
                $pipe->setex($this->getResourceViewersId(), 3600, 1);
                $pipe->incr($this->getResourceViewCountId());
            });
        }
    }

    public function getViewCountAttribute()
    {
        return Redis::get($this->getResourceViewCountId());
    }

    protected function getResourceViewersId() 
    {
        $sessionId = session()->getId();
        $className = static::class;

        return "{$className}:{$this->id}:viewers:{$sessionId}";
    }

    protected function getResourceViewCountId() 
    {
        $className = static::class;

        return "{$className}:{$this->id}:viewcount";
    }


}