<?php

use App\Models\StaticOption;
use App\Models\MediaUpload;
use App\Models\Lang;

function all_languages()
{
    $languages = [
        [
            "value" => "en_US",
            "lang" => "en",
            "title" => "English (USA)"
        ],
        [
            "value" => "en_GB",
            "lang" => "en",
            "title" => "English (UK)"
        ],
        [
            "value" => "fr_FR",
            "lang" => "fr",
            "title" => "Français"
        ],
    ];

    return $languages;
}

function get_default_language()
{
    $defaultLang = Lang::where('default', 1)->first();
    return $defaultLang->slug;
}

function get_static_option($key)
{
    global $option_name;
    $option_name = $key;
    $value = \Illuminate\Support\Facades\Cache::remember($option_name, 86400, function () {
        global $option_name;
        try {
            return StaticOption::where('option_name', $option_name)->first();
        } catch (\Throwable $th) {
            return null;
        }
    });

    return !empty($value) ? $value->option_value : null;
}

function get_attachment_image_by_id($id, $size = null, $default = false)
{
    $image_details = \Illuminate\Support\Facades\Cache::remember('media-uploader-image'.$id,300,function () use ($id){
        return MediaUpload::find($id);
    });
    $return_val = [];
    $image_url = '';

    if (!empty($id) && !empty($image_details)) {
        switch ($size) {
            case "large":
                if (file_exists('assets/uploads/media-uploader/large-' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/large-' . $image_details->path);
                }
                break;
            case "grid":
                if (file_exists('assets/uploads/media-uploader/grid-' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $image_details->path);
                }
                break;
            case "thumb":
                if (file_exists('assets/uploads/media-uploader/thumb-' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/thumb-' . $image_details->path);
                }
                break;
            default:
                if (file_exists('assets/uploads/media-uploader/' . $image_details->path)) {
                    $image_url = asset('assets/uploads/media-uploader/' . $image_details->path);
                }
                break;
        }
    }

    if (!empty($image_details)) {
        $return_val['image_id'] = $image_details->id;
        $return_val['path'] = $image_details->path;
        $return_val['img_url'] = $image_url;
        $return_val['img_alt'] = $image_details->alt;
    } elseif (empty($image_details) && $default) {
        $return_val['img_url'] = asset('assets/uploads/no-image.png');
    }

    return $return_val;
}

function purify_html($html){
    return strip_tags(\Mews\Purifier\Facades\Purifier::clean($html));
}

function purify_html_raw($html){
    return \Mews\Purifier\Facades\Purifier::clean($html);
}