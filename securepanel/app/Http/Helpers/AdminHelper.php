<?php
/*****************************************************/
# Globals
# Page/Class name   : Globals
# Author            :
# Created Date      : 23-10-2019
# Functionality     : Common values access throughout 
#                     the project
# Purpose           : for global purpose
/*****************************************************/

namespace App\Http\Helpers;

use App\Language;
use App\State;

class AdminHelper
{
   public const ADMIN_AUTHOR_LIMIT  = 10;   // pagination limit for author list in admin panel

   public const ADMIN_PAGINATION_LIMIT  = 10;   // pagination limit for all list in admin panel

   public const UPLOADED_IMAGE_FILE_TYPES = ['jpeg', 'jpg', 'png', 'svg']; //Uploaded image file types

   public const UPLOADED_IMAGE_FILE_TYPES_FOR_CONCAT_CHECK = 'jpeg,jpg,png,svg'; //Uploaded image file types

   public const UPLOADED_IMAGE_FILE_SIZE = 2048; // Image upload max size (2mb)

   public const AUTHOR_THUMB_IMAGE_WIDTH = 150; // Author thumb image width

   public const AUTHOR_THUMB_IMAGE_HEIGHT = 150; // Author thumb image height

   public const NO_IMAGE_THUMB = 'no_image_thumb.jpg'; // Thumb no image

   public const MEDIA_CMS = '1';          // media type of cms
   public const MEDIA_SERVICE = '6';      // media type of service

   public const IMAGE_NOTE = 'For best view please upload '.self::AUTHOR_THUMB_IMAGE_WIDTH.'px X '.self::AUTHOR_THUMB_IMAGE_HEIGHT.'px image (formats: '.self::UPLOADED_IMAGE_FILE_TYPES_FOR_CONCAT_CHECK.', max: 2mb)';

   /*****************************************************/
   # AdminHelper
   # Function name : getCategoryTreeView
   # Author        : 
   # Created Date  : 24-05-2019
   # Purpose       : Getting website languages
   # Params        : 
   /*****************************************************/
   public static function getLanguages()
   {
      $getLanguages = Language::all();
      return $getLanguages;
   }
   
   /*****************************************************/
   # AdminHelper
   # Function name : generateUniqueSlug
   # Author        :
   # Created Date  : 24-10-2019
   # Purpose       : Generate unique slug
   # Params        : $model, $slug (name/title), $id
   /*****************************************************/
   public static function generateUniqueSlug($model, $slug, $id = null)
   {
      $slug = str_slug($slug);
      $currentSlug = '';
      if ($id) {
         $currentSlug = $model->where('id', '=', $id)->value('slug');
      }

      if ($currentSlug && $currentSlug === $slug) {
         return $slug;
      } else {
         $slugList = $model->where('slug', 'LIKE', $slug . '%')->pluck('slug');
         if ($slugList->count() > 0) {
            $slugList = $slugList->toArray();
            if (!in_array($slug, $slugList)) {
               return $slug;
            }
            $newSlug = '';
            for ($i = 1; $i <= count($slugList); $i++) {
               $newSlug = $slug . '-' . $i;
               if (!in_array($newSlug, $slugList)) {
                  return $newSlug;
               }
            }
            return $newSlug;
         } else {
            return $slug;
         }
      }
   }

   public static function  mediaInsert($image,$filePath, $fileName, $type, $elementId,$thumb=false, $photo=true) {
      $imageResize = \Image::make($image->getRealPath());
      $imageResize->save(public_path($filePath.'/'.$fileName));
      if ($thumb) {
         $imageResize->resize(self::AUTHOR_THUMB_IMAGE_WIDTH, self::AUTHOR_THUMB_IMAGE_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
         });
         $imageResize->save(public_path($filePath."/thumb/".$fileName));
      }
      $media = \App\Media::where('type',$type)->where('element_id',$elementId)->first();
      if ($media) {
         $newMedia = $media;   
      } else {
         $newMedia   = new \App\Media();
      }
      $newMedia->type = $type;
      $newMedia->media_type = ($photo == true)?'1':'2';
      $newMedia->element_id = $elementId;
      $newMedia->media_value  = $fileName;
      $newMedia->save();
      return $newMedia;
   }



   /*****************************************************/
   # AdminHelper
   # Function name : getCountrySpecificState
   # Author        :
   # Created Date  : 25-10-2019
   # Purpose       : Generate state with respect to country
   # Params        : $country_id
   /*****************************************************/
   public static function getCountrySpecificState($country_id) {
      $stateDetails = State::where('status',1)->where('deleted_at',NULL)->where('country_id',$country_id)->get();
      return $stateDetails;
   }

 
}