<?php
    require('SimpleLogViewer/SimpleLogViewer.php');
    
    $simpleLogViewer = new SimpleLogViewer('/var/log/apache2/projects_error_log');
?>
<!doctype html>
<html>
    <head>
        <title>Apache Logs</title>
        <meta charset="utf-8">
        <!--<meta http-equiv="refresh" content="5">-->
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <ol id="log">
            <?php foreach($simpleLogViewer->formattedLines as $line): ?>
                <li <?php if($line["isToday"]): ?>class="today"<?php endif; ?>>
                    <span class="<?php echo $line["level"]; ?> level"><?php echo $line["level"]; ?></span>
                    <span class="message"><?php echo $line["message"]; ?></span>
                    <div class="time"><?php echo $line["dateAndTime"]; ?></div>
                </li>
            <?php endforeach; ?>
        </ol>
    </body>
</html>