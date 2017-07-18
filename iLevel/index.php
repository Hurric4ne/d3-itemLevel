<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diablo 3 Itemlevel List</title>
    <link rel="stylesheet" href="res/css/main.css">
  </head>

  <body>
    <h1>Diablo 3 Item-Level</h1>
    <form action="index.php" method="post">
        <input type="text" name="item-name" placeholder="Leorics Crown" value="<?php if (isset($_POST['item-name'])) echo $_POST['item-name']; ?>">
        <input type="submit" name="search" value="show">
    </form>

    <table class='table'>
        <tr>
            <th>Item Name</th>
            <th>Item Level</th>
            <th>required Level</th>
        </tr>
    <?php
        $url_prefix = 'https://eu.api.battle.net/d3/data/item/';
        $url_suffix = '?locale=en_GB&apikey=27hd5khrafctn6dv8g9egtbt25qbzcqz';

        if(isset($_POST["item-name"]))
        {
            $item_name = $_POST["item-name"];
            $item_name = str_ireplace(" ", "-", $item_name);
            $item_name = str_ireplace("'", "", $item_name);
            $item_name = strtolower($item_name);

            if($item_name == "hellcat-waistguard")
            {
                $item_name = "hellcat-waistguard-1VQtXb";
            }

            $request_uri = $url_prefix.$item_name.$url_suffix;
            $content_uri = @file_get_contents($request_uri);
            if (!$content_uri) {
                echo "<h2>Item not found. Please check spelling</h2>";
                exit();
            }
            $item_response = json_decode($content_uri, true);

            echo "<tr><td>".$item_response['name']."</td>";
            echo "<td>".$item_response['itemLevel']."</td>";
            echo "<td>".$item_response['requiredLevel']."</td></tr>";
        }
    ?>
    </table>
  </body>
</html>
