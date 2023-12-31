<?php

namespace App\Models;


class FormatCurrency
{
    
    public static function value($value)
    {
        $sum = number_format($value, 2, '.', ' ');
        $sum = explode('.', $sum);
        return $sum[0].'<small class="text-muted">.'.$sum[1].'</small>'.' ₽';
    }

    public static function rub($value)
    {
        $value = explode('.', number_format($value, 2, '.', ''));
    
        $f = new \NumberFormatter('ru', \NumberFormatter::SPELLOUT);
        $str = $f->format($value[0]);
    
        // Первую букву в верхний регистр.
        $str = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));
    
        // Склонение слова "рубль".
        $num = $value[0] % 100;
        if ($num > 19) { 
            $num = $num % 10; 
        }	
        switch ($num) {
            case 1: $rub = 'рубль'; break;
            case 2: 
            case 3: 
            case 4: $rub = 'рубля'; break;
            default: $rub = 'рублей';
        }	
        
        return '<b>'.$str . ' ' . $rub . '</b>, ' . $value[1] . ' копеек.';
    }    

    public static function res($num)
    {
        $f = new \NumberFormatter('ru', \NumberFormatter::SPELLOUT);
        $str = $f->format($num);
        return $str;
    }

    public static function summa($sum)
    {
        $sum = number_format(($sum) / 100, 2, '.', ' '); 
        $sum = explode('.', $sum);
        return $sum[0].'<small class="text-muted">.'.$sum[1].'</small>'.' ₽';
    }

    public static function rubl($sum, $preffix = ' ₽')
    {
        $sum = number_format(($sum) / 100, 2, '.', ' '); 
        return $sum.$preffix;
    }

    public static function _rub($num)
    {
    	$null = 'ноль';
    	$ten = array(
    		array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
    		array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять')
    	);
    	$a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    	$tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    	$hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    	$unit = array(
    		array('копейка' , 'копейки',   'копеек',     1),
    		array('рубль',    'рубля',     'рублей',     0),
    		array('тысяча',   'тысячи',    'тысяч',      1),
    		array('миллион',  'миллиона',  'миллионов',  0),
    		array('миллиард', 'миллиарда', 'миллиардов', 0),
    	);
     
    	list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    	//$out = '<b>';
    	$out = array();
    	if (intval($rub) > 0) {
    		foreach (str_split($rub, 3) as $uk => $v) {
    			if (!intval($v)) continue;
    			$uk = sizeof($unit) - $uk - 1;
    			$gender = $unit[$uk][3];
    			list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
    			// mega-logic
    			$out[] = $hundred[$i1]; // 1xx-9xx
    			if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
    			else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
    			// units without rub & kop
    			if ($uk > 1) $out[] = self::morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
    		}
    	} else {
    		$out[] = $null;
    	}
    	$out[] = self::morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    	$out[] = '</b>, '.$kop . ' ' . self::morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    	return '<b>'.trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }
 
    /**
     * Склоняем словоформу
     * @author runcore
     */
    public static function morph($n, $f1, $f2, $f5) 
    {
    	$n = abs(intval($n)) % 100;
    	if ($n > 10 && $n < 20) return $f5;
    	$n = $n % 10;
    	if ($n > 1 && $n < 5) return $f2;
    	if ($n == 1) return $f1;
    	return $f5;
    }
}
