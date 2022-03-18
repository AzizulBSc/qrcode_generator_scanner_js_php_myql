<?php
$connect = mysqli_connect('localhost', 'root', '', 'test');
if ($connect) {
    echo "<script>alert('connected')</script>";
} else {
    echo "<script>alert('Connection Failed')</script>";
}
$select_query = "SELECT * FROM students";
$data = mysqli_query($connect, $select_query);
if (isset($_POST['text'])) {
    $text = $_POST['text'];
    $insert_query = "INSERT INTO students (s_id,name) VALUES('$text','$text')";
    $connect =  mysqli_query($connect, $insert_query);
    if ($connect) {
        echo "<script>alert('Data sent Successfully')</script>";
    } else {
        echo "<script>alert('Data sent Failed')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
    <title>Qr_Code</title>
    <style>
        table,
        th,
        td {
            border: 1px solid red
        }
    </style>
</head>

<body>
    <div style="margin: 10% 20% ;" heigth="100%">
        <div heigth="50%">
            <video id="video" width="80%" width="80%" style="border-radius: 10%;"></video>
            <form method="POST" action="">
                <input type="text" id="text" name="text">
            </form>


        </div>
        <div style="color:aqua">
            <h2>Saved Data</h2>
            <table>
                <thead>
                    <td>SN</td>
                    <td>Name</td>
                    <td>Roll</td>
                    <td>Time</td>
                </thead>
                <tbody>
                    <?php
                    while ($student = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td><?php echo $student['id'] ?></td>
                            <td><?php echo $student['name'] ?></td>
                            <td><?php echo $student['s_id'] ?></td>
                            <td><?php echo $student['Time'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="instascan.min.js"></script>
    <script>
        //start camera
        var video = document.getElementById("video");
        var inputText = document.getElementById("text");
        var scanner = new Instascan.Scanner({
            video: video,
        })
        Instascan.Camera.getCameras().then(function(our_camera) {
            if (our_camera.length > 0) {
                scanner.start(our_camera[0]);
            } else {
                alert("Camera Star failed!")
            }
        }).catch(function(error) {
            alert('Function Failed!');
        })

        scanner.addListener('scan', function(input_value) {
            inputText.value = input_value;
            document.forms[0].submit();
        })
    </script>
</body>

</html>