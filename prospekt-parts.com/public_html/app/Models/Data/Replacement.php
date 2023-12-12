<?php
namespace App\Models\Data;

use App\Models\MoySklad;
use App\Models\Replacement as Parts;


class Replacement
{

//я ошибаюсь и проверяю наличие артикула , мне нужно проверять наличие артикула в MoySklad, это функции getStock. getProductFromStock или другие надо потестить через ::getProductFromStock($text);
    public static function checkArticleExists($text)
    {
        return Parts::where('part', $text)->exists();
    }

    public static function getResultReplacement($text)
    {
        return Parts::where('part', 'like', '%' . $text)->get();
    }
    
    public static function getReplacementPart($text)
    {
        if ($text) {
            $Assortment = MoySklad::searchAssortmentByArticle($text);
            
            if ($Assortment) {
                return $Assortment;
            }
        }
        
        return '';
    }
    /*public static function getReplacementPart($text)
    {
        /*if($text) {
            $Assortment = MoySklad::searchAssortmentByArticle($text);
            //var_dump($Assortment);
            if($Assortment){
                return $Assortment;
            }
            //return MoySklad::getProductFromStock($text);
        }
        return ''; 
        if($text){
            return MoySklad::searchAssortmentByArticle($text);
            //return response()->json($product);
        }
        return '';
        }*/
}