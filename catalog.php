<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GATTOBOARD HOME</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>

    <div class="container-sm text-center">

    <h1 class="pb-3">BENVENUTI SU GATTOBOARD</h1>

    <p>The following threads are open:</p>

    <div class="d-flex">
      <?php
          $tables = array();
  
          $conn = new mysqli("localhost","memeboard","memeboard","memeboard");
  
          if ($conn->connect_error)
          {
              die("Failed connection to the database");
          }
        
          $showTables = "SHOW TABLES";
          $xShowTables = $conn->query($showTables);
          
          //prende i nomi delle tabelle nel database scelto
          foreach ($xShowTables->fetch_all() as $table)
          {
              echo "<div class='card m-1 p-1 flex-fill'><a href='thread.php?t=$table[0]'>".strtoupper($table[0])."</a></div>";
          }
        
      ?>
    </div>
    <div class="container-sm">        
      <form method="POST" action="newthread.php">
          <h4>Open a new thread</h4>
          <label for="nickName">Choose a nickname:</label><br>
          <input type="text" name="nickName" id="nickName" class="form-control mb-3" placeholder="Anonymous">
          <label for="threadTitle">Thread title:</label><br>
          <input type="text" name="threadTitle" id="threadTitle" class="form-control mb-3" required title="Thread title can't be empty." placeholder="Write your thread title here.">
          <label for="postContent">Write your first post:</label><br>
          <textarea type="text" name="postContent" id="postContent" class="form-control mb-3" required title="Comment can't be empty." placeholder="Write your comment here."></textarea><br><br>
          <input type="submit" class="form-control btn btn-primary">
      </form>
    </div>        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  
    </div>
  </body>
</html>





