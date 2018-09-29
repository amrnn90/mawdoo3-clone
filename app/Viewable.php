<?php

namespace App;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

trait Viewable
{
    public function view()
    {
        if (!Redis::get($this->getResourceViewersId())) {
            Redis::pipeline(function ($pipe) {
                $pipe->setex($this->getResourceViewersId(), 3600, 1);
                    // $pipe->incr($this->getResourceViewCountId());
                $pipe->zincrby(static::getResourceId(), 1, $this->id);
            });
        }
    }

    public function getViewCountAttribute()
    {
        return Redis::zscore(static::getResourceId(), $this->id);
    }
    
    public function scopeMostViewed($query)
    {
        $ids = static::mostViewedIds();
        $idsStr = implode(',', $ids);

        return $query 
            ->whereIn('id', $ids)
            ->orderByRaw(DB::raw("FIELD(id, $idsStr)"));
    }

    protected function getResourceViewersId()
    {
        $sessionId = session()->getId();
        $className = class_basename(static::class);

        return "{$className}:{$this->id}:viewers:{$sessionId}";
    }

    protected static function getResourceId()
    {
        $className = class_basename(static::class);

        return "{$className}:views";
    }

    static public function mostViewedIds() 
    {
        return Redis::zrevrange(static::getResourceId(), 0, -1);
    }


}