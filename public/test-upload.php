<?php

if ($_FILES) {
    echo "<pre>";
    print_r($_FILES);
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="foto">
    <button>Upload</button>
</form>