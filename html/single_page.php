<!DOCTYPE html>
<html lang="ru">
    <head>
    	<meta charset='UTF-8'>
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'> 
    	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
    	<link rel="manifest" href="/manifest.json">
    	<link href='css/g.css' rel='stylesheet' type='text/css' media='all' />
    	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#603cba">
        <meta name="theme-color" content="#ffffff">
        <script src="/app.js"></script>
        <title>Pet lovers cafes</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
       
    </head>
    <body>
       <?php include "blocks/h.php";?>
      <main>
         <?php
            include("incdb.php");    
			$id=$_GET['id'];
			echo "id=".$id;
			echo '<br>';
			if(isset($_GET['id']))
			{ 
				$r=mysql_query("SELECT * FROM time_cafes where id= '$id'",$db);
				if($r==true)
			    {var_dump($r);}
			    else {var_dump($r); echo '<br>'; echo "Ошибка ";}
				echo "<ol>";
				while($caf=mysql_fetch_array($r))
				{ ?>
					<div class="cafe">
                        <h2><?php echo $caf['name']; ?></h2>
                        <img src='<?php echo $caf['img'] ; ?>' width='240px' height='190px' alt='тайм-кафе с животными'>
                        <p><?php echo $caf['opisanie']; ?></p>
                        <p><?php echo $caf['address']; ?></p>
                        <p><?php echo $caf['telephone']; ?></p>
                        <p><?php echo $caf['time_open']; ?></p>
                    </div>
                <?php  } 
				echo "</ol>";
			}
			else
			{
			
                var_dump($_GET['id']);
                echo "NOOOO";
            }
?>

        

      </main>
      <footer>
        <div class="f_menu">
            <ul>
                <li>
                    <a href='dog_cafe.php'>Дог-френдли заведения</a>
                </li>
                <li>
                    <a href='time_cafe.php'>Тайм-кафе с животными</a>
                </li>
                <li>
                    <a href='useful_sources.php'>Полезные ссылки</a>
                </li>
            </ul>
        </div>
      </footer>
    </body>
</html>


