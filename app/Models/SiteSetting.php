<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'meta_description',
        'site_preview_image',
        'favicon',
        'logo',
        'email',
        'phone',
        'address',
        'short_description',
        'site_link',
        'facebook_link',
        'twitter_link',
        'linkedin_link',
        'instagram_link',
        'youtube_link',
        'pinterest_link',
        'how_to_use',
        'how_to_use_link',
        'how_to_access',
        'how_to_access_link',
        'how_to_join_become_affiliate',
        'how_to_join_become_affiliate_link',


        //All Meta
        'meta_title_for_home',
        'meta_description_for_home',
        'meta_keywords_for_home',

        'meta_title_for_about',
        'meta_description_for_about',
        'meta_keywords_for_about',

        'meta_title_for_blog',
        'meta_description_for_blog',
        'meta_keywords_for_blog',

        'meta_title_for_product',
        'meta_description_for_product',
        'meta_keywords_for_product',

        'extension_file',
    ];
}
