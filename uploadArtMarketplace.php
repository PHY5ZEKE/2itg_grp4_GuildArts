<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Upload Post</title>
        <meta charset="utf-8">
		<title>Upload Post</title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		<link href="css\uploadStyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link href="css\crudeStyle.css" rel="stylesheet" type="text/css">
	</head>

<body>
<div class ="gallery-upload">
    <div class="wrapper">
        <div class="col-md-12">
            <form action="includes/artmarketplaceupload.inc.php" method="post" enctype="multipart/form-data">
                <h1 class="mt-5 mb-3">Upload</h1>
                <label>Art Title</label>
                <input type="text" name="titleArt" placeholder="Art Title..." required>
                <label>Art Description</label>
                <input type="text" name="descArt" placeholder="Art Description..." required>
                <label>Art Price in PHP *number only*</label>
                <input type="text" name="priceArt" placeholder="Art Price in PHP..." required>
                <label>Contact Email</label>
                <input type="text" name="email" placeholder="Email..." required>
                <label>Contact number/social media</label>
                <input type="text" name="contactNum" placeholder="Contact..." required>
                <span class="error-message">
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] === 'invalid_price') {
                        echo "Price should be greater than 0";
                    }
                    ?>
                </span>
                <input type="file" name="file">
                <p><button type="submit" name="submit" style="background-color:#A65A28;">Upload</button></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
