<?php
// Include config file
require_once "includes\dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload A Resource</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Upload Resource</h2>
                    <p>Please fill this form and submit to add a resource file to the library.</p>
                    <form action="includes\resourceupload.inc.php" method="post" enctype ="multipart/form-data">
                        <div class="form-group">
                            <label>Type of File</label>
                            <input type="text" name="resourceType" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="resourceTitle" class="form-control">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="resourceDescription" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type ="file" name ="file">
                            <button type ="submit" name ="submit">UPLOAD</button>  
                            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>

                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>