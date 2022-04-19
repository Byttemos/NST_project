<!DOCTYPE html>
<title>Results</title>
<head>
<script src="https://cdn.jsdelivr.net/npm/@magenta/image@^0.2.1"></script>
<style> 
    .center{
        text-align: center;
    }
</style>
</head>
<body>
    <div class="center">
    <img id="content" height="256" src="content" width="300" height="150"/>
    <img id="style" height="256" src="style" width="300" height="150"/>
    <canvas id="stylized" height="256"></canvas>
<?php

$target_dir = "./uploads/";

$uploadOk = 1;

if(isset($_POST["submit"])){
$checkimg = getimagesize($_FILES["content"]["tmp_name"]);
$checkstyle = getimagesize($_FILES["style"]["tmp_name"]);
if($checkimg !== false || $checkstyle !== false){
    
    $uploadOK = 1;
} else{
    echo "Files are not images.";
    $uploadOK = 0;
}
}
if($uploadOK == 1){
    move_uploaded_file($_FILES["content"]["tmp_name"], "content");
    move_uploaded_file($_FILES["style"]["tmp_name"], "style");
    
    sleep(15);
    $filesReady = false;
    #while($filesReady !== true){
        if(file_exists("content") !== false || file_exists("style" !== false)){
            echo "<br>";
            echo "Done! If the transformed image is either completely white or comepletely black, try a smaller image";
            echo "<br>";
            echo "images under 3000x3000 seems to work best.";
            $filesReady = true;
?>
    
    <script>
            const model = new mi.ArbitraryStyleTransferNetwork();
            const contentImg = document.getElementById('content');
            const styleImg = document.getElementById('style');
            const stylizedCanvas = document.getElementById('stylized');
    
            function stylize() {
              model.stylize(contentImg, styleImg).then((imageData) => {
                stylizedCanvas.getContext('2d').putImageData(imageData, 0, 0);
              });
            }
    
            model.initialize().then(stylize);
          </script>
    
    
<?php

    }else{
        $filesReady = false;

        }
   # }
    
    


}



#header("Location: https://hriskaer.dk/ai/index.html");
?>
</div>
</body>
</html>
