<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Steames;
use App\Models\Customer;
use App\Models\MoySklad;
use App\Models\Catalog;
use Illuminate\Http\Request;
use App\Providers\ContactService;
use Symfony\Component\HttpFoundation\ServerBag;


class MainController extends Controller
{

    public function Test()
    {
        $modal = MoySklad::getAllGoods(); //  getListURL
        $data = [];
        foreach($modal as $item) {
            $data[] = [
                'link' => $item['link'], 
                'image' => $item['image'], 
                'article' => $item['article'],
                'name' => $item['name'], 
                'description' => $item['description'], 
                'price' => $item['price'], 
                'quantity' => $item['quantity']
            ];
        }
        Goods::upsert($data, ['article'], ['quantity']); // insert // updateOrCreate // create
        return view('test', ['modal' => $data]);
        // return redirect()->route('search')->with(['search' => $search, 'text' => $text]);
    }

    
    public function Promotion()
    {
        return view('promotion');
    }


    public function PromoCatalog($id, $limit = 10, $offset = 0)
    {
        $model = Catalog::where('stock', $id)->first();
        $product = MoySklad::getProductFromStock($id, $limit, $offset);
        // return response()->json($product);
        return view('dashboard.promo.catalog', 
            [
                'stock' => $id, 
                'model' => $model, 
                'product' => $product, 
                'limit' => $limit, 
                'offset' => $offset
            ]
        );
    }



    public function PromoView($uuid)
    {
        $model = Catalog::where('brand', $uuid)->first();
        //Catalog::where('brand', $uuid)->toArray()->get();
        //return response()->json($model);
        return view('dashboard.promo', compact('uuid', 'model'));
    }


    public function NoProduct()
    {
        return redirect()->route('search');
    }


    public function About()
    {
        return view('about');
    }
    
    /*public function Production()
    {
        return view('production');
    }*/


    public function Сontact()
    {
        return view('contact');
    }


    public function Customers()
    {
        return view('customers');
    }


    public function Documentation()
    {
        return view('doc');
    }


    public function License()
    {
        return view('doc.license');
    }


    public function ReturnPolicy()
    {
        return view('doc.return-policy');
    }


    public function Guaranty()
    {
        return view('doc.guaranty');
    }


    public function Responsibility()
    {
        return view('doc.responsibility');
    }


    public function Private()
    {
        return view('doc.privatepolice');
    }

    public function DetailProduct($id)
    {
        $product = MoySklad::getOneProduct($id);
        $data = Goods::where('link', $id)->get();
        //return response()->json($product);
        if($product['name'] === 'Товар не найден') {
            return view('errors.404');
        }
        return view('product', compact('id', 'product', 'data'));
    }


    public function stockFolder($id, $limit = 64, $offset = 0)
    {
        $product = MoySklad::getProductFromStock($id, $limit, $offset);
        //return response()->json($product);
        //$product = MoySklad::getProductFromStockGms($id, $limit, $offset);
        return view('stock', compact('product', 'limit', 'offset', 'id'));
    }


    public function Catalog($limit = 64, $offset = 0)
    {
        $product = MoySklad::getAllProduct($limit, $offset);
        // $pro = [];
        // foreach($product['rows'] as $item) {
        //     $pro[] = $item['article']; //  ?? '/img/placeholder.png'
        // }
        // $arr_images = Goods::whereIn('article', $pro)->select('article', 'image')->get()->toArray();
        //return response()->json($res);, 'arr_images' => $arr_images
        return view('catalog', ['product' => $product, 'limit' => $limit, 'offset' => $offset]);
    }


    public function FilesDelete(Request $request)
    {
        $uuid = $request->input('uuid');
        $filename = $request->input('name');

        $path = './img/goods/';
        unlink($path.$filename.'.jpg');
        Goods::updateOrCreate(['link' => $uuid], ['image' => '']);
        return [
            'header' => 'Успешно',
            'text' => 'Фото удалено'
        ];
    }


    public function Files(Request $request)
    {
        $request->validate([
            'uuid' => 'required',
            'file' => 'required',
            'name' => 'required'
        ]);
        $filename = $request->input('name');
        $name = $_FILES['file']['name'];
        $error = $_FILES['file']['error'];
        $ext = explode('.', $name);
        $uuid = $request->input('uuid');
        
        $uploaddir = './img/goods/';
        $uploadfile = $uploaddir . $filename .'.'. $ext[1];
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            Goods::updateOrCreate(['link' => $uuid], ['image' => $uploadfile]);
            return [
                'header' => 'Успешно',
                'text' => 'Фото товара загружено',
                'type' => 'success'
            ];
        } else {
            return [
                'header' => 'Ошибка!',
                'text' => $error,
                'type' => 'error'
            ];
        }
    }

    public function Product(Request $request)
    {
        if($request->isMethod('post')) {
            $request->validate([
                'type' => 'nullable',
                'text' => 'required',
            ]);
            $error = 'Слишком короткий запрос, укажите более точные данные';
            $url = Steames::getListResult($request->text);
            $search = MoySklad::searchOfResult($url);
            file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($search, true));
            //dd($search);
            $text = $request->input('text');            
            if(strlen($request->text) > 3) {
                return redirect()->route('search')->with(['search' => $search, 'text' => $text]);                
            }
            return redirect()->route('search')->with(['error' => $error]);
        }
    }

    public function Partner()
    {
        return view('partner');
    }

    public function Shipper()
    {
        return view('shipper');
    }

    public function Developers()
    {
        return view('developers');
    }

    public function Card()
    {
        $uuid = auth()->user();
        if($uuid) {
            $data = Customer::where('customer.uuid', $uuid->verified)
                ->join('contract', 'customer.uuid', '=', 'contract.uuid')
                ->get();
            //return response()->json($data);
            return view('card', ['data' => $data]);
        }
        return view('card');
    }

}
