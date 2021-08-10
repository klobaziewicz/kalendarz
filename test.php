<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KŁ</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <header class="ch">Kalendarz</header>
        <section class="ch">
        <div class="tp1">Twój plan</div>
        <br>
        <?php
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];;
            $t="\t";
            $conn=@new mysqli('localhost','root','','wakacje');
            $rs=$conn->query("SELECT Id,nazwa,text,data FROM todo") or die('Nie można pobrać danych');
            if($rs->num_rows>0)
            {
            echo '<table>';
                $lp=0;
            while ($rec = $rs->fetch_array()) {
                echo '<tr><td><div class="td1">', ++$lp, $t,  $rec['nazwa'],$t,  $rec['text'],$t, $rec['data'], '</div><form method="post" class="f1"><input type="hidden" name="id" value="' . $rec['Id'] . 
                '"><input type="submit" class="bt2" name="akcja" value="X"></form></td></tr>';
            }
            echo '</table>';
            }
            
        ?>

        </section>
        <article class="ch">Dodaj wydarzenie
            <?php
                if(isset($_POST['akcja'])){
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];;
                    $conn->query("DELETE FROM todo WHERE Id=$_POST[id]") or die('Nie można usunąć rekordu');
                    header('refresh: 0; url='.$actual_link);
                }
                if(isset($_GET['title']) and isset($_GET['text']) and isset($_GET['data'])){
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];;
                    $tite=$_GET['title'];
                    $text=$_GET['text'];
                    $data=$_GET['data'];
                    echo "tytuł: ".$tite." text: ".$text;
                    $sql="INSERT INTO todo(nazwa,text,data) 
                    VALUES('$tite','$text','$data')";
                    $conn->query($sql) or die('Nie można dodać rekordu');
                    header('refresh: 0; url="'.$actual_link);
                }
            ?>
            <form class="f2">
                Nazwa wydarzenia: <input type="text" name="title"><br>
                <textarea rows="4" cols="50" name="text">Wpisz tekst</textarea><br>
                <input type="date" name="data"><br>
                <input type="submit" class="bt1" value="Dodaj">
            </form>
        </article>

        <footer class="ch">
            Copyright 2019-2021 by Refsnes Data. All Rights Reserved. KŁ is Powered by Krzysztof Łobaziewicz.
        </footer>
    
    </div>
</body>
</html>