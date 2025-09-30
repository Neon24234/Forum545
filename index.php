<?php
    $file = 'data.json';
    if(file_exists($file)){
        $jsonstring = file_get_contents($file);
        $topics = json_decode($jsonstring);
    }
    else{
        $topics = [];
    }
    $comments_file = 'comment.json';
    if (file_exists($comments_file)) {
    $comments_json = file_get_contents($comments_file);
    $comments = json_decode($comments_json, true); // asszociatív tömbként
    }
    else{
        $comments = [];
    }
    if(isset($_GET['comment'])){

    }

    $time = date("Y. n. j. H:i:s");
    if(isset($_POST['action'])){
        $lastId = 0;
        if (!empty ($topics)) {
            $lastItem = end($topics);
            $lastId = $lastItem->id; 
        }
        $newId = $lastId + 1;
        if($_POST['action']=='add')
        {
        array_push($topics, 
        (object)[
            "id" => $newId,
            "name" => $_POST['topic'],
            "time" => $time
            ]
        );
        $jsonstring = json_encode($topics, JSON_PRETTY_PRINT);
        file_put_contents($file, $jsonstring);
        }
        elseif (($_POST['action']=='delete') && ($_POST['test'] == 'value1')){
             $id = $_POST['id'];
        foreach ($topics as $key => $value) {
            if ($value->id == $id) {
                //unset($topics[$key]);
                array_splice($topics,$key,1);
                break;
            }
        }
        //$jsonstring = json_encode(array_values($topics), JSON_PRETTY_PRINT);
        $jsonstring = json_encode($topics, JSON_PRETTY_PRINT);
        file_put_contents($file, $jsonstring);
        }
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>
<body>
    <h1>Témák:</h1>
    <ol>
    <?php
        if(!isset($_GET['topic'])){
        foreach ($topics as $value) {
        echo '<li><a href="index.php?topic=' . $value->id . '">'. $value->name . '</a> +'. $value->time . '
        <form method="post">
        <input type="hidden" name="id" value="'. $value->id .'">
        <input type="hidden" name="action" value="delete">
        <input type=submit value="törlesztés"> <input type="checkbox" name="test" value="value1">
        </form>
        ';
        }
    }else{
        echo '<h1>na itt kell megírni az új részt. topic ID: ' . $_GET['topic'].'</h1>';
        echo '<a href=index.php>Vissza a témákhoz</a>';      
        
    }
    ?>
    </ol>
    <br>
    <Form method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="topic">
        <input type="submit" value="add">
    </Form>
    <br>
    <?php

if (isset($_GET['comment'])) {
  echo "Az utolsó kapott érték: ".$_GET['comment'];        
}

?>
<?php
    if (isset($_GET['topic'])) {
    echo '<form method="GET">
        <input type="text" name="comment">
        <input type="submit" value ="add comment">
    </form>';
    }
    ?>
</body>
</html>