<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use DOMDocument;
use Illuminate\Support\Str;

class SummernoteContent extends Model
{
    protected $table = 'summernote_contents';
    protected $fillable = ['content'];

    public function processContent(string $content): string
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $data = substr($src, strpos($src, ',') + 1);
                $data = base64_decode($data);
                $extension = strtolower($type[1]);

                $filename = Str::random(20) . '.' . $extension;
                $filePath = 'uploads/summernote/' . $filename;

                Storage::disk('public')->put($filePath, $data);

                $img->setAttribute('src', Storage::url($filePath));
            }
        }

        return $dom->saveHTML();
    }

    public function getContentAttribute($value)
    {
        return $value;
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = $this->processContent($value);
    }
}