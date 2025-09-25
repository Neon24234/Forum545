<?php
    $file = 'data.json';
    if(file_exists($file)){
        $jsonstring = file_get_contents($file);
        $topics = json_decode($jsonstring);
    }
    else{
        $topics = [];
    }
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
            "name" => $_POST['topic']          
            ]
        );
        $jsonstring = json_encode($topics, JSON_PRETTY_PRINT);
        file_put_contents($file, $jsonstring);
        }
        elseif (($_POST['action']=='delete')){
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
    <?php foreach ($topics as $value) {
        echo '<li>'.$value->name. '
        <form method="post">
        <input type="hidden" name="id" value="'. $value->id .'">
        <input type="hidden" name="action" value="delete">
        <input type=submit value="törlesztés">
        </form>
        ';
    }?>
    </ol>
    <br>
    <Form method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="topic">
        <input type="submit" value="add">
    </Form>
</body>
</html>