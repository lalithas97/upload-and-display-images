<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>How to upload Image file using AJAX and jQuery</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="jquery-3.3.1.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){

            $("#but_upload").click(function(){

                var fd = new FormData();

                var files = $('#file')[0].files;

                // Check file selected or not
                if(files.length > 0 ){

                    fd.append('file',files[0]);

                    $.ajax({
                        url:'upload.php',
                        type:'post',
                        data:fd,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            if(response != 0){
                                
                                $("#img").attr("src",response);
                                $('.preview img').show();
                                alert('Uploaded Successfully');
                                
                            }else{
                                alert('File not uploaded');
                            }
                        }
                    });
                }else{
                    alert("Please select a file.");
                }
            });
        });

    </script>

</head>
<body>
    <div class="container">
        <form method="post" action="" enctype="multipart/form-data" id="myform">
            
            <div >
                <input type="file" id="file" name="file" />
                <input type="button" class="button" value="Upload" id="but_upload">
            </div>
        </form>
        <?php $id = 1;?>
        <table border="1" width="300" height="100">
            <tr>
                <td>id</td>
                <td>image</td>
            </tr>
        <?php 
        include "db.php";
        $sel = mysql_query("select * from imgup") or die(mysql_error());
        while($res = mysql_fetch_object($sel)){
        ?>
           <tr>
               <td><?php echo $id;?></td>
               <td>
                    <div class='preview'>
                        <img src="<?php $sel->img_id?>" id="img" width="100" height="100">
                    </div>
                </td>
            </tr>
        <?php
            $id++;
        }?>;
        </table>
    </div>
</body>
</html>