<?php

namespace App\Http\Controllers;

use App\Models\Excel;
use App\Models\MoySklad;
use Illuminate\Http\Request;


class ApiController extends Controller
{

    public function getValue(Request $request)
    {
        $request->validate([
            'uuid' => 'required'
        ]);
        $uuid = $request->input('uuid');
    }

    public function downloadFiles(Request $request)
    {
        $request->validate(['file' => 'required']);
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $error = $_FILES['file']['error'];
        $ext = explode('.', $name);
        $uploaddir = './img/xml/';
        $uploadfile = $uploaddir . 'table.'.$ext[1];
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            $data = [
                'text' => 'Таблица с товарами загружена',
                'name' => $name,
                'extension' => $ext[1],
                'type' => $type,
                'size' => $size,
                'error' => $error
            ]; 
            return $data;
        } else {
            return ['text' => 'Ошибка!'];
        }
    }

    public function loadStock(Request $request)
    {
        $store = $request->input('store');
        $country = $request->input('country');
        $file = $request->input('file');
        $pack = $request->input('pack');
        $path = './img/xml/';
        $table = Excel::parse($path.$file);
        
        $array = [];
        foreach($table as $item) {
            if($item[1] !== 'Номенклатура' && $item[3] !== '') {
                $array[] = [
                    'name' => $item[1],
                    'description' => '',
                    'article' => $item[0],
                    'code' => $item[0],
                    'paymentItemType' => 'GOOD',
                    'discountProhibited' => false,
                    'isSerialTrackable' => false,
                    'trackingType' => 'NOT_TRACKED',
                    'archived' => false,
                    'vat' => isset($item[25]) ? $item[25] : 20,
                    'effectiveVat' => isset($item[25]) ? $item[25] : 20,
                    'volume' => $item[3],
                    'productFolder' => [
                        'meta' => [
                            'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/productfolder/'.$store,
                            'metadataHref' => 'https://online.moysklad.ru/api/remap/1.2/entity/productfolder/metadata',
                            'type' => 'productfolder',
                            'mediaType' => 'application/json',
                        ]
                    ],
                    'salePrices' => [
                        [
                            'value' => (int)$item[4]*100,
                            'currency' => [
                                'meta' => [
                                    'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/currency/218d5776-33fe-11ed-0a80-0285001db7ba',
                                    'metadataHref' => 'https://online.moysklad.ru/api/remap/1.2/entity/currency/metadata',
                                    'type' => 'currency',
                                    'mediaType' => 'application/json'                              
                                ]                           
                            ],
                            'priceType' => [
                                'meta' => [
                                    'href' => 'https://online.moysklad.ru/api/remap/1.2/context/companysettings/pricetype/218e299a-33fe-11ed-0a80-0285001db7bb',
                                    'type' => 'pricetype',
                                    'mediaType' => 'application/json'                                
                                ],
                                'id' => '218e299a-33fe-11ed-0a80-0285001db7bb',
                                'name' => 'Цена продажи',
                                'externalCode' => 'cbcf493b-55bc-11d9-848a-00112f43529a'                            
                            ]
                        ]
                    ],
                    'country' => [
                        'meta' => [
                            'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/country/'.$country,
                            'metadataHref' => 'https://online.moysklad.ru/api/remap/1.2/entity/country/metadata',
                            'type' => 'country',
                            'mediaType' => 'application/json'                        
                        ]                  
                    ],
                    'uom' => [
                        'meta' => [
                            'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/uom/19f1edc0-fc42-4001-94cb-c9ec9c62ec10',
                            'metadataHref' => 'https://online.moysklad.ru/api/remap/1.2/entity/uom/metadata',
                            'type' => 'uom',
                            'mediaType' => 'application/json'
                        ]                 
                    ],
                    'attributes' => [
                        [
                            'meta' => [
                                'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/product/metadata/attributes/f9d0dad4-9346-11ed-0a80-0ca10012e215',
                                'type' => 'attributemetadata',
                                'mediaType' => 'application/json'                          
                            ],
                            'id' => 'f9d0dad4-9346-11ed-0a80-0ca10012e215',
                            'name' => 'ГТД',
                            'type' => 'string',
                            'value' => '0000-0001'
                            //$item[29] === '' ? '0000-0001' : $item[29]                      
                        ]
                    ]
                ];                
            
                }    
            }
                
         /*   $download = (array)$array;
            $arr = array_chunk($download, ceil(count($download) / $pack));
    
            try {
                set_time_limit(3000);
                for ($i = 0; $i <= $pack; $i++) {
                    $result = MoySklad::createListGoods($arr[$i]);
                }
                
                dd($result);
                
            } catch (\Exception $e) {
                $answer = [
                    'type' => 'danger',
                    'header' => 'Ошибка: ',
                    'message' => $e->getMessage()
                ];
                return redirect()->route('stockable')->with(['answer' => $answer]);
            }
            return redirect()->route('stockable')->with(['result' => $result, 'answer' => $answer]);
        }*/
        
        //рабочий вариант добавляет 1 товар. если добавлю + 10 и больше то выдаёт ошибку уникальности кода
        //массивы уникальных кодов не работает
        $download = (array)$array;
        $uniqueCodes = []; // Массив для отслеживания уникальных кодов
        try {
            set_time_limit(3000);
            $chunkedDownloads = array_chunk($download,10);
            foreach ($chunkedDownloads as $chunk) {
                // Фильтруем товары, чтобы исключить дубликаты по коду
                $uniqueChunk = array_filter($chunk, function ($item) use (&$uniqueCodes) {
                    $code = $item['code'];
                    if (!in_array($code, $uniqueCodes)) {
                        $uniqueCodes[] = $code;
                        //var_dump($item);
                        return true;
                    }
                    return false;
                });
                $result = MoySklad::createListGoods($chunk);
                dd($result);
                //var_dump($uniqueCodes);
            }
        dd($chunkedDownloads);
        } catch (\Exception $e) {
            $answer = [
                'type' => 'danger',
                'header' => 'Ошибка: ',
                'message' => $e->getMessage()
            ];
            return redirect()->route('stockable')->with(['answer' => $answer]);
        }
                
        //старый примитивный способок загрузки по 1000 строк выдавало ошибку 3306 уникальности кода 
        /*$download = (array)$array;
        $chunkedDownloads = array_chunk($download, 1000);
        //пытаюсь создать уникальные коды  , но будет ли ошибка если будут совпадения по списку.
        //расшаршенный масив нарезаю по 1000 строк , в цикле по массиву выполняю загрузку
                try {
                foreach ($chunkedDownloads as $chunk) {
                    // Загрузка каждой части данных
                    $result = MoySklad::createListGoods($chunk);
                }
                dd($result);
        // Возвращение какой-то информации после успешной загрузки
        return ['text' => 'Данные успешно загружены в MoySklad'];
            } catch (\Exception $e) {
                $answer = [
                    'type' => 'danger',
                    'header' => 'Ошибка: ',
                    'message' => $e->getMessage()
                ];
                return redirect()->route('stockable')->with(['answer' => $answer]);
                }
                */
    }
}
