 <?php
    include("incdb.php");
    if (!$db) {
        die("Connection failed: " . mysql_connect_error());
    } else {
        echo "Connected successfully";
    }

    require_once 'phpQuery.php';

    function print_arr($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

    //Первый сайт
    /*
                    $domm = phpQuery::newDocument(file_get_contents('https://moscowplaces.ru/razvlechenie/kotokafe.html'));
                    $post=$domm->find(".entry-content");
                    foreach($post as $el){
                        $el = pq($el);
                        $tile = $el->find("h2")->text();
                        $image = $el->find("p a")->attr('src');
                        $opis = $el->find(".junkie-alert green strong")->html(); 
                        
                        echo $tile;
                        echo "<img src='$image' width='90' height='105'>";
                        echo '<br>'; 
                        print_arr($opis);
                        echo '<hr>';
                        
                    }
                    */


    //Второй сайт                
    /*
                     $url='https://korzinka.riamo.ru';
                     $sait = phpQuery::newDocument(file_get_contents('https://korzinka.riamo.ru/article/poest-i-pogladit-kota-10-adresov-kafe-s-zhivotnymi-1455'));
                     foreach($sait->find(".page--content .text-container") as $elem){
                        $elem = pq($elem);
                        $tit = $elem->find(".richtext h4")->text();
                        $image = $elem->find(".mt mb .free-photo img-responsive img")->attr('src');
                        $opis = $elem->find(".richtext p:eq(4) ")->html(); 
                        $opis = $elem->find(".richtext p:eq(5) ")->html();  
                        $opis = $elem->find(".richtext p:eq(6) ")->html();  
                        print_arr($tit);
                        print_arr($image);
                        //echo "<img src='$url.$image' width='90' height='105'>";
                        echo '<hr>';
                        print_arr($opis);
                        
                     }*/


    //Третий сайт                 
    $url = 'https://kudago.com';
    $dom = phpQuery::newDocument(file_get_contents('https://kudago.com/msk/list/kafe-i-restorany-gde-obitayut-zhivotnye/'));
    foreach ($dom->find(".post-list-big .post-list-item") as $item) {
        $pq = pq($item);
        $name = $pq->find(".post-list-item-description h4 a")->attr('title');
        $linkk = $pq->find(".post-list-item-title a")->attr('href');
        $imgg = $pq->find(".post-list-item .post-list-item-preview-image")->attr('src');
        //print_arr($img);
        /*$img = $pq->find(".post-list-item .post-list-item-preview-image ")->attr('src');
                        //var_dump($img);
                       // echo $url.$img.'<br>';
                        foreach($img as $value){
                            $value->setAttribute('src','https://kudago.com'.$value->getAttribute('src'));
                        }*/
        //echo $img;
        //$path = 'img/time-cafes/$i.jpg';
        //file_put_contents($path, file_get_contents($img));
        $opisanie = $pq->find(".post-list-item-description p")->text();
        $address = $pq->find(".post-list-item-info")->text();
        //$adress = $pq->find(".font-icon icon-location")->remove();
        if ($linkk != '') {
            $link = $url . $linkk;
        } else {
            $link = '';
        }
        //$img=$url.$imgg;
        //echo $link.'<br>';
        echo $imgg . '<br>';
        /*
                        $zapros = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('$name', '$link', '$img', '$opisanie', '$address', '89991234567', '10:00 - 20:00')");
                        if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
                    */
        // mysql_close($db);

        //print_arr($name);
        /*if ($linkk!=''){
                            $linkes=$url.$linkk;
                            echo $linkes;}
                        echo '<br>';
                        print_arr($url.$img);*/
        //echo "<img src='$url.$img' width='90' height='105'>";
        //var_dump($img);
        //echo "<img src='$url.{$img}'>";
        //echo '<br>'; 
        // echo $opisanie.'<br>'; 
        //echo $address;
        //echo '<hr>';
        //echo '<br>';
    }
    //echo $post;
    phpQuery::unloadDocuments();
    ?>




require_once 'phpQuery.php';
                    
                    function print_arr($arr){
                    	echo '<pre>' . print_r($arr, true) . '</pre>';
                    }
                    
                    
                    $domm = phpQuery::newDocument(file_get_contents('https://moscowplaces.ru/razvlechenie/kotokafe.html'));

                    foreach ($post=$domm->find(".entry-content h2") as $el) {
                        $el = pq($el);
                        $title= $el->text();
                        echo $title.'<br>';
                    }
                    
                    //Не получается никак вести инфу о заведениях
                    foreach ($p=$domm->find(".junkie-alert green") as $el) {
                        $el = pq($el);
                        $el->html();
                        $adres = $el->find("strong.eq(0)")->text();//attr('strong:contains("Адрес")');
                        $phone = $el->attr('strong:contains("Телефон")');
                        $price = $el->attr('strong:contains("Стоимость")');
                        $time = $el->find('strong:contains("Режим работы")')->text();
                        $link = $el->find("a")->attr('href');
                          
                        echo $link.'<br>';
                        echo $adres.'<br>';
                        echo $phone.'<br>';
                        echo $price.'<br>';
                        echo $time.'<br>';
                    }
                    
                    
                    foreach ($post=$domm->find(".entry-content p") as $el) {
                        $el = pq($el);
                        $image = $el->find("img")->attr('src'); //alignnone size-full wp-image-10228 hide-img show-img
                        echo $image.'<br>';
                        //echo "<img src='$image' width='90' height='105'>";
                    }

                    
                    
                    /*
                    foreach($post=$domm->find(".entry-content") as $el){
                        $el = pq($el);
                        $title= $el->find("h2")->text();
                        $image = $el->find("alignnone size-full wp-image-10228 hide-img show-img ")->attr('src');
                        $link = $el->find(".junkie-alert green a")->attr('href');
                        $opis = $el->find(".junkie-alert green strong")->html(); 
                        $adres = $el->find(".junkie-alert green strong")->attr('strong:contains("Адрес")');
                        $phone = $el->find(".junkie-alert green")->attr('strong:contains("Телефон")');
                        $price = $el->find(".junkie-alert green ")->attr('strong:contains("Стоимость")');
                        $time = $el->find(".junkie-alert green")->attr('strong:contains("Режим работы")');
                        
                        echo $title.'<br>';
                        echo $image.'<br>'; 
                        echo $link.'<br>';
                        echo $opis.'<br>';
                        echo $adres.'<br>';
                        echo $phone.'<br>';
                        echo $price.'<br>';
                        echo $time.'<br>';
                        echo '<hr>';
                        
                    }
                    */




                    require_once 'phpQuery.php';
                    
                    function print_arr($arr){
                    	echo '<pre>' . print_r($arr, true) . '</pre>';
                    }
                    
                    
                     $url='https://korzinka.riamo.ru';
                     $sait = phpQuery::newDocument(file_get_contents('https://korzinka.riamo.ru/article/poest-i-pogladit-kota-10-adresov-kafe-s-zhivotnymi-1455'));
                     
                     foreach($sait->find(".text-container .richtext") as $elem){
                        $elem = pq($elem);
                        $title = $elem->find("h4")->text();
                        /*$time = $elem->find("p:eq(6) ")->html(); */ 
                        $link = $elem->find("p:contains('Сайт:') a")->attr('href');
                        $adres = $elem->find("p:contains('Где:')")->text(); 
                        $phone = $elem->find("p:contains('Телефон')")->text();
                        $time = $elem->find("p:contains('Часы работы:') ")->text();
                       /* if ($adres==''){
                            $adres = $elem->find("p:has(strong:contains('Кот','Мур'))")->text(); 
                        }   */

                        echo $title.'<br>';
                        echo $link.'<br>';
                        echo $adres.'<br>';
                        echo $phone.'<br>';
                        echo $time.'<br>';
                        echo '<hr>';

                    }
                    
                    //Не выводятся ссылки изображений
                    /*
                    foreach ($sait->find(".loaded ") as $el) {
                        $el = pq($el);
                       // $image = $elem->find(".free-photo img-responsive img")->attr('src');
                        //$image = $elem->find(".photo-box--in ar img")->attr('src');
                        $image = $elem->find("img")->attr('src');
                        
                         echo $image.'<br>';
                        //echo "<img src='$url.$image' width='90' height='105'>";

                    }
                    */











                    // print_r($time_cafe_name);

                    $time_cafe = array();
                    $i=0;
                     foreach($sait->find(".text-container .richtext:not(.is-first)") as $elem){
                        $elem = pq($elem);
                       // $title = $elem->find(".richtext h4")->text();
                        $opisanie= $elem->find("p")->contents()->eq(0)->text();
                        $link = $elem->find("p:contains('Сайт:') a")->attr('href');
                        $address = $elem->find("p:contains('Где:')")->text(); 
                        $phone = $elem->find("p:contains('Телефон')")->text();
                        $time = $elem->find("p:contains('Часы работы:') ")->text();
                        if (strlen($address)<10){
                            //$address = $elem->find("p:has(strong:contains('Кот','Мур'))")->slice( 5,8 )->text(); 
                            //$address = $elem->find("p:contains('Где:')")->slice( 1,3 )->text(); 
                           $address = 'Где: «Котики и люди», г. Москва, ул. Гиляровского, д. 17., 
                           «Муркино», г.о. Химки, ул. Горшина, д. 2., 
                           «Котя Мотя», Новая Москва, мкр-н Солнцево-парк, ул. Летчика Ульянина, д. 4, 
                           «Котогвартс» (кафе в стиле Гарри Поттера), Нахимовский пр-т, д. 1/1';
                        } 
                       // $img=$elem->find('img[src$=png]');
                        if ($phone==''){
                            $phone = strstr($address, ' т');
                           $address= str_replace($phone, " ", $address);
                        }

                       // echo $title.'<br>';
                        //echo $link.'<br>';
                        //echo $opisanie.'<br>';
                        //echo $address.'<br>';
                       // echo $phone.'<br>';
                        //echo $time.'<br>';
                        //echo $img.'<br>';
                       // echo '<hr>';
                       
                        //$title = implode("','", $time_cafe_name);
                      /*  $zapros = mysql_query("INSERT INTO time_cafes ( link, img, opisanie, address, telephone, time_open) WHERE name=' '  VALUES ( '$link', 'no ', '$opisanie', '$address', '$phone', '$time')");
                        $i++;
                        if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}*/
        				/*
        				
        				array_push($time_cafe, array(
                            'link' => $link,
                            'opisanie' => $opisanie,
                            'address' => $address,
                            'telephone' => $phone,
                            'time_open' => $time
                        ));
 */
                    }
                    /*
                    for($i=0;$i<7;$i++){
                        $time_cafe[$i]['name'] = $time_cafe_name[$i]['name'];
                        }
                    for($i=0;$i<7;$i++){   
                        $zapros = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('$time_cafe['name']', '$time_cafe['link']', '$time_cafe['img']', '$time_cafe['opisanie']', '$time_cafe['address']', '$time_cafe['phone']', '$time_cafe['time']')");
                    
                    
                        if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
                     */
                    
                     
                    /*$rezult = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('".implode("','", $time_cafe)."')");
                    
                    $rezult = mysql_query(sprintf("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('%s', '%s', '%s', '%s')", $time_cafe['name'], $time_cafe['link'], $time_cafe['img'], $time_cafe['opisanie'], $time_cafe['address'], $time_cafe['phone'], $time_cafe['time']));   */
                    /*
                    $rezult = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES  ('"; foreach ($name as $key=>$name_val){ $query .= '("'.name_val.'","'.$text[$key].'","'.$img[$key].'","'.$tegs[$key].'")';}");
                   
                    if($rezult==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
 */
?>
                <div class="statia">
                    <?php foreach($time_cafe as $cafe){ ?>
    					<a href="<?php echo $cafe['link']; ?>"><h2><?php echo $cafe['name']; ?></h2></a>
    					<p><?php echo $cafe['opisanie']; ?></p>
    					<br>
    					<span><?php echo $cafe['address']; ?></span>
    					<br>
    					<span><?php echo $cafe['telephone']; ?></span>
    					<br>
    					<span><?php echo $cafe['time_open']; ?></span>
    					<hr> 
					<?php } ?>
				</div>

               <?php     
                    
                    /*
                    function parser($url, $start, $end){
                        if($start < $end){
                            $doc = phpQuery::newDocument(file_get_contents($url));
                            foreach($doc->find('._1kXteagE ._1kNOY9zw') as $article){
                                $article = pq($article);
                                //if ($article->find('.DrjyGw-P _26S7gyB4 _1dimhEoy')) {continue;}

                                $nazvanie = $article->find('._2kbTRHSI')->text();   
                                $link = $article->find('.wQjYiB7z a')->attr('href'); // парсим ссылку на статью
                                //if ($article->find('._1j22fice:contains("Реклама")')) {$link=''; $nazvanie='';} 
                                //echo $nazvanie;
                                //echo '<br>';
                                
                                $urll = 'https://www.tripadvisor.ru';
                                if(!empty($link)) $data_link = file_get_contents($urll.$link);
                                $document_с = phpQuery::newDocument($data_link);
                                       
                                foreach ($document_с->find('.page ') as $element) {
                                    $pq2 = pq($element);
                                    $image = $pq2->find('.prw_rup prw_common_basic_image photo_widget large landscape img')->attr('src');
                                    //$image = $pq2->find('.large_photo_wrapper img')->attr('src');
                                    //$image = $pq2->find('.large_photo_wrapper .basicImg')->attr('src');   
                                    //$img = file_get_contents($image);
                                    //$nameimg=1;
                                    //file_put_contents(dog-friendly/'$nameimg.jpg', $img); 
                                    // $nameimg+=1;
                                    //$opisanie = $pq2->find('._1ud-0ITN ._13OzAOXO _34GKdBMV a')->text(); 
                                     $opisanie = $pq2->find('._3UjHBXYa ._1XLfiSsv')->text(); 
                                    //y5QNMrR5
                                     $address = $pq2->find('._15QfMZ2L ')->text();
                                    //$address = $pq2->find('._2vbD36Hr _36TL14Jn')->text();
                                    $phone = $pq2->find('._15QfMZ2L a')->text();
                                    //$menu = $pq2->find('._13OzAOXO _2VxaSjVD ly1Ix1xT a')->attr('href'); // парсим контент часть статьи
                                    //$info = $pq2->find('._3acGlZjD');
                                    //$info->find('.y5QNMrR5')->remove();
                                    //$data['text'] = pq($adres)->text();
 
                                    //echo $data['text'];
                                    echo $image;
                                    //echo "<img src='$image' width='90' height='105'>";
                                    echo $opisanie.'<br>';
                                    echo $address.'<br>';
                                    echo $phone;
                                    echo '<hr>';
                                  
                                }  
                                
                              
                				
                            }
                            
                            
                           
                           $variable= $doc->find('.pageNumbers .current')->next()->attr('href');
                           $variable = substr($variable, 0, strpos($variable, "#EATERY_LIST_CONTENTS"));
                           //echo $variable;
                           //echo '<br>';
                           $urll = 'https://www.tripadvisor.ru';
                           $next=$urll.$variable;
                           //echo $next;
                           
                            //$next = $doc->find('.pageNumbers .current')->next()->attr('href');
                            if( !empty($next) ){
                                $start++;
                                parser($next, $start, $end);
                            }
                            phpQuery::unloadDocuments();
                        }
                        
                    }
                       
                    //$url = 'https://www.tripadvisor.ru/Restaurants-g298484-Moscow_Central_Russia.html';
                    $url = 'https://www.tripadvisor.ru/RestaurantSearch?Action=FILTER&ajax=1&availSearchEnabled=false&sortOrder=relevance&geo=298484&zfp=20996';
                    $start = 0;
                    $end = 1;
                    parser($url, $start, $end);
                    */
                ?>





﻿<!DOCTYPE html>
<html lang="ru">
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=devise-width", install-scale=1.0>
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	  <script src="mymap.js"></script>
	  <title>cafes</title>
  </head>
  <body>
	<?php include "blocks/header.php";
	      include("incdb.php");  ?>
	<div class="main">
	    <div class="container">
			<div class="title">
				<h2>Time кафе</h2>
			</div>
			<div class="stats">

			    <?php
			        include("incdb.php");  
			        if (!$db) {
                        die("Connection failed: " . mysql_connect_error());
                    }
                    else {
                    echo "Connected successfully";
                        echo '<br>';
                    }
                     
                    
                    require_once 'phpQuery.php';
                    
                    function print_arr($arr){
                    	echo '<pre>' . print_r($arr, true) . '</pre>';
                    }

                    $url='https://korzinka.riamo.ru';
                    $sait = phpQuery::newDocument(file_get_contents('https://korzinka.riamo.ru/article/poest-i-pogladit-kota-10-adresov-kafe-s-zhivotnymi-1455'));
                   
                    $time_cafe_name = array();
                     foreach($sait->find(".text-container .richtext") as $elem){
                        $elem = pq($elem);
                        $name = $elem->find("h4")->text();
                        
                        array_push($time_cafe_name, array(
                            'name' => $name));
                     }

                    $time_cafe = array();
                    $i=0;
                     foreach($sait->find(".text-container .richtext:not(.is-first)") as $elem){
                        $elem = pq($elem);
                        //$title = $elem->find("h4")->text();
                        $opisanie= $elem->find("p")->contents()->eq(0)->text();
                       // $opisanie= $elem->find("p:contains('РИАМО ')")->remove();
                        
                        $link = $elem->find("p:contains('Сайт:') a")->attr('href');
                        $address = $elem->find("p:contains('Где:')")->text(); 
                        $telephone = $elem->find("p:contains('Телефон')")->text();
                        $time_open = $elem->find("p:contains('Часы работы:') ")->text();
                        if (strlen($address)<10){
                            //$address = $elem->find("p:has(strong:contains('Кот','Мур'))")->slice( 5,8 )->text(); 
                            //$address = $elem->find("p:contains('Где:')")->slice( 1,3 )->text(); 
                           $address = 'Где: «Котики и люди», г. Москва, ул. Гиляровского, д. 17., 
                           «Муркино», г.о. Химки, ул. Горшина, д. 2., 
                           «Котя Мотя», Новая Москва, мкр-н Солнцево-парк, ул. Летчика Ульянина, д. 4, 
                           «Котогвартс» (кафе в стиле Гарри Поттера), Нахимовский пр-т, д. 1/1';
                        } 
                        $img=$elem->find('img[src$=png]');
                        if ($img=='') {$img=$link;}
                        if ($telephone==''){
                            $telephone = strstr($address, ' т');
                           $address= str_replace($telephone, " ", $address);
                        }

                        //echo $title.'<br>';
                        //echo $link.'<br>';
                        //echo $opisanie.'<br>';
                        //echo $address.'<br>';
                        //echo $phone.'<br>';
                        //echo $time.'<br>';
                        //echo $img.'<br>';
                       // echo '<hr>';
                       
        				
        			
        				array_push($time_cafe, array(
                            'link' => $link,
                            'img' => $img,
                            'opisanie' => $opisanie,
                            'address' => $address,
                            'telephone' => $telephone,
                            'time_open' => $time_open
                        ));
 
                    }
                    
                    for($i=0;$i<7;$i++){
                        $time_cafe[$i]['name'] = $time_cafe_name[$i]['name'];
                    }
                    
                    
                    
                    $values = array();
                    foreach ($time_cafe as $key => $value) {
                        //$qvalue = mysql_real_escape_string('".implode("','", $value)."');
                        $value='(' . implode(',', $value) . ')'; //'".implode("','", $value)."';
                         $qvalue = '"'.mysql_real_escape_string($value).'"';
                        $values[] = "($name, $link, $img, $opisanie, $address, $telephone, $time_open)"; // quoted value, not the raw value
                    }
                    
                    $query_values = implode(',', $values);
                    
                    $query = "INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES $query_values";
                    $result = mysql_query($query);
                    if($result==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
                    //echo '<pre>'.print_r($time_cafe, true).'</pre>';
                   /* $stmt = $link->prepare('INSERT INTO table(name,subtotal,holdback,total) VALUES (?, ?, ?, ?)');
foreach ($array[0] as $key => $value) {
    $stmt->bind_param('ssss', $value,  $array[1][$key], $array[2][$key],  $array[3][$key]);
    $stmt->execute();
}
                    $servername = "localhost";
                    $username = "id13887071_kris";
                    $password = "7J/E8phropnlwi<a";
                    $db = "id13887071_site";

                    $conn = new mysqli($servername, $username, $password, $db);
                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }
                    echo "Connected successfully";
                    $stmt = $conn->stmt_init();
                    $stmt = $conn->prepare("INSERT INTO time_cafes (`name`, `link`, `img`, `opisanie`, `address`, `telephone`, `time_open`)  VALUES (?, ?, ?, ?, ?, ?, ?)");
                    foreach ($time_cafe as $v) {
                        $name = current($v);
                        $time_open = end($v);
                        $stmt->bind_param("sssssss", $name, $link, $img, $opisanie, $address, $telephone, $time_open);
                        $stmt->execute();
                    }
*/
                    /*$stmt = $conn->stmt_init();
                    $sql = 'INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open)  VALUES (?, ?, ?, ?, ?, ?, ?)';
                    if ( $stmt = $conn->prepare( $sql ) ) {
                        $stmt->bind_param( 'sssssss', $time_cafe['name'], $time_cafe['link'], $time_cafe['img'], $time_cafe['opisanie'], $time_cafe['address'], $time_cafe['telephone'], $time_cafe['time_open']);
                        $stmt->execute();
                    }
                   if ( $stmt->affected_rows == 7 ) {
                     $success = true;
                    } else {
                     echo "NOOO";
                    }
                    
                    
                    
                    

                    foreach ( $time_cafe as $desc) {

                        foreach ( $desc as $key => $value ) {
            
                            mysql_query("INSERT INTO time_cafes (`".$key."`) VALUES ('".$value."')") or die(mysql_error());
                            
                        }
                    }
                    */
                   /* 
                    foreach ($time_cafe as $cafe) {
                        $zapros=mysql_query("INSERT INTO 'time_cafes' (name, link, img, opisanie, address, telephone, time_open) 
                        VALUES ($cafe['name'],$cafe['link'],$cafe['img'],$cafe['opisanie'],$cafe['address'],$cafe['telephone'],$cafe['time_open'])");
                     }
                    
                   
                    foreach ($time_cafe as $cafe) {
                        $sql = "
                        INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) 
                        VALUES 
                        ('".$cafe['name']."','".$cafe['link']."','".$cafe['img']."','".$cafe['opisanie']."','".$cafe['address']."','".$cafe['phone']."','".$cafe['time']."')";
                        $zapros=mysql_query($sql);
                    }
                     */
                    //$rezult = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('".implode("','", $time_cafe)."')");
                    
                   // $query = 'INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES("'.implode('", "', $time_cafe).'")';
                    /* 
                    $values = array();
                    foreach($time_cafe as $key) {
                        $values[] = "('{$key['name']}', '{$key['link']}', '{$key['opisanie']}', '{$key['address']}', '{$key['telephone']}', '{$key['time_open']}')";
                    }
                    $query = "INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ".implode(',', $values);
                    $rezult = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES  ('"); 
                     foreach ($name as $key=>$name_val)
                        { $query .= '("'.name_val.'","'.$text[$key].'","'.$img[$key].'","'.$tegs[$key].'")';
                         
                     }");
                 
                    
                    $string = array();
                    foreach ($time_cafe as $prod) {
                      $value = array();
                      foreach ($prod as $item) {
                        $value[] = "'" . $item . "'";
                      }
                      $string[] = '(' . implode(',', $value) . ')';
                   //    echo $string . '<br />';
                    }
                    $sql = "INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open)  
                    VALUES " . implode(', ', $string);
                    
                    // Вот и конечный запрос.
                    // echo $sql . '<br />';
                    mysql_query($sql);
                    /*if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}*/
                   /* for($i=0;$i<7;$i++){   
                        $zapros = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('$time_cafe[$i]['name']', '$time_cafe[$i]['link']', '$time_cafe[$i]['img']', '$time_cafe[$i]['opisanie']', '$time_cafe[$i]['address']', '$time_cafe[$i]['phone']', '$time_cafe[$i]['time']')");
                    
                    
                        if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
                     
                    }*/
                     
                    /*$rezult = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('".implode("','", $time_cafe)."')");
                     
                    $rezult = sprintf("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", $time_cafe['name'], $time_cafe['link'], $time_cafe['img'], $time_cafe['opisanie'], $time_cafe['address'], $time_cafe['phone'], $time_cafe['time']); 
                    $rezult=mysql_query($rezult);*/
                    /*
                    $rezult = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES  ('"; foreach ($name as $key=>$name_val){ $query .= '("'.name_val.'","'.$text[$key].'","'.$img[$key].'","'.$tegs[$key].'")';}");
                    
                    if($rezult==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
*/
?>
                <div class="statia">
                    <?php foreach($time_cafe as $cafe){ ?>
    					<a href="<?php echo $cafe['link']; ?>"><h2><?php echo $cafe['name']; ?></h2></a>
    					<p><?php echo $cafe['opisanie']; ?></p>
    					<br>
    					<span><?php echo $cafe['address']; ?></span>
    					<br>
    					<span><?php echo $cafe['telephone']; ?></span>
    					<br>
    					<span><?php echo $cafe['time_open']; ?></span>
    					<br>
    					<span><?php echo $cafe['img']; ?></span>
    					<hr> 
					<?php } ?>
				</div>

               <?php     
                    
                    /*
                    function parser($url, $start, $end){
                        if($start < $end){
                            $doc = phpQuery::newDocument(file_get_contents($url));
                            foreach($doc->find('._1kXteagE ._1kNOY9zw') as $article){
                                $article = pq($article);
                                //if ($article->find('.DrjyGw-P _26S7gyB4 _1dimhEoy')) {continue;}

                                $nazvanie = $article->find('._2kbTRHSI')->text();   
                                $link = $article->find('.wQjYiB7z a')->attr('href'); // парсим ссылку на статью
                                //if ($article->find('._1j22fice:contains("Реклама")')) {$link=''; $nazvanie='';} 
                                //echo $nazvanie;
                                //echo '<br>';
                                
                                $urll = 'https://www.tripadvisor.ru';
                                if(!empty($link)) $data_link = file_get_contents($urll.$link);
                                $document_с = phpQuery::newDocument($data_link);
                                       
                                foreach ($document_с->find('.page ') as $element) {
                                    $pq2 = pq($element);
                                    $image = $pq2->find('.prw_rup prw_common_basic_image photo_widget large landscape img')->attr('src');
                                    //$image = $pq2->find('.large_photo_wrapper img')->attr('src');
                                    //$image = $pq2->find('.large_photo_wrapper .basicImg')->attr('src');   
                                    //$img = file_get_contents($image);
                                    //$nameimg=1;
                                    //file_put_contents(dog-friendly/'$nameimg.jpg', $img); 
                                    // $nameimg+=1;
                                    //$opisanie = $pq2->find('._1ud-0ITN ._13OzAOXO _34GKdBMV a')->text(); 
                                     $opisanie = $pq2->find('._3UjHBXYa ._1XLfiSsv')->text(); 
                                    //y5QNMrR5
                                     $address = $pq2->find('._15QfMZ2L ')->text();
                                    //$address = $pq2->find('._2vbD36Hr _36TL14Jn')->text();
                                    $phone = $pq2->find('._15QfMZ2L a')->text();
                                    //$menu = $pq2->find('._13OzAOXO _2VxaSjVD ly1Ix1xT a')->attr('href'); // парсим контент часть статьи
                                    //$info = $pq2->find('._3acGlZjD');
                                    //$info->find('.y5QNMrR5')->remove();
                                    //$data['text'] = pq($adres)->text();
 
                                    //echo $data['text'];
                                    echo $image;
                                    //echo "<img src='$image' width='90' height='105'>";
                                    echo $opisanie.'<br>';
                                    echo $address.'<br>';
                                    echo $phone;
                                    echo '<hr>';
                                  
                                }  
                                
                              
                				
                            }
                            
                            
                           
                           $variable= $doc->find('.pageNumbers .current')->next()->attr('href');
                           $variable = substr($variable, 0, strpos($variable, "#EATERY_LIST_CONTENTS"));
                           //echo $variable;
                           //echo '<br>';
                           $urll = 'https://www.tripadvisor.ru';
                           $next=$urll.$variable;
                           //echo $next;
                           
                            //$next = $doc->find('.pageNumbers .current')->next()->attr('href');
                            if( !empty($next) ){
                                $start++;
                                parser($next, $start, $end);
                            }
                            phpQuery::unloadDocuments();
                        }
                        
                    }
                       
                    //$url = 'https://www.tripadvisor.ru/Restaurants-g298484-Moscow_Central_Russia.html';
                    $url = 'https://www.tripadvisor.ru/RestaurantSearch?Action=FILTER&ajax=1&availSearchEnabled=false&sortOrder=relevance&geo=298484&zfp=20996';
                    $start = 0;
                    $end = 1;
                    parser($url, $start, $end);
                    */
                ?>
            </div>

    	</div>
	</div>
	<?php include "blocks/footer.php" ?>   
  </body>
</html>


