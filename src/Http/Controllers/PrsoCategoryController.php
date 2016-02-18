<?php
namespace Angrydeer\Productso\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Dmitriy Pivovarov aka AngryDeer http://studioweb.pro
 * Date: 28.01.16
 * Time: 21:35
 */


use App\Http\Controllers\Controller;
use Angrydeer\Productso\Models\PrsoCategory as Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Debugbar;

class PrsoCategoryController extends Controller
{

    public function show(Request $request, $slug='root')
    {

        // Если запрос пришел не на конкретную категорию, а на раздел категорий, отдаем коллекцию категорий верхнего уровня
        if ($slug == 'root')
        {
            $nodes= Category::whereIsRoot()->get();
            $many = true;
            return view('Productso::category_show', compact('nodes','many'));

        }
        // Иначе отдаем запрашиваемую категорию c товарами
        if ( $node = Category::where('slug',$slug)->first()) {
            $products=Category::find($node->id)->products()->paginate(Category::$productPerPage);
            $many = false;
            if (isset($request->ajax))
            {
                foreach($products as $product)
                {
                    if ($product->imagesrc=$product->attaches->count() > 0)
                            $product->imagesrc=$product->attaches->first()->filename;
                        $product->nodeid = $node->id;
                }
                $link_limit = 15;

                $half_total_links = floor($link_limit / 2);
                $from = $products->currentPage() - $half_total_links;
                $to = $products->currentPage() + $half_total_links;
                if ($products->currentPage() < $half_total_links) {
                    $to += $half_total_links - $products->currentPage();
                }
                if ($products->lastPage() - $products->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($products->lastPage() - $products->currentPage()) - 1;
                }

                $addparams = (object) array(
                    'link_limit' =>$link_limit,
                    'halfTotalLinks' => $half_total_links,
                    'route' => $request->path(),
                    'to' => $to,
                    'from' => $from,
                    'slug' => $slug
                );

                return response()->json([ 'products' => $products, 'addparams' => $addparams] );
            }
            else Debugbar::info('No Ajax');
            return view('Productso::category_show', compact('node','many','products'));
        }
        // ну или посылаем на 404 если нет такой
        abort(404);
    }
}
