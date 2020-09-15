<?php

    $stan_id = $_GET['stan_id'];
    $user_id = $_GET['user_id'];
    
    $dat1 = $_POST['start'];
    $dat2 = $_POST['end'];

    $ulazak = date($dat1);
    $izlazak = date($dat2);

    $zauzet = false;    

    if(!$user_id){
        header("Location: ../views/login.php?id=".$stan_id."&&msg=Prijavite se!");
        exit();
    } elseif (!$ulazak || !$izlazak) {
        header("Location: ../views/details.php?id=".$stan_id."&&msg=Unesite datum!");
        exit();
    } elseif ($ulazak < $izlazak && date('Y-m-d') < $ulazak){
        require 'connection.inc.php';

        $sql = "SELECT * FROM ugovor WHERE id_stanovi='$stan_id'";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../views/details.php?id=".$stan_id."&&msg=sqlerror");
            exit();
        }else {
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $result = $res->fetch_assoc();
            if($result){
                foreach($result as $r)
                {   
                    $us = date($result['useljenje']);
                    $is = date($result['useljenje']);
                    $inVal = $us <= $ulazak && $is >= $ulazak;
                    $outVal = $us <= $izlazak && $is>= $izlazak;

                    if($inVal or $outVal)
                    {   
                        $zauzet = true;
                        header("Location: ../views/details.php?id=".$stan_id."&&msg=Stan je zauzet od ". $result['useljenje'] . "do ". $result['iseljenje']);
                        exit();
                    } 
                }
            }
            
            if(!$zauzet)
                {
/* 
                    $sql = "SELECT * FROM stanovi WHERE id_stanovi='$stan_id'";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    $result = $res->fetch_assoc();

                    $cijenaDan = $result['cijena']; */

                    $sql = "INSERT INTO ugovor (useljenje,iseljenje,cijena_ugovora,id_stanovi,id_korisnik) VALUES (?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../views/details.php?id=".$stan_id."&&msg=sqlerror1");
                        exit();
                    }
                    else{
                        $diff = strtotime($izlazak) - strtotime($ulazak); 
                        $days = abs(round($diff / 86400));
                        $cijena = $days;

                        mysqli_stmt_bind_param($stmt,"ssdii",$ulazak,$izlazak,$cijena,$stan_id,$user_id);
                        mysqli_stmt_execute($stmt);
                        
                        header("Location: ../views/details.php?id=".$stan_id."&&msg=Uspješna rezervacija od ".$ulazak." do ". $izlazak.". Ukupan trošak: " . $cijena);
                        exit();
                    }
                }
        }
    } else {
        header("Location: ../views/details.php?id=".$stan_id."&&msg=Unesite valjani datum");
        exit();
    }

