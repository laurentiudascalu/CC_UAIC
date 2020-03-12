<?php
    // url-ul de baza este http://localhost/cc/tema2/
    $url = $_SERVER['REQUEST_URI'];
    $urlSeg=explode('/',$url);

    $urlTest=$urlSeg[count($urlSeg)-1];
    $urlTest=explode('?',$urlTest);
    $urlTest=$urlTest[0];

    function conectDB(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            exit;
        }

        return $conn;
    }

    $testConnection = conectDB();

    ini_set('max_execution_time', '0');

    
    function getAnimale($id = -1, $nume = '', $stapan = '', $rasa= ''){
        $conn = conectDB();

        $sql='select * from `animale` ';
        $ok=0;
        if($id!=-1){
            $sql.="where `id`='".$id."'";
            $ok=1;
        }
        if ($nume!=''){
            if($ok==1){
                $sql.=" and `nume`='".$nume."'";
            }else{
                $sql.="where `nume`='".$nume."'";
                $ok=1;
            }
        }
        if ($stapan!=''){
            if($ok==1){
                $sql.=" and `stapan`='".$stapan."'";
            }else{
                $sql.="where `stapan`='".$stapan."'";
                $ok=1;
            }
        }
        if ($rasa!=''){
            if($ok==1){
                $sql.=" and `rasa`='".$rasa."'";
            }else{
                $sql.="where `rasa`='".$rasa."'";
                $ok=1;
            }
        }
        $sql.=" order by `stapan` ASC, `rasa` ASC, `nume` ASC";
        return mysqli_query($conn,$sql);
    }

    function postAnimal($nume, $stapan, $rasa){
        if($nume != '' && $stapan!='' && $rasa!=''){
            $conn = conectDB();

            $sql = "INSERT INTO `animale` (`nume`, `stapan`, `rasa`) VALUES ('".$nume."', '".$stapan."','".$rasa."')";
           
            mysqli_query($conn,$sql);

            return mysqli_insert_id($conn);
        }else{
            return 0;
        }
        
    }

    function deleteAnimal($id){
        $conn = conectDB();

        $sql = "DELETE FROM `animale` WHERE `id` = '".$id."'";
           
        mysqli_query($conn,$sql);

        return $id;
        
    }

    function putAnimal($id, $nume='', $stapan='', $rasa=''){
        if($nume != '' || $stapan!='' || $rasa!=''){
            $conn = conectDB();

            $sql='UPDATE `animale` ';
            $ok=0;
            if ($nume!=''){
                if($ok==1){
                    $sql.=" , `nume`='".$nume."'";
                }else{
                    $sql.="SET `nume`='".$nume."'";
                    $ok=1;
                }
            }
            if ($stapan!=''){
                if($ok==1){
                    $sql.=" , `stapan`='".$stapan."'";
                }else{
                    $sql.="SET `stapan`='".$stapan."'";
                    $ok=1;
                }
            }
            if ($rasa!=''){
                if($ok==1){
                    $sql.=" , `rasa`='".$rasa."'";
                }else{
                    $sql.="SET `rasa`='".$rasa."'";
                    $ok=1;
                }
            }
            $sql.=" WHERE `id` = '".$id."'";
           
            mysqli_query($conn,$sql);

            return $id;
        }else{
            return 0;
        }
        
    }
    if($urlTest=='getAnimale'){
       $id = isset($_GET['id']) ? $_GET['id'] : -1;
       $nume = isset($_GET['nume']) ? $_GET['nume'] : '';
       $stapan = isset($_GET['stapan']) ? $_GET['stapan'] : '';
       $rasa = isset($_GET['rasa']) ? $_GET['rasa'] : '';
       $rasp = getAnimale($id, $nume, $stapan, $rasa);
       if(mysqli_num_rows($rasp) > 0){
            $raspuns = mysqli_fetch_all($rasp);
            $raspuns = json_encode($raspuns);
            header("HTTP/1.0 200 OK");
            header('Content-Type: application/json');
            echo $raspuns; exit;
        }else{
            $raspuns='Nu am gasit nici un animal.';
            $raspuns = json_encode($raspuns);
            header("HTTP/1.0 404 No Found");
            header('Content-Type: application/json');
            echo $raspuns; exit;
        }
    }elseif($urlTest=='postAnimal'){
       $nume = isset($_GET['nume']) ? $_GET['nume'] : '';
       $stapan = isset($_GET['stapan']) ? $_GET['stapan'] : '';
       $rasa = isset($_GET['rasa']) ? $_GET['rasa'] : '';
       if($nume != '' && $stapan!='' && $rasa!=''){
           $rasp = getAnimale(-1, $nume, $stapan, $rasa);
           if(mysqli_num_rows($rasp) > 0){
                $raspuns = 'Animalul exista deja in baza de date.';
                $raspuns = json_encode($raspuns);
                header("HTTP/1.0 409 Conflict");
                header('Content-Type: application/json');
                echo $raspuns; exit;
            }else{
                $rasp = postAnimal($nume, $stapan, $rasa);
                if($rasp == 0){
                    $raspuns='Nu am adaugat animalul.';
                    $raspuns = json_encode($raspuns);
                    header("HTTP/1.0 404 No Found");
                    header('Content-Type: application/json');
                    echo $raspuns; exit;
                }else{
                    $raspuns='Am adaugat animalul cu id-ul '.$rasp;
                    $raspuns = json_encode($raspuns);
                    header("HTTP/1.0 201 Created");
                    header("Location: http://localhost/cc/tema2/index.php/getAnimale?id=".$rasp);
                    echo $raspuns; exit;
                }
            }
        }else{
            $raspuns = 'Nu ai specificat toti parametrii (nume, stapan, rasa).';
            $raspuns = json_encode($raspuns);
            header("HTTP/1.0 405 Method Not Allowed");
            header('Content-Type: application/json');
            echo $raspuns; exit;
        }
    }elseif($urlTest=='putAnimal'){
       $id = isset($_GET['id']) ? $_GET['id'] : -1;
       $nume = isset($_GET['nume']) ? $_GET['nume'] : '';
       $stapan = isset($_GET['stapan']) ? $_GET['stapan'] : '';
       $rasa = isset($_GET['rasa']) ? $_GET['rasa'] : '';
       if($id!=-1 && ($nume != '' || $stapan!='' || $rasa!='')){
           $rasp = getAnimale($id);
           if(mysqli_num_rows($rasp) > 0){
                $rasp = putAnimal($id, $nume, $stapan, $rasa);
                $raspuns = 'Am modificat animalul cu id-ul '.$id;
                $raspuns = json_encode($raspuns);
                header("HTTP/1.0 200 OK");
                header('Content-Type: application/json');
                echo $raspuns; exit;
            }else{
                $raspuns = 'Animalul nu exista in baza de date.';
                $raspuns = json_encode($raspuns);
                header("HTTP/1.0 404 Not Found");
                header('Content-Type: application/json');
                echo $raspuns; exit;
            }
        }else{
            $raspuns = 'Nu ai specificat id-ul si unul din campurile: (nume, stapan, rasa).';
            $raspuns = json_encode($raspuns);
            header("HTTP/1.0 405 Method Not Allowed");
            header('Content-Type: application/json');
            echo $raspuns; exit;
        }
    }elseif($urlTest=='deleteAnimal'){
       $id = isset($_GET['id']) ? $_GET['id'] : -1;
       if($id!=-1){
           $rasp = getAnimale($id);
           if(mysqli_num_rows($rasp) > 0){
                $rasp = deleteAnimal($id);
                $raspuns = 'Am sters animalul cu id-ul '.$id;
                $raspuns = json_encode($raspuns);
                header("HTTP/1.0 200 OK");
                header('Content-Type: application/json');
                echo $raspuns; exit;
            }else{
                $raspuns = 'Animalul nu exista in baza de date.';
                $raspuns = json_encode($raspuns);
                header("HTTP/1.0 404 Not Found");
                header('Content-Type: application/json');
                echo $raspuns; exit;
            }
        }else{
            $raspuns = 'Nu ai specificat id-ul.';
            $raspuns = json_encode($raspuns);
            header("HTTP/1.0 405 Method Not Allowed");
            header('Content-Type: application/json');
            echo $raspuns; exit;
        }
    }else{
        $raspuns='Nu am gasit functia cautata';
        $raspuns = json_encode($raspuns);
        header("HTTP/1.0 404 Not Found");
        header('Content-Type: application/json');
        echo $raspuns; exit;
    } 
?>