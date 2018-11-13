<?php
/**
 * @author pavel.vachaaa@gmail.com
 * @author Pavel Vácha
 * @version 1.0 
 * 
 *
 **/

 //Class which makes using WebCrawler easier..
class WebCrawler {

    public $str;



//Method which adds everything u want after a string in array..
public function addAfter($where = array(), $what) {
    foreach($where as $x) {
        $returnArray[] = $x . $what;
    }

    return $returnArray;
}

//Method which adds for example parametres or can be used for pagination
public function addBefore($where = array(), $what) {
    foreach($where as $x) {
        $returnArray[] =  $what . $x;
    }
    return $returnArray;
} 

//Method which finds links on page
public function findLinks($where, $selector = null) {

    //Creating instance of simple html dom library
    $html = new simple_html_dom();
    $html->load_file(trim($where));
    
    if($selector == null) 
    $links = $html->find("a");
    else 
    $links  = $html->find($selector);

    foreach($links as $link) {
        $returnArray[] = $link->href;
    }

    //Memory leaks
    $html->clear();
    unset($html);
    return $returnArray;
}

//Method which returns interval of array
public function returnInterval($from,$to,$what = array()) {
	$size = count($what);	
	if($from<$to) {		
		for($i = 0; $i<=$from;$i++)
		unset($what[$i]);
        
        for($i = $to+1; $i<=$size;$i++)
		unset($what[$i]);
		} else {
		echo "<h1>Value from has to be higher than to!</h1>";
		die;
		}
		return $what;
    }

//Removing diacritic of issues in db column names
public function removeDiacritic($nameOfFile) {
       
        //Opening the file and unique the array
       $lines = file($nameOfFile);
       $lines = array_unique($lines);
       $lines = array_values($lines);
   
        //Removing the unexcepted chars
       foreach($lines as $n)
       $firstChange[] = html_entity_decode(trim($n));
   
       $tableOfChars = Array( 'ä'=>'a', 'Ä'=>'A', 'á'=>'a', 'Á'=>'A', 'à'=>'a', 'À'=>'A', 'ã'=>'a', 'Ã'=>'A', 'â'=>'a', 'Â'=>'A', 'č'=>'c', 'Č'=>'C', 'ć'=>'c', 'Ć'=>'C', 'ď'=>'d', 'Ď'=>'D', 'ě'=>'e', 'Ě'=>'E', 'é'=>'e', 'É'=>'E', 'ë'=>'e', 'Ë'=>'E', 'è'=>'e', 'È'=>'E', 'ê'=>'e', 'Ê'=>'E', 'í'=>'i', 'Í'=>'I', 'ï'=>'i', 'Ï'=>'I', 'ì'=>'i', 'Ì'=>'I', 'î'=>'i', 'Î'=>'I', 'ľ'=>'l', 'Ľ'=>'L', 'ĺ'=>'l', 'Ĺ'=>'L', 'ń'=>'n', 'Ń'=>'N', 'ň'=>'n', 'Ň'=>'N', 'ñ'=>'n', 'Ñ'=>'N', 'ó'=>'o', 'Ó'=>'O', 'ö'=>'o', 'Ö'=>'O', 'ô'=>'o', 'Ô'=>'O', 'ò'=>'o', 'Ò'=>'O', 'õ'=>'o', 'Õ'=>'O', 'ő'=>'o', 'Ő'=>'O', 'ř'=>'r', 'Ř'=>'R', 'ŕ'=>'r', 'Ŕ'=>'R', 'š'=>'s', 'Š'=>'S', 'ś'=>'s', 'Ś'=>'S', 'ť'=>'t', 'Ť'=>'T', 'ú'=>'u', 'Ú'=>'U', 'ů'=>'u', 'Ů'=>'U', 'ü'=>'u', 'Ü'=>'U', 'ù'=>'u', 'Ù'=>'U', 'ũ'=>'u', 'Ũ'=>'U', 'û'=>'u', 'Û'=>'U', 'ý'=>'y', 'Ý'=>'Y', 'ž'=>'z', 'Ž'=>'Z', 'ź'=>'z', 'Ź'=>'Z' );
   
       //Removing the diacritic
       foreach($firstChange as $n)
       $secondChange[] = strtr($n, $tableOfChars);
   
       return $secondChange;
}

//Finding content by selector u choose
public function findParameteres($where = array(), $selector) {
        foreach($where as $link) {
            
            $html = new simple_html_dom();
            $html->load_file(trim($link));

            $parametr = $html->find($selector);
            foreach($parametr as $par) {
                $item[] = $par->html_entity_decode(trim($par));
            }
            $html->clear();
            unset($html);
        
        }
        return $item;
}



    }
?>