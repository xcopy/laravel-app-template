<?php

namespace App\Models;

use App\Contracts\Blameable;
use App\Contracts\SoftDeletable;
use App\Policies\MediaPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

#[UsePolicy(MediaPolicy::class)]
class Media extends BaseMedia implements Blameable, SoftDeletable
{
    use BlameableTrait;
    use SoftDeletes;
}
