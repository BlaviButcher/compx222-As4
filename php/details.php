<!DOCTYPE html>
<?php
    

?>

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/details.css">
    <title>Details</title>
</head>

<body>
    <div class="grid-container">


        <?php
        
            echo "<div class='grid-item'>
            <div class='img-wrap'>
                <img src=../images/am.jpg alt=''>
            </div>
            <div class='info-wrap'>
                <div class='field-1'><strong>Title: </strong>$song->title</div>
                <div class='field-2'><strong>Artist: </strong>$song->artist</div>
                <div class='field-3'><strong>Album: </strong>$song->album</div>
                <div class='field-4'><strong>Album: </strong>$song->year</div>
                <div class='field-5'><strong>Album: </strong>$song->genre</div>
            </div>
        </div>";
        

        ?>


    </div>

</body>

</html>