<?php
    $thread = $_GET["t"];
    $postAuthor = "";
    $postContent = "";

    $conn = new mysqli("localhost","memeboard","memeboard","memeboard");

    if ($conn->connect_error)
    {
        die("Failed connection to the database");
    }
    echo "Successful connection to the database<br>";
    
    if(!empty($_POST) && !("" == trim($_POST["postContent"])))
    {
        //check per controllare che il nickname sia stato inserito
        if("" == trim($_POST["nickName"]))
        {
            $postAuthor = "Anonymous";
        }
        else
        {
            $postAuthor = htmlspecialchars($_POST["nickName"]);
        }
        
        //per il contenuto non è così importante che si controlli che anche la richiesta abbia testo
        $postContent = htmlspecialchars($_POST["postContent"]);

        $newPostQuery = "INSERT INTO `$thread` (`author`, `content`) VALUES (?,?)";
        $xNewPostQuery = $conn->execute_query($newPostQuery, [$postAuthor, $postContent]);

        if ($xNewPostQuery === TRUE)
        {
            echo "Post successfully added to the database :)<br>";
        }
        else
        {
            echo "Something went wrong while posting<br>";
        }

    }
    else
    {
        echo "Someting went wrong with the request<br>";
    }

    $conn->close();
?>

<script>
        //window.location.replace("http://localhost/phptutorial/catalog.php");
        window.location.replace(<?php echo "'thread.php?t=".$thread."'" ?>);
</script>