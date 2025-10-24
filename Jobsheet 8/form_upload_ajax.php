<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah File Dokumen</title>
    <link rel="stylesheet" href="upload.css">
</head>
<body>
    <div class="upload-form-container">
        <h2>Ungga File Dokumen</h2>
        <form action="upload.php" id="upload-form" method="post" enctype="multipart/form-data">
            <div class="file-input-container">
                <input type="file" name="file" id="file" class="file-input">
                <label for="file" class="file-label">Pilih File</label>
                <button class="upload-button" type="submit" name="submit" id="upload-button" disabled>
                Unggah
            </button>
            </div>
            
        </form>
        <div class="upload-status" id="status"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="upload.js"></script>
</body>
</html>