<!DOCTYPE html>
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
                        $opisanie= $elem->find("p")->contents()->eq(0)->text();
                        
                        $link = $elem->find("p:contains('Сайт:') a")->attr('href');
                        $address = $elem->find("p:contains('Где:')")->text(); 
                        $telephone = $elem->find("p:contains('Телефон')")->text();
                        $time_open = $elem->find("p:contains('Часы работы:') ")->text();
                        if (strlen($address)<10){
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
                    
                     //echo '<pre>'.print_r($time_cafe, true).'</pre>';
/*
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

                    $stmt = $conn->stmt_init();
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

                     
                     */

                     /*
                    $values = array();
                    foreach($time_cafe as $key) {
                        $values[] = "('".$key['name']."','".$key['link']."','".$key['img']."','".$key['opisanie']."','".$key['address']."','".$key['telephone']."','".$key['time_open']."')";
                    }
                    $query = "INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ".implode(',', $values);
                     $rezult = mysql_query($query);
                     if($rezult==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
                    

                 
                    
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
                    $zapros=mysql_query($sql);
                    if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
        				
 */       				
        				foreach ($time_cafe as $cafe) {
                        $sql = "
                        INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) 
                        VALUES 
                        ('".$cafe['name']."','".$cafe['link']."','".$cafe['img']."','".$cafe['opisanie']."','".$cafe['address']."','".$cafe['telephone']."','".$cafe['time_open']."')";
                        $zapros=mysql_query($sql);
                    }



                    $domm = phpQuery::newDocument(file_get_contents('https://moscowplaces.ru/razvlechenie/kotokafe.html'));
                    
                    $time_cafe_name = array();
                    foreach ($post=$domm->find(".entry-content h2") as $el) {
                        $el = pq($el);
                        $name= $el->text();
                        //echo $name.'<br>';
                        
                        array_push($time_cafe_name, array(
                            'name' => $name));
                    }
                    
                    $time_cafe_img = array();
                    foreach ($post=$domm->find(".entry-content p img") as $el) {
                        $el = pq($el);
                        $img = $el->attr('src'); //alignnone size-full wp-image-10228 hide-img show-img
                       // $about=$el->find("p:contains('кофе')")->text();
                       // echo $img.'<br>';
                        
                         array_push($time_cafe_img, array(
                            'img' => $img));
                            
                    }

					$time_cafe = array();
                    foreach ($p=$domm->find(".entry-content .junkie-alert:not(.yellow)") as $el) {
                        $el = pq($el);
                        $address=$el->contents()->filter('[nodeType=3]')->eq(0)->text();
                        $telephone=$el->contents()->filter('[nodeType=3]')->eq(2)->text();
                        $time_open=$el->contents()->filter('[nodeType=3]')->eq(4)->text();
                        $opisanie=$el->contents()->filter('[nodeType=3]')->eq(3)->text();
                        $link = $el->find("a")->text();//attr('href');
                         
                       // echo $link.'<br>';
                        /* echo $address.'<br>';
                        echo $telephone.'<br>';
                        echo $opisanie.'<br>';
                        echo $time_open.'<br>';
                        */
                        array_push($time_cafe, array(
                            'link' => $link,
                            'opisanie' => trim($opisanie,':'),
                            'address' => trim($address,':'),
                            'telephone' => trim($telephone,':'),
                            'time_open' => trim($time_open,':')
                        ));
                    }

        				 
                    for($i=0;$i<10;$i++){
                        $time_cafe[$i]['name'] = $time_cafe_name[$i]['name'];
                        $time_cafe[$i]['img'] = $time_cafe_img[$i]['img'];
                    }
                    
                    
                    
                    
                   //echo '<pre>'.print_r($time_cafe, true).'</pre>';

				
        				foreach ($time_cafe as $cafe) {
                        $sql = "
                        INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) 
                        VALUES 
                        ('".$cafe['name']."','".$cafe['link']."','".$cafe['img']."','".$cafe['opisanie']."','".$cafe['address']."','".$cafe['telephone']."','".$cafe['time_open']."')";
                        $zapros=mysql_query($sql);
                    }
        				

        			
                    $url = 'https://kudago.com';
                    $dom = phpQuery::newDocument(file_get_contents('https://kudago.com/msk/list/kafe-i-restorany-gde-obitayut-zhivotnye/'));
                    foreach ($dom->find(".post-list-big .post-list-item") as $item) {
                        $pq = pq($item);
                        $name = $pq->find(".post-list-item-title")->text();
                        //$name = $pq->find(".post-list-item-description h4 a")->attr('title');
                        $linkk = $pq->find(".post-list-item-title a")->attr('href');
                        $imgg = $pq->find(".post-list-item .post-list-item-preview-image")->attr('src');
                        $opisanie = $pq->find(".post-list-item-description p")->text();
                        $address = $pq->find(".post-list-item-info")->text();
                        if ($linkk != '') {
                            $link = $url . $linkk;} 
                        else {
                            $link = '';}
                        $address = trim($address,'');
                        if($imgg!='') {
                            $img=$url.$imgg;} 
                        else { $img=$url;}
                        $telephone='';
                        $time_open='';
                        
                        echo $name.'<br>';
                        echo $link.'<br>';
                        echo $img.'<br>';
                        echo $opisanie.'<br>';
                        echo $address.'<br>';
                        echo '<hr>';

        /*
                        $zapros = mysql_query("INSERT INTO time_cafes (name, link, img, opisanie, address, telephone, time_open) VALUES ('$name', '$link', '$img', '$opisanie', '$address', '89991234567', '10:00 - 20:00')");
                        $zapros = mysql_query("INSERT INTO time_cafes(name, link, img, opisanie, address, telephone, time_open) VALUES ('$name', '$link', '$img', '$opisanie', '$address', '$telephone', '$time_open')");
                        if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
                    */

    }

                    


?>
                

               <?php     
                    
                    
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
                                    $time_open = $pq2->find('.eQw2iQ14')->text();
                                    //$menu = $pq2->find('._13OzAOXO _2VxaSjVD ly1Ix1xT a')->attr('href'); // парсим контент часть статьи
                                    //$info = $pq2->find('._3acGlZjD');
                                    //$info->find('.y5QNMrR5')->remove();
                                    //$data['text'] = pq($adres)->text();
 
                                    //echo $data['text'];
                                    //echo $image;
                                    //echo "<img src='$image' width='90' height='105'>";
                                   // echo $opisanie.'<br>';
                                    //echo $address.'<br>';
                                    //echo $phone;
                                    //echo '<hr>';
                                  
                                } 
                                
                                $zapros = mysql_query("INSERT INTO df_cafes (nazvanie, link, image, opisanie, address, telephone, time_open) VALUES ('$nazvanie', '$link', '$image', '$opisanie', '$address', '$phone', '$time_open')");
                        
                        if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
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
                    
                ?>
            </div>

    	</div>
	</div>
	<?php include "blocks/footer.php" ?>   
  </body>
</html>




<?php

                include("incdb.php");

                require_once 'phpQuery.php';
                //$doc = phpQuery::newDocument(file_get_contents('https://www.tripadvisor.ru/Restaurants-g298484-Moscow_Central_Russia.html'));
                if (!$db) {
                    die("Connection failed: " . mysqli_connect_error());
                } else {
                    echo "Connected successfully";echo '<br>';echo '<br>';}
              
                    function print_arr($arr)
                    {
                        echo '<pre>' . print_r($arr, true) . '</pre>';
                    }
                    
                    function parser($url, $start, $end)
                    {
                        if ($start < $end) {
                            $doc = phpQuery::newDocument(file_get_contents($url));
                            foreach ($doc->find('._1kXteagE ._1kNOY9zw') as $article) {
                                $article = pq($article);
                                $name = $article->find('._2kbTRHSI')->text();
                                $llink = $article->find('.wQjYiB7z a')->attr('href'); // парсим ссылку на статью
                    
                                echo "Название - ".$name. '<br>';
                    
                                $urll = 'https://www.tripadvisor.ru';
                                if (!empty($llink)) $data_link = file_get_contents($urll . $llink);
                                $document_с = phpQuery::newDocument($data_link);
                    
                                foreach ($document_с->find('.page ') as $element) {
                                    $pq2 = pq($element);
                                         
                                    //$link= $pq2->find('a._2wKz--mA._15QfMZ2L')->attr('href');
                                    $image = $pq2->find('.prw_rup.prw_common_basic_image.photo_widget.large.landscape img')->attr('data-lazyurl');
                                    
                                    $address = $pq2->find('._2saB_OSe')->text();
                                    $new_data=explode('Россия', $address);
                                    $address= $new_data[0];
                                    
                                    //$time_open = $pq2->find('._1h0LGVD2')->text();
                                    $telephone = $pq2->find('._15QfMZ2L a')->text();
                                    //$category= $pq2->find('._1XLfiSsv')->text();
                                    $category= $pq2->find('._1XLfiSsv')->contents()->filter('[nodeType=3]')->eq(2)->text();
                                    $price = $pq2->find('._1XLfiSsv:contains("руб")')->text();
                    
                                    //echo $image. '<br>';
                                    $name=trim($name);
                                   // $link=trim($link);
                                    $image=strip_tags($image);
                                    //echo "<img src='$image' width='90' height='105'>";
                                    //echo "Ссылка - ".$link. '<br>';
                                    
                                    $address=trim($address);
                                    $time_open=trim($time_open);
                                    //echo '<br>';
                                    //echo $telephone;
                                    $telephone=trim($telephone);
                                    $category=trim($category);
                                    $price=trim($price);
                                    echo "Изображение - ".$image. '<br>';
                                    echo "Адрес - ".$address. '<br>';
                                    //echo "Часы работы - ".$time_open. '<br>';
                                    echo "Категория - ".$category. '<br>';
                                    echo "Цена - ".$price. '<br>';
                                    echo "Телефон - ".$telephone. '<br>';
                                    //echo '<hr>';
                                    
                                    
                                    $zapros = mysqli_query($db,"INSERT INTO df_cafes (name, address, image, price, category, telephone) 
                                    VALUES ('$name','$address', '$image', '$price', '$category',  '$telephone')");
                                    
                                    //mysqli_query($db,$zapros) or die("ERROR: ".mysqli_error($db));
                                    if(!$zapros){ // запрос завершился ошибкой
                                       echo 'Ошибка запроса: '.mysqli_error().'<br>';
                                       echo 'Код ошибки: '.mysqli_errno();
                                    }
                                                
                                }
                                
                                                   
                                          
                            }
                    
                    
                    
                           // $variable = $doc->find('.pageNumbers .current')->next()->attr('href');
                            //$variable = substr($variable, 0, strpos($variable, "#EATERY_LIST_CONTENTS"));
                            //echo $variable;
                            //echo '<br>';
                           // $urll = 'https://www.tripadvisor.ru';
                           // $next = $urll . $variable;
                           //$next='https://www.tripadvisor.ru/RestaurantSearch?Action=PAGE&ajax=1&availSearchEnabled=false&sortOrder=relevance&geo=298484&zfp=20996&o=a30';
                           $next='https://www.tripadvisor.ru/RestaurantSearch-g298484-oa60-zfp20996-Moscow_Central_Russia.html';
                           //RestaurantSearch-g298484-oa60-zfp20996-Moscow_Central_Russia.html#EATERY_LIST_CONTENTS
                            //echo $next;
                    
                            //$next = $doc->find('.pageNumbers .current')->next()->attr('href');
                            if (!empty($next)) {
                                $start++;
                                parser($next, $start, $end);
                            }
                            phpQuery::unloadDocuments();
                        }
                    }
                   
                //$url = 'https://www.tripadvisor.ru/Restaurants-g298484-Moscow_Central_Russia.html';
                $url = 'https://www.tripadvisor.ru/RestaurantSearch?Action=FILTER&ajax=1&availSearchEnabled=false&sortOrder=relevance&geo=298484&zfp=20996';
                     // /RestaurantSearch?Action=PAGE&ajax=1&availSearchEnabled=false&sortOrder=relevance&geo=298484&zfp=20996&o=a30
                $start = 0;
                $end = 1;
                parser($url, $start, $end);
                //$pq->unloadDocument()
                ?> 
