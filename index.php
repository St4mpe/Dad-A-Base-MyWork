<?php
$host="localhost";
$user="root";
$pass="";
$db="pappajokes";
$conn=mysqli_connect($host, $user, $pass, $db);

if(isset($_POST['btn']))
{
    $joketext=$_POST['joketext'];
    $jokeanswer=$_POST['jokeanswer'];
    $sql="INSERT INTO jokes(joketext, jokeanswer) VALUES ('$joketext','$jokeanswer')";
    $result=mysqli_query($conn,$sql);
}

if(isset($_GET['vote']))
{
    $Vote = $_GET['vote'];
    $id = $_GET['id'];
    if ($Vote=="up")
    {
        $sql="UPDATE jokes SET score=score+1 WHERE id=$id";
    }
}

$sql="SELECT * FROM jokes ORDER BY score DESC";
$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Lista över de bästa pappa skämten!</h1>
    </header>
    <main>
        <section>
            <form action="index.php" method="POST">
                <label>Pappaskämtet:
                    <input type="text" name="joketext">
                </label>
                <label>Svaret till skämetet:
                    <input type="text" name="jokeanswer">
                </label>
                <input type="submit" value="Lägg in" name="btn"></input>
            </form>
        </section>
        <section class="everyJoke">
            <?php 
                while($row=mysqli_fetch_assoc($result)): ?>
                <details class="joke">
                    <summary class="text">
                        <section>
                            <?=$row['joketext']?>
                        </section>
                        <section class="vote">
                            <a href="index.php?vote=down&id=<?=$row['id']?>">-</a>
                            <a href="index.php?vote=up&id=<?=$row['id']?>">+</a>
                        </section>
                    </summary>
                    <?=$row['jokeanswer']?>  
                </details>
            <?php 
                endwhile  
            ?>
        </section>
    </main>
</body>
</html>