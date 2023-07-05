<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>

    <div class="container-sm">

    <h1 class="pb-3">BENVENUTI SU GATTOBOARD</h1>

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
        <input type="text" name="postContent" id="postContent"><br><br>
        <input type="submit">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  
    </div>
  </body>
</html>





