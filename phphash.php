<html>
<title>PHP Hash Calculator</title>
<body>

<?php

if ($_POST['hashtype'] == '-All-')  {
        $ha = hash_algos();
} else {
        $ha[] = $_POST['hashtype'];
}

if ($_POST['hashfield']) {
        echo "Plain text field: " . $_POST['hashfield'];
        echo "<br />";
        foreach($ha as $k) {
                echo $k . " text field: " . hash($k,$_POST['hashfield']);
                echo "<br />";
        }
}

//if ($_POST['hashfield']) {
//      echo $_POST['hashtype'] . " text field: " . hash($_POST['hashtype'],$_POST['hashfield']);
//      echo "<br />";
//}

if ($_FILES['hashfile']['tmp_name']) {
        echo "Filename: " . $_FILES['hashfile']['name'] . "<br />";
        echo "Size: " . $_FILES['hashfile']['size'] . "<br />";
        foreach($ha as $k) {
                echo $k . " sum: " . hash_file($k,$_FILES['hashfile']['tmp_name']);
                echo "<br />";
        }
}

//if ($_FILES['hashfile']['tmp_name']) {
//      echo "Filename: " . $_FILES['hashfile']['name'] . "<br />";
//      echo "Size: " . $_FILES['hashfile']['size'] . "<br />";
//      echo $_POST['hashtype'] . " sum: " . hash_file($_POST['hashtype'],$_FILES['hashfile']['tmp_name']);
//      echo "<br />";
//}

echo "<form method='post' action='".$_SERVER['PHP_SELF']."' enctype='multipart/form-data'>";

echo "<h1>Hash</h1>";

$ha = hash_algos();
$ha[] = '-All-';

echo "Hash algorithm: <select name='hashtype'>";
foreach($ha as $k) {
        echo ($k == $_POST['hashtype']) ? ("<option selected='selected' name='$k'>$k</option>") : ("<option name='$k'>$k</option>");
}
echo "</select>";
?>

<br />
Text field: <br />
<!--<textarea name="hashfield" rows="10" cols="50"><?php //echo htmlspecialchars($_POST['hashfield']); ?></textarea><br />-->
<textarea name="hashfield" rows="10" cols="50"><?php echo $_POST['hashfield']; ?></textarea><br />
File (limit: <?php echo ini_get('post_max_size'); ?>): <input type="file" name="hashfile" /> <br />
<br />
<input type="submit" value="Submit"/>
</form>

</body>
</html>
