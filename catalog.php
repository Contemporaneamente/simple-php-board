<h1>BENVENUTI SU GATTOBOARD</h1>

<p>The following threads are open:</p>

<ul>
    <?php
        $tables = array();

        $conn = new mysqli("localhost","memeboard","memeboard","memeboard");

        if ($conn->connect_error)
        {
            die("Failed connection to the database");
        }

        $showTables = "SHOW TABLES";
        $xShowTables = $conn->query($showTables);

        foreach ($xShowTables->fetch_all() as $table)
        {
            echo "<li><a href='thread.php?t=$table[0]'>".$table[0]."</a>"."<br></li>";
        }

    ?>
</ul>

<form method="POST" action="newthread.php">
    <h4>Open a new thread</h4>
    <label for="nickName">Choose a nickname:</label><br>
    <input type="text" name="nickName" id="nickName"><br>
    <label for="threadTitle">Thread title:</label><br>
    <input type="text" name="threadTitle" id="threadTitle"><br>
    <label for="postContent">Write your first post:</label><br>
    <input type="text" name="postContent" id="postContent"><br>
    <input type="submit">
</form>