<?php
namespace App\Spatie;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        return $media->collection_name.'/'.$media->id.'/real/';
    }

    public function getPathForConversions(Media $media) : string
    {
        return $media->collection_name.'/'.$media->id.'/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $media->collection_name.'/'.$media->id.'/responsive/';
    }
}