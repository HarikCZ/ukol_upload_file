<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
if ($_FILES){
        $target = "uploads/";
        $targetFile = $target . basename($_FILES['uploadedName']['name']);
        $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
        $uploadSuccess = true;

        if (file_exists($targetFile)){
            echo "Soubor již existuje";
            $uploadSuccess = false;
        }
        if ($_FILES['uploadedName']['name'] > 8000000){
            echo "Soubor je příliž velký ";
        }

        if ($_FILES['uploadedName']['error'] != 0){

            echo "Chyba při uploadu na server";
            $uploadSuccess = false;
        }

        $type = explode("/", $_FILES['uploadedName']['type'])[0];
        if (!$uploadSuccess){
            echo "Došlo k chybě uploadu";
        }else{
            if (move_uploaded_file($_FILES['uploadedName']['tmp_name'], $targetFile)){
                echo "Soubor ". basename( $_FILES['uploadedName']['name']) . "byl uložen";
                if ($type === "image"){
                    echo "<img src='$targetFile' width='50px' height='50px'/>";
                }
                elseif ($type === "video"){
                    echo "<video width='320' height='240' autoplay controls>
                            <source src='{$targetFile}' type='{$_FILES['uploadedName']['type']}'>
                        </video>";
                }

                elseif ($type === "audio"){
                    echo "<audio controls>
                                <source src='{$targetFile}' type='{$_FILES['uploadedName']['type']}'>
                            </audio>";
                }
            }else{
                echo "Došlo k chybě uploadu";
            }
        }
}
?>
    <form method="post" action="", enctype="multipart/form-data"><div>
            Select image to upload.
            <input type="file", name="uploadedName" accept="[image/]"/>
            <input type="submit", value="Nahrát", name="submit">
        </div></form>
</body>
</html>
<?php
