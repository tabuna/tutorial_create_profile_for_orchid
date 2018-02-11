<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Core\Traits\FilterTrait;
use Orchid\Platform\Core\Traits\MultiLanguage;

class History extends Model
{
    use MultiLanguage, FilterTrait;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = "auth_history";

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'platform',
        'platform_version',
        'browser',
        'browser_version',
        'address',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param        $builder
     * @param string $columns
     * @return mixed
     */
    public function scopeGetStatisticsColumns($builder,string $columns){
        return $builder->selectRaw("$columns as title,count('browser') as `values`")
            ->groupBy($columns)
            ->get()->map(function ($item) {
                $item->values = [$item->values];
                return $item;
            })->toArray();
    }

}
