<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use DOMDocument;

class SummernoteContent extends Model
{
    // Define the table associated with the model
    protected $table = 'summernote_contents'; // Adjust this as needed

    // Define the attributes that are mass assignable
    protected $fillable = ['content'];

    /**
     * Process Summernote content to sanitize and handle file uploads.
     *
     * @param string $content
     * @return string
     */
    public function processContent(string $content): string
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Suppress DOMDocument warnings
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $data = substr($src, strpos($src, ',') + 1);
                $data = base64_decode($data);
                $extension = strtolower($type[1]);

                $filename = uniqid() . '.' . $extension;
                $filePath = 'uploads/summernote/' . $filename;

                Storage::disk('public')->put($filePath, $data);

                $img->setAttribute('src', Storage::url($filePath));
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Get the content attribute with processing.
     *
     * @param string $value
     * @return string
     */
    public function getContentAttribute($value)
    {
        // Process content if needed before returning
        return $value;
    }

    /**
     * Set the content attribute and process it.
     *
     * @param string $value
     * @return void
     */
    public function setContentAttribute($value)
    {
        // Process content before saving
        $this->attributes['content'] = $this->processContent($value);
    }
}
