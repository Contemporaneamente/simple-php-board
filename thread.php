<?php
    //se il parametro t dell'url è vuoto allora rimando alla homepage
    if (!isset($_GET["t"]))
    {
        include "catalogredirect.html";
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GATTOBOARD - <?php echo strtoupper($_GET["t"]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body> 
    <div class="container-sm">

    <h1 class="pb-3"><?php echo strtoupper($_GET["t"]); ?></h1>

    <?php  

        $authors = array();
        $contents = array();
        $dates = array();
        $post_idS = array();

        $thread = $_GET["t"];

        $conn = new mysqli("localhost","memeboard","memeboard","memeboard");

        if ($conn->connect_error)
        {
            die("Failed connection to the database");
        }

        //$getPostQuery = "SELECT * FROM `threadone`";
        //$xGetPostQuery = $conn->query($getPostQuery);
        $getPostQuery = "SELECT * FROM `$thread`";
        $doesTableExists = "SHOW TABLES LIKE '$thread'";

        //nell if lancio una query per vedere se sto selezionando una tabella che esiste
        //e poi con fetch_all() vado a prendere il booleano che mi interessa
        if($conn->query($doesTableExists)->fetch_all())    
        {
            //tutto sto pippone assegna a delle variabili i contenuti della query
            $xGetPostQuery = $conn->query($getPostQuery);
            while ($row = $xGetPostQuery->fetch_assoc())
            {
                $authors[] = $row["author"];
                $contents[] = $row["content"];
                $dates[] = $row["date"];
                $post_idS[] = $row["post_id"]; 
            }

            for ($i = 0; $i < count($authors); $i++)
            {
                $author = $authors[$i];
                $content = $contents[$i];
                $date = $dates[$i];
                $post_id = $post_idS[$i];
                include "post.php";
            }
        }
        else
        {
            echo "Maybe the thread does not exist. :(";
        }

        $conn->close();

    ?>
    <br>

    <form method="POST" action=<?php echo "newpost.php?t=".$thread ?>>
        <h4>Add a new comment</h4>
        <label for="nickName">Choose a nickname:</label><br>
        <input type="text" name="nickName" id="nickName" class="form-control mb-3">
        <label for="postContent">Write your comment:</label><br>
        <textarea type="text" name="postContent" id="postContent" class="form-control mb-3"></textarea>
        <input type="submit" class="form-control btn btn-primary">
    </form>

    <h5 class="pt-3"><a href="index.php">Back to catalog</a></h5>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </div>
    </body>
</html>




