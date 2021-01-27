<?php

$O=array("载","正","涧","沟","穰","秭","垓","京","兆","亿","万","千","百","十");

$m='{"载":4096,"正":2048,"涧":1024,"沟":512,"穰":256,"秭":128,"垓":64,"京":32,"兆":16,"亿":8,"万":4,"千":3,"百":2,"十":1}';
$M=json_decode($m,true);
$n='{"一":1,"二":2,"三":3,"四":4,"五":5,"六":6,"七":7,"八":8,"九":9,"":0,"两":2,"零":0}';
$N=json_decode($n,true);
$s='{"廿":"二十","卅":"三十","卌":"四十","虚":"五十","圆":"六十","近":"七十","枯":"八十","无":"九十","萬":"万","仟":"千","佰":"百","拾":"十","壹":"一","贰":"二","叁":"三","肆":"四","伍":"五","陆":"六","柒":"七","捌":"八","玖":"九","yi":"一","er":"二","san":"三","si":"四","wu":"五","liu":"六","qi":"七","jiu":"九","ling":"零","0":"零","1":"一","2":"二","3":"三","4":"四","5":"五","6":"六","7":"七","8":"八","9":"九","shi":"十","bai":"百","qian":"千","wan":"万"}';
$S=json_decode($s,true);


function core($n){
	global $O,$M,$N,$S;
	
    $m=0;
    foreach($O as $i){
		$p=mb_split($i,$n);
		// var_dump($n,$p);
		// exit;
		if(count($p) == 1){
			// return true;
			continue;
		}
		// var_dump($p);
		$m=0;
		foreach($p as $j){
			$t=core($j);
			
			// var_dump($m, $t, $j);
			// exit;
			// echo "<br>===pow<br>";
			// var_dump(strpos($j, "零"));
			// if($m && $t<10 && mb_strpos($j, "零") ){
			if($m && $t<10 ){
				
				$t*= pow(10,($M[$i]-1));
			}
			// var_dump($m*10,$M[$i]+$t);
			// var_dump($m,$t,$M[$i],$i);
			$m=$m*pow(10,$M[$i])+$t;
			// var_dump($m,$j);
			// echo "<br>===<br>";
			if(!$m){
				$m=1;
			}
		}
		break;
		// return false;
		
    } 
    
	if($m){
		return $m;
	}
	
	$m=0;
	
	// $apa=mb_str_split($n);
	$apa = preg_split('//u', $n, -1, PREG_SPLIT_NO_EMPTY);
	// var_dump($n);
	foreach($apa as $i){
		if (array_key_exists($i,$N)){
			// var_dump("AA",$m,"BB");
			$m=$m*10+$N[$i];
			// var_dump("CC",$m,"DD");
		}
	}
	return $m;
          //
}



function dolen($n){
	global $S;
	foreach($S as $i => $k){
		$n=str_replace($i,$k,$n);
		// echo $n;
		// echo "<br>";
	}
	// echo "<br>";
	// var_dump($n);
	return core($n);
}

// $apa=dolen("七一亿两千三百零四万九千八百七");
// $apa=dolen("百度一下你就知道");
// $apa=dolen("四");
// $apa=dolen("十二");
// $apa=dolen("无陆");
// $apa=dolen("liu萬2");
$apa=dolen("第五千零七十九章 丹神塔名额");
// $apa=dolen("liu萬2");
var_dump($apa);