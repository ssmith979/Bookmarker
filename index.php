<?php
    //Start Session
    session_start();
    if(isset($_POST['name'])){
        if(isset($_SESSION['bookmarks'])){
            $_SESSION['bookmarks'][$_POST['name']] = $_POST['url'];

        } else {
            $_SESSION['bookmarks'] = array($_POST['name'] => $_POST['url']);
        }
     }
     if(isset($_GET['action']) && $_GET['action'] == 'clear') {
        session_unset();
        session_destroy();
        //another option to clear all instead of session_unset and session_destroy
        // unset($_SESSION['bookmarks']);
         header("Location: index.php");
     }
     if(isset($_GET['action']) && $_GET['action'] == 'delete'){
         unset($_SESSION['bookmarks'][$_GET['name']]);
         header("Location: index.php");
     }
?>
                                                                                                                                                                                                                                                                                                                                            
<!DOCTYPE html>
<html>
<head>      
	<title> Bookmarker </title>
	<link rel="stylesheet" href="bootstrap.min.css">        
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark ">              
      <a class="navbar-brand" href="#">Bookmarker</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li ><a class="nav-link" href="index.php">Home </a></li>
        </ul>
         <ul class="navbar-nav navbar-right">
          <li ><a class="nav-link" href="index.php?action=clear">Clear All </a></li>
        </ul>
      </div>
    </nav>
    <br>
    <div class='container'>
        <div class= 'row'>
            <div class='col-md-7'>
                <form method= 'post' action='<?php $_SERVER['PHP_SELF']; ?>' >
                    <div class='form-group'>
                        <label> Website Name </label>
                        <input type= 'text' class='form-control' name='name'>
                    </div>
                     <div class='form-group'>
                        <label> Website URL </label>
                        <input type= 'text' class='form-control' name='url'>
                    </div>
                    <input type='submit' value'Submit' class='btn btn-default'>
                </form>

            </div>
            <div class='col-md-5'>
                <?php if(isset($_SESSION['bookmarks'])) : ?>
                    <ul class = 'list-group'>
                        <?php 
                            foreach($_SESSION['bookmarks'] as $name => $url)  :  ?>
                            <li class= 'list-group-item'>
                              <a href="<?php echo $url; ?>"><?php echo $name ; ?></a>
                          
                              <a class='btn-outline-danger' style='background-color:transparent' href='index.php?action=delete&name=<?php echo $name; ?>'> [X]</a>
                            </li>
                        <?php endforeach; ?>

                    </ul>

                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
