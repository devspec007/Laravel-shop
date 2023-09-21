<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['type','banner','status','alt_tag','sequance', 'url', 'section'];

    public static function activeBanner($type){
        $banners = Banner::where('status', 'active')->where('section', $type)->orderBy('sequance')->get();
        return $banners;
    }

    public static function bannerList($pagination = false, $request = null){
        $banners = Banner::where('status', 'active')->orderBy('sequance');

        if($pagination == true) {
            $banners = $banners->paginate(20);

        }
        else {

            $banners = $banners->get();
        }
        return $banners;
    }
}
