<?php

$misal = '(5*22)*(3*2-1)';
echo task3($misal);


function task2 ($e){

   $numbers = [];
   $signs = [];
   $start = 0;
   $silinecekler = [];

   $reindex  = 0;

   for ($a = 1; $a < strlen($e); $a++) {
      $cur = $e[$a];
         switch ($cur ) {
            case '+' :
               $signs[] = array("+", $a);
               break;
            case '-' :
               $signs[] = array("-", $a);
               break;
            case '*' :
               $signs[] = array("*", $a);
               break;   
            case '/' :
               $signs[] = array("/", $a);
               break;  
           
      }
   }
   
   foreach ($signs as $row ){
        
         $length = $row[1] - $start ;
         $numbers [ ]  =  substr($e,$start, $length);
         $start = $row[1]+1;
    }
   
    $numbers[] =  substr( $e, end($signs)[1] +1  );
   
   for  ( $i=0 ; $i<count($signs) ; $i++){
      if ($signs[$i][0] == '*' ){

         $netice = $numbers[$i-$reindex] * $numbers[$i+1-$reindex];
         $i++;
         $length = 2;
         while ( @$signs[$i][0] == '*'  or @$signs[$i][0] =='/' ){
            @$signs[$i][0] == '*' ? $netice  *= $numbers[$i+1-$reindex]    :   ($numbers[$i+1-$reindex] == 0 ? die('XETA') : $netice =  $netice / $numbers[$i+1]  );
            $i++;
            $length++;
         }
      
      array_splice($numbers, $i-$length+1 - $reindex,$length,$netice  );
      $reindex = $reindex + $length - 1;   
        
      }

   if ($signs[$i][0] == '/' ){
      $numbers[$i+1-$reindex] == 0 ? die('XETA')  :  $netice = $numbers[$i-$reindex] / $numbers[$i+1-$reindex]; ;
      $i++;
      $length = 2;
     
      while ( @$signs[$i][0] == '*'  or @$signs[$i][0] =='/' ){
         
         @$signs[$i][0] == '*' ? $netice  *= $numbers[$i+1]    :  ($numbers[$i+1] == 0 ? die('XETA') : $netice =  $netice / $numbers[$i+1]  );
         $i++;
         $length++;
      }
      array_splice($numbers, $i-$length+1 - $reindex,$length,$netice  );
      $reindex = $reindex + $length - 1;
   
      }
   }

   for($i=0 ; $i< count($signs) ; $i++){
      if ($signs[$i][0] == "*" or $signs[$i][0] == "/"){
         unset($signs[$i]);
      }
   }
   $signs = array_values($signs);
   
   $calculate = $numbers[0];
    $j = 0;
   // print_r($numbers);
   // print_r($signs);

   for ( $i = 1 ; $i< count($numbers) ;$i++  ) {
      switch($signs[$j][0]) {
         case '+' :
            $calculate +=  $numbers[$i];
            break;
         case '-' :
            $calculate -=  $numbers[$i];
            break;
         }
      $j++;
   }
   
   return  $calculate;
}

function task3($e){
   $reindex=0;
   $test = $e;
   echo  "Misal : $test .<Br> ";
   for($i=0 ; $i<strlen($e) ; $i++  ){
      if ($e[$i] == '(' ){
         $solmoterize = $i;
         while ($e[$i] != ')' ){
            $i++;
         }
         $sagmoterize = $i;
         $moterizeninici = substr($e,$solmoterize+1,$sagmoterize-$solmoterize-1);
         $moterizenincavabi = @task2 ($moterizeninici);
         $test = substr_replace($test,$moterizenincavabi,$solmoterize-$reindex,$sagmoterize-$solmoterize+1);
         $reindex = $reindex + strlen($moterizeninici) +2 - strlen((string) $moterizenincavabi);
         print_r($test . "<br>");
      }
   }
   $son =   task2($test);
   echo "<br> $e = $son ";
}   






   ?>