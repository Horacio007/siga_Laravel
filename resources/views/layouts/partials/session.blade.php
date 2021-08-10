@php
   session_start();

    if(!isset($_SESSION['user'])){
        return view('login.login')
        exit();
    }else if(isset($_SESSION['timeout'])){
        $inactividad = 600;
        $sessionTTL = time() - $_SESSION["timeout"];

        if($sessionTTL > $inactividad){
            date_default_timezone_set('America/Mexico_City');
            $f = date("Y-m-d");
            $h = date("H:i:s");
            $R2 = $objeto->insert_logout($_SESSION['user'], $_SESSION['tipo'], $f, $h);
            session_unset();
            session_destroy();
            header("Location:/siga/vista/index.php");
            die();
            exit();
        }
    }   
@endphp