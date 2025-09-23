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

        if($_POST['action']=='add')
        {
        array_push($topics, $_POST['topic']);
        $jsonstring = json_encode($topics);
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
    <?php foreach ($topics as $key => $value) {
        echo '<li>'.$value. '
        <form method="post">
        <input type="hidden" name="topic" value="'. $value .'">
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