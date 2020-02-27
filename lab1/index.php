<?php
    $url       = $_SERVER['REQUEST_URI'];
    $urlSeg=explode('/',$url);
    $urlLast=$urlSeg[count($urlSeg)-1];

    ini_set('max_execution_time', '0');

    if($urlLast=='test'){
        $start=microtime(TRUE);
        for ($i=0; $i < 10; $i++) { 
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost/cc/lab1/index.php/run");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $t = curl_exec($ch);
            curl_close($ch);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost/cc/lab1/index.php/run");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $t = curl_exec($ch);
            curl_close($ch);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost/cc/lab1/index.php/run");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $t = curl_exec($ch);
            curl_close($ch);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost/cc/lab1/index.php/run");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $t = curl_exec($ch);
            curl_close($ch);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost/cc/lab1/index.php/run");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $t = curl_exec($ch);
            curl_close($ch);
        }
        $end=microtime(TRUE);
        echo ' '.($end-$start); 
        $res='<br/><br/><a href="/cc/lab1">Inapoi</a>';
        echo $res; 

        $log='Request:"'.$url.'" | Response:"'.$res.'" | Time:"'.($end-$start).'"'.PHP_EOL;
        file_put_contents('./log.txt',$log,FILE_APPEND); 
        exit;
    }elseif($urlLast=='metrics'){
        $log=file_get_contents('./log.txt');
        echo '<a href="/cc/lab1">Inapoi</a><br/><br/>'.$log; exit;
    }elseif($urlLast=='run'){
        $start=microtime(TRUE);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.thecocktaildb.com/api/json/v1/1/random.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $drink = curl_exec($ch);
        curl_close($ch);
        $drink=json_decode($drink);
        $drink=$drink->drinks[0];
        $drink=$drink->strIngredient1;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.themealdb.com/api/json/v1/1/random.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $food = curl_exec($ch);
        curl_close($ch);
        $food=json_decode($food);
        $food=$food->meals[0];
        $food=$food->strIngredient1;

        $q=urlencode(strtolower($drink.' '.$food));
        $in=$q;
       //$q='red+wine+steak';
       //$q='water+butter';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://pixabay.com/api/?key=15388720-95ad479de116bb16dacdca76d&q=".$q."&image_type=photo&per_page=3");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $res=json_decode($res);
        if($res->totalHits>0){
            $res=$res->hits[0];
            $res=$res->previewURL;

            $af='Am gasit imagine pentru '.$q.'<br/><img src="'.$res.'"/>';
        }else{
            $q=urlencode(strtolower($food));
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://pixabay.com/api/?key=15388720-95ad479de116bb16dacdca76d&q=".$q."&image_type=photo&per_page=3");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($ch);
            curl_close($ch);
            $res=json_decode($res);

            if($res->totalHits>0){
                $res=$res->hits[0];
                $res=$res->previewURL;

                $af='Am gasit imagine pentru '.$q.'<br/><img src="'.$res.'"/>';
            }else{
                $q=urlencode(strtolower($food));
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://pixabay.com/api/?key=15388720-95ad479de116bb16dacdca76d&q=".$q."&image_type=photo&per_page=3");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $res = curl_exec($ch);
                curl_close($ch);
                $res=json_decode($res);

                if($res->totalHits>0){
                    $res=$res->hits[0];
                    $res=$res->previewURL;

                    $af='Am gasit imagine pentru '.$q.'<br/><img src="'.$res.'"/>';
                }else{
                    $af='Nu am gasit imagine pentru '.$in;
                }
            }
        }
        $end=microtime(TRUE);
        echo $af;
        echo ' '.($end-$start);

        $log='Request:"'.$url.'" | Response:"'.$af.'" | Time:"'.($end-$start).'"'.PHP_EOL;
        file_put_contents('./log.txt',$log,FILE_APPEND); 
        echo '<br/><br/><a href="/cc/lab1">Inapoi</a>'; exit;
    }else{
        require('./interfata.html');  exit;
    } 
?>