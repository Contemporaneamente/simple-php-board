<?php
    $thread = $_GET["t"];

    $conn = new mysqli("localhost","memeboard","memeboard","memeboard");

    if ($conn->connect_error)
    {
        die("Failed connection to the database");
    }
    echo "Successful connection to the database<br>";
    
    if(!empty($_POST))
    {
        $postAuthor = $_POST["nickName"];
        $postContent = $_POST["postContent"];

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