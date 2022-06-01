<?php
include("incdb.php");
if (!$db) {
    die("Connection failed: " . mysql_connect_error());
} else {
    echo "Connected successfully";
}

require_once 'phpQuery.php';
//$doc = phpQuery::newDocument(file_get_contents('https://www.tripadvisor.ru/Restaurants-g298484-Moscow_Central_Russia.html'));

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
            $nazvanie = $article->find('._2kbTRHSI')->text();
            $link = $article->find('.wQjYiB7z a')->attr('href'); // парсим ссылку на статью

            echo $nazvanie;
            // echo '<br>';

            $urll = 'https://www.tripadvisor.ru';
            if (!empty($link)) $data_link = file_get_contents($urll . $link);
            $document_с = phpQuery::newDocument($data_link);

            foreach ($document_с->find('.page ') as $element) {
                $pq2 = pq($element);
                $image = $pq2->find('.prw_rup prw_common_basic_image photo_widget large landscape img')->attr('src');
                //$image = $pq2->find('.large_photo_wrapper .basicImg')->attr('src');   
                //$img = file_get_contents($image);
                //$nameimg=1;
                //file_put_contents(dog-friendly/'$nameimg.jpg', $img); 
                // $nameimg+=1;
                $opisanie = $pq2->find('._1ud-0ITN ._13OzAOXO _34GKdBMV')->text();
                $address = $pq2->find('._29woakkF')->text();
                $phone = $pq2->find('._15QfMZ2L a')->text();
                //$menu = $pq2->find('._13OzAOXO _2VxaSjVD ly1Ix1xT a')->attr('href'); // парсим контент часть статьи
                //$info = $pq2->find('._3acGlZjD');
                //$info->find('.y5QNMrR5')->remove();
                //$data['text'] = pq($adres)->text();

                //echo $data['text'];
                echo $image;
                //echo "<img src='$image' width='90' height='105'>";
                echo $opisanie . '<br>';
                echo $address;
                echo '<br>';
                echo $phone;
                echo '<hr>';
            }
            
                               
                        $zapros = mysql_query("INSERT INTO df_cafes(name, address, link, image, opisanie, category, telephone, time_open, price) VALUES ('$name', '$address', '$link', '$img', '$opisanie', '$category', '$telephone', '$time_open', '$price')");
                        if($zapros==true)
        				{
        					echo '<h2>Данные добавлены</h2>';
        				}
        				else
        				{
        					echo 'Ошибка добавления';
        				}
        }



        $variable = $doc->find('.pageNumbers .current')->next()->attr('href');
        $variable = substr($variable, 0, strpos($variable, "#EATERY_LIST_CONTENTS"));
        //echo $variable;
        //echo '<br>';
        $urll = 'https://www.tripadvisor.ru';
        $next = $urll . $variable;
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
$start = 0;
$end = 1;
parser($url, $start, $end);
//$pq->unloadDocument()
?>