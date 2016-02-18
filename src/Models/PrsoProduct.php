<?php

namespace Angrydeer\Productso\Models;

use Illuminate\Database\Eloquent\Model;
use Angrydeer\Attachfiles\AttachableTrait;
use Angrydeer\Attachfiles\AttachableInterface;
use Request;
use Sentinel;

class PrsoProduct extends Model implements AttachableInterface
{
    use AttachableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'category_id', 'cost',  'note', 'description', 'status', 'artikul', 'views', 'show', 'complected', 'complect_id'
    ];

    public function categories()
    {
        return $this->belongsToMany('Angrydeer\Productso\Models\PrsoCategory');
    }

    public function parentCategories()
    {
        return $this->belongsToMany('Angrydeer\Productso\Models\PrsoCategory');
    }

    public function setSlugAttribute($slug)
    {

        if($slug=='') $slug = str_slug(Request::get('name'));
        if($cat= self::where('slug',$slug)->first()){
            $idmax=self::max('id')+1;
            if(isset($this->attributes['id']))
            {
                if ($this->attributes['id'] != $cat->id ){
                    $slug=$slug.'_'.++$idmax;
                }
            }
            else
            {
                if (self::where('slug',$slug)->count() > 0)
                    $slug=$slug.'_'.++$idmax;
            }
        }
        $this->attributes['slug']=$slug;
    }

    public function getPhotosAttribute($value)
    {
        return array_pluck($this->attaches()->get()->toArray(), 'filename');
    }

    public function setPhotosAttribute($images)
    {
        $imgtitles = Request::get('imgtitle');
        $imgalts = Request::get('imgalt');
        $imgdescs = Request::get('imgdesc');
        $this->save();
        $i=0;
        foreach($images as $image)
        {
            $this->updateOrNewAttach($image, $imgtitles[$i], $imgalts[$i], $imgdescs[$i]);
            $i++;
        }
        $path = config('admin.imagesUploadDirectory').'/'.Sentinel::check()->id;
        $files = glob(public_path($path)."/*");
        if (count($files) > 0) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
        $this->keepOnly($images);
    }


    public function setCategoriesAttribute($categories)
    {
        // перепрописываем отношения с таблицей категорий
        $this->categories()->detach();
        if ( ! $categories) return;
        if ( ! $this->exists) $this->save();
        $this->categories()->attach($categories);
    }

    public function getCategoriesAttribute($categories)
    {
        return array_pluck($this->categories()->get()->toArray(), 'id');
    }


}
