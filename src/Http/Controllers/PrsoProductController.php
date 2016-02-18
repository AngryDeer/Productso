<?php
namespace Angrydeer\Productso\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Dmitriy Pivovarov aka AngryDeer http://studioweb.pro
 * Date: 28.01.16
 * Time: 21:35
 */


use App\Http\Controllers\Controller;
use Angrydeer\Productso\Models\PrsoProduct as Product;
use Angrydeer\Productso\Models\PrsoCategory as Category;
use Illuminate\Http\Request;


class PrsoProductController extends Controller
{

    public function show(Request $request, $slug, $categoryid=null)
    {
        if (isset($request->ajax))
        {
//            Debugbar::info($request->ajax);
        }
//        else Debugbar::info('No Ajax');

//        dd($request->all());
        if ( $product = Product::where('slug',$slug)->first()) {
            $parentCategores=$product->categories;
            $pathCategory=Category::find($categoryid);
            return view('Productso::product_show', compact('product','parentCategores', 'pathCategory'));
        }
        abort(404);
    }
}
