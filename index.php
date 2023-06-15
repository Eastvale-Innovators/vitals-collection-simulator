<?php

    require_once('init.php');

    $TelemedDB = db_connect();

    $sql = 'SELECT * FROM vitals1';
    $result = mysqli_query($TelemedDB, $sql);
    confirm_result_set($result);

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        $oxSat = $_POST['02sat'];
        $heartRate = $_POST['heartrate'];
        $bloodPressure = $_POST['BP'];
        $temp = $_POST['Temp'];
        $ekg = $_POST['EKG'];

        $sql1 = "INSERT INTO vitals1 (02sat, heartrate, BP, Temp, EKG) VALUES (";
        $sql1 .= "'" . db_escape($TelemedDB, $oxSat) . "',";
        $sql1 .= "'" . db_escape($TelemedDB, $heartRate) . "',";
        $sql1 .= "'" . db_escape($TelemedDB, $bloodPressure) . "',";
        $sql1 .= "'" . db_escape($TelemedDB, $temp) . "',";
        $sql1 .= "'" . db_escape($TelemedDB, $ekg) . "')";

        $result1 = mysqli_query($TelemedDB, $sql1);
        confirm_result_set($result1);
        header("Location: index.php");

    }

?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Vitals Uploader</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>

    <body style="background-color: rgb(224, 97, 88);">



        <div class="container-fluid">

            <div class="h1 mt-5 text-light text-center">Vitals Uploader Simulator 🏥</div>

            <form action="index.php" method="POST" class="w-75 ps-5 pe-5 mt-3" style="margin: auto; background-color: white; border-radius: 8px;">

                <div class="pt-2 pb-2">
                    <label for="02sat" class="text-light pb-2 text-dark"><b>02 Saturation</b></label>
                    <input type="text" class="form-control-lg form-control" id="02sat" name="02sat" placeholder="Enter 02 Saturation">
                </div>

                <div class="pt-2 pb-2">
                    <label for="heartrate" class="text-light pb-2 text-dark"><b>Heart Rate</b></label>
                    <input type="text" class="form-control-lg form-control" id="heartrate" name="heartrate" placeholder="Enter Heart Rate">
                </div>

                <div class="pt-2 pb-2">
                    <label for="BP" class="text-light pb-2 text-dark"><b>Blood Pressure</b></label>
                    <input type="text" class="form-control-lg form-control" id="BP" name="BP" placeholder="Enter Blood Pressure">
                </div>

                <div class="pt-2 pb-2">
                    <label for="Temp" class="text-light pb-2 text-dark"><b>Temperature</b></label>
                    <input type="text" class="form-control-lg form-control" id="Temp" name="Temp" placeholder="Enter Temperature">
                </div>

                <div class="pt-2 pb-2">
                    <label for="EKG" class="text-light pb-2 text-dark"><b>EKG</b></label>
                    <input type="text" class="form-control-lg form-control" id="EKG" name="EKG" placeholder="Enter EKG">
                </div>

                <button type="submit" class="btn btn-lg btn-primary mt-3 mb-3">Upload</button>

            </form>

            <div class="h1 mt-5 text-light text-center">Vitals SQL Data Table</div>

            <div class="table-responsive">

                <table style="margin: auto;" class="table w-75 bg-light mb-5">

                    <thead>

                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">02sat</th>
                            <th scope="col">heartrate</th>
                            <th scope="col">BP</th>
                            <th scope="col">Temp</th>
                            <th scope="col">EKG</th>
                            <th scope="col">Timestamp</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while($vital = mysqli_fetch_assoc($result)) { ?>

                            <tr>
                                <th scope="row"><?php echo $vital['id']; ?></th>
                                <td><?php echo $vital['02sat']; ?></td>
                                <td><?php echo $vital['heartrate']; ?></td>
                                <td><?php echo $vital['BP']; ?></td>
                                <td><?php echo $vital['Temp']; ?></td>
                                <td><?php echo $vital['EKG']; ?></td>
                                <td><?php echo $vital['Timestamp']; ?></td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>


        </div>


    </body>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</html>