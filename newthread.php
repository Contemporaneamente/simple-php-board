<?php
    $conn = new mysqli("localhost","memeboard","memeboard","memeboard");

    if ($conn->connect_error)
    {
        die("Failed connection to the database");
    }
    echo "Successful connection to the database<br>";
    
    $threadTable = $_POST["threadTitle"];

    $threadTableQuery = "CREATE TABLE `$threadTable` ( `post_id` int(6) UNSIGNED NOT NULL, `author` varchar(30) NOT NULL, `content` text NOT NULL, `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci"; 
    $xThreadTabbleQuery = $conn->query($threadTableQuery);

    echo "Table created<br>";
    
    $alterTableQuery1 = "ALTER TABLE `$threadTable` ADD PRIMARY KEY (`post_id`), ADD UNIQUE KEY `post_id` (`post_id`)";
    $xAlterTableQuery1 = $conn->query($alterTableQuery1);

    echo "Step 1<br>";

    $alterTableQuery2 = "ALTER TABLE `$threadTable` MODIFY `post_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1"; 
    $xAlterTableQuery2 = $conn->query($alterTableQuery2);

    echo "Step 2<br>";

    if(!empty($_POST))
    {
        $postAuthor = $_POST["nickName"];
        $postContent = $_POST["postContent"];

        $newPostQuery = "INSERT INTO `$threadTable` (`author`, `content`) VALUES (?,?)";
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
        window.location.replace(<?php echo "'thread.php?t=".$threadTable."'" ?>);
</script>