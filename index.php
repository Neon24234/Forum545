<?php
    $szoveg = '';
    if(isset($_POST['topic'])){
        $topics = [];
        array_push($topics, $_POST['topic']);
        $jsonstring = json_encode($topics);
        $szoveg = $jsonstring;
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
    <?php echo $szoveg; ?>
    <h1>Témák:</h1>
    <Form method="post">
        <input type="text" name="topic">
        <input type="submit" value="add">
        
    </Form>
</body>
</html>