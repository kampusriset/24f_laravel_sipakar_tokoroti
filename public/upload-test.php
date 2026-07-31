<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";

    var_dump($_FILES);

    echo "</pre>";

    exit;
}
?>

<!DOCTYPE html>
<html>
<body>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="gambar">
    <button type="submit">Upload</button>
</form>

</body>
</html>