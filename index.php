<?php

    require "dbBroker.php";
    require "model/user.php";
    session_start();

    //Ako je poslat POST zahtev u kome je upisan username i password - kreiraj user-a
    if(isset($_POST['username'])&& isset($_POST['password'])){
        $uname = $_POST['username'];
        $upassword = $_POST['password'];

        //$conn = new mysqli();
        $korisnik = new User(1, $uname, $upassword);
        //$odgovor = $korisnik->logInUser($uname, $upassword, $conn);
        $odgovor = User::logInUser($korisnik, $conn); // Posto je funkcija logInUser staticka, mozemo je pozvati nad klasom User

// && $odgovor->num_rows==1
        if($odgovor && $odgovor->num_rows==1){ //Vraca se result set - ako se vrati 1 red, to znaci da je pronadjen korisnik
            echo "Uspesno ste se prijavili";
            $_SESSION['user_id'] = $korisnik->id;
            header('Location: home.php');
            exit();
        }else{
            echo "Neuspesno logovanje";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>FON: Zakazivanje kolokvijuma</title>

</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnicko ime</label>
                    <input type="text" name="username" class="form-control"  required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>

        
    </div>
</body>
</html>