<?php
session_start();
error_reporting(0);
include 'userregdb.php';
if (strlen($_SESSION['username'] == 0)) {
    header('location:logout.php');
} else {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Update Application</title>
        <link rel="manifest" href="./manifest.json">
        <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/application-form.css">
        <link rel="stylesheet" href="./assets/css/vanilla-zoom.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <script src="./assets/js/new-app.js"></script>
    </head>

    <body>
        <?php
        include './database_connect.php';
        if (isset($_GET['app_id'])) {
            $apid = $_GET['app_id'];

            $idd = "SELECT userID FROM appid WHERE ApplicationID=$apid";
            $result1 = mysqli_query($con, $idd);
            if ($result1) {
                if ($row1 = mysqli_fetch_assoc($result1)) {
                    $id = $row1['userID'];

                    $query = "SELECT * FROM info_of_child ch, appid ap, place_of_birth pob, fathers_info finfo, mothers_info minfo, permanent_addr peraddr, informants_info inf, other_info oth WHERE ch.id=$id AND ap.userID=$id AND pob.id=$id AND finfo.id=$id AND minfo.id=$id AND peraddr.id=$id AND inf.id=$id AND oth.id=$id";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
        ?>
                            <!-- Start: Application Form -->
                            <section>
                                <h1 class="text-center" style="font-family:Cormorant Garamond, serif; font-size:30px">Application form</h1><br>
                                <div class="container">
                                    <form id="application-form" method="POST" enctype="multipart/form-data" name="appForm">
                                        <!-- Information of Child -->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Information of Child</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p><strong>First Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="fname" value="<?php echo $row['firstname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Middle Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="mname" value="<?php echo $row['midname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Last Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="lname" value="<?php echo $row['lastname'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p><strong>Date Of Birth</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="date" required="" name="dob" value="<?php echo $row['dob'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Gender</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <select class="shadow-sm form-select" style="font-family:Roboto, sans-serif;" name="gender">
                                                            <option style="display:none"></option>
                                                            <option value="Male" <?php if ($row['gender'] == "Male") echo 'selected = "selected"'; ?>>Male</option>
                                                            <option value="Female" <?php if ($row['gender'] == "Female") echo 'selected = "selected"'; ?>>Female</option>
                                                            <option value="Transgender" <?php if ($row['gender'] == "Transgender") echo 'selected = "selected"'; ?>>Transgender</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>Aadhar Number (if any)</strong>&nbsp;</p><input class="shadow-sm form-control" type="number" required="no" name="aadhar" value="<?php echo $row['aadhar'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>Weight(kg)</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="number" step=".01" required="" name="cweight" value="<?php echo $row['cweight'] ?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <br />

                                        <!-- Birth Place Information -->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Place of Birth</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p><strong>Place of Birth&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <select class="shadow-sm form-select flex-grow-1" style="font-family:Roboto, sans-serif;" name="pob">
                                                            <option style="display:none"></option>
                                                            <option value="House" <?php if ($row['pob'] == "House") echo 'selected = "selected"'; ?>>House</option>
                                                            <option value="Other" <?php if ($row['pob'] == "Other") echo 'selected = "selected"'; ?>>Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p><strong>Bldg. No. &amp; Name&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <textarea class="shadow-sm form-control" required="" name="pobblg" rows="3" cols="5"> <?php echo $row['bldg_no_name'] ?></textarea>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>House No.&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <textarea class="shadow-sm form-control" required="" name="pobhouse" rows="3" cols="5"> <?php echo $row['house_no'] ?></textarea>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>Street/Lane Name&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <textarea class="shadow-sm form-control" required="" name="pobstreet" rows="3" cols="5"><?php echo $row['street_lane'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Locality/Post Office&nbsp;</strong>
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <textarea class="shadow-sm form-control" required="" name="pobpost" rows="3" cols="5"></textarea>
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>State</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="text" required="" style="font-family:Roboto, sans-serif;" id="state" name="pstate" value="<?php echo $row['pstate'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>District</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="text" required="" name="pobdistr" value="<?php echo $row['district'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Village/Town</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>

                                                        <input class="shadow-sm form-control" type="text" required="" style="font-family:Roboto, sans-serif;" id="city" name="pobvillage" value="<?php echo $row['village_town'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">

                                                        <p><strong>Pin Code&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="pobpin" value="<?php echo $row['pincode'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br />

                                        <!-- Fathers information-->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Fathers Information</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="checkbox" name="fcheck" value="single parent" onclick="checkSingleF()">
                                                        <label for="single parent">Please check if you are Single Parent</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p><strong>First Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="fthfname" value="<?php echo $row['fname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Middle Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="fthmname" value="<?php echo $row['fmname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Last Name</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" required="" name="fthlname" value="<?php echo $row['flname'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p>
                                                            <strong>Aadhar Number</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="number" name="faadhar" max=999999999999 required value="<?php echo $row['faadhar'] ?>" />
                                                    </div>
                                                    <div class="col">
                                                        <p>
                                                            <strong>Email Id</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="email" name="femail" required value="<?php echo $row['femail'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Mobile</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="number" name="fmobile" required="" value="<?php echo $row['fmobile'] ?>" />
                                                        <p class="text-danger" style="font-family:monospace; font-size:15px;">(P.S. Enter the Mobile Number which is registered in your Aadhar Card)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p>
                                                            <strong>Religion</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" name="freligion" required value="<?php echo $row['freligion'] ?>" />
                                                    </div>
                                                    <div class="col">
                                                        <p>
                                                            <strong>Occupation</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" name="foccup" required value="<?php echo $row['foccup'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Education</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" name="feducate" required="" value="<?php echo $row['feducate'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <!--Mothers Information -->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Mothers Information</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="checkbox" name="mcheck" value="single parent" onclick="checkSingleM()">
                                                        <label for="single parent">Please check if you are Single Parent</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p><strong>First Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="mthfname" value="<?php echo $row['mfname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Middle Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="mthmname" value="<?php echo $row['mmidname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Last Name</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" required="" name="mthlname" value="<?php echo $row['mlname'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p>
                                                            <strong>Aadhar Number</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="number" name="maadhar" max=999999999999 required="" value="<?php echo $row['maadhar'] ?>" />
                                                    </div>
                                                    <div class="col">
                                                        <p>
                                                            <strong>Email Id</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="email" name="memail" required="" value="<?php echo $row['memail'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Mobile</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="number" name="mmobile" required="" value="<?php echo $row['mmobile'] ?>" />
                                                        <p class="text-danger" style="font-family:monospace; font-size:15px;">(P.S. Enter the Mobile Number which is registered in your Aadhar Card)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p>
                                                            <strong>Religion</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" name="mreligion" required value="<?php echo $row['mreligion'] ?>" />
                                                    </div>
                                                    <div class="col">
                                                        <p>
                                                            <strong>Occupation</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" name="moccup" required value="<?php echo $row['moccup'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Education</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" name="meducate" required="" value="<?php echo $row['meducate'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <!--Address of Parents at the time of Birth of the Child -->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Address of Parents at the time of Birth of the Child</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="radio" name="place" value="In India" required>
                                                        <label for="in india">In India </label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="radio" name="place" value="Outside India" required>
                                                        <label for="outside india">Outside India </label>
                                                    </div>
                                                    <div class="col"></div>
                                                </div><br>
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p><strong>Bldg. No. &amp; Name&nbsp;</strong><span class="text-danger">*</span></p>
                                                            <textarea class="shadow-sm form-control" required="" name="bchbldg" rows="3" cols="5"><?php echo $row['perbldg'] ?></textarea>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p><strong>House No.&nbsp;</strong><span class="text-danger">*</span></p>
                                                            <textarea class="shadow-sm form-control" required="" name="bchhouse" rows="3" cols="5"><?php echo $row['perhouse'] ?></textarea>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p><strong>Street/Lane Name&nbsp;</strong><span class="text-danger">*</span></p>
                                                            <textarea class="shadow-sm form-control" required="" name="bchstreet" rows="3" cols="5"><?php echo $row['perstreet'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Locality/Post Office&nbsp;</strong>
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <textarea class="shadow-sm form-control" required="" name="bchlocal" rows="3" cols="5"></textarea>
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>State</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="text" required="" style="font-family:Roboto, sans-serif;" id="state" name="bpstate" value="<?php echo $row['perstate'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>District</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="text" required="" name="bchdistr" value="<?php echo $row['perdistr'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Village/Town</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" required="" style="font-family:Roboto, sans-serif;" id="city" name="bchvillage" value="<?php echo $row['pervillage'] ?>">

                                                    </div>
                                                    <div class="col-lg-4">

                                                        <p><strong>Pin Code&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="bchpin" value="<?php echo $row['perpin'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <!--Permanent Address of Parents -->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Permanent Address of Parents</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="radio" name="place1" value="In India" required="">
                                                        <label for="in india">In India </label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="radio" name="place1" value="Outside India" required="">
                                                        <label for="outside india">Outside India </label>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col">
                                                        <!-- <input type="checkbox" name="check" value="check permanent address"> -->
                                                        <input type="checkbox" name="checkAddr" value="check permanent address" onclick="sameAddress()">
                                                        <label for="check permanent address">Please check if permanent address is same as above address</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group mb-3">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p><strong>Bldg. No. &amp; Name&nbsp;</strong><span class="text-danger">*</span></p>
                                                            <textarea class="shadow-sm form-control" required="" name="perbldg" rows="3" cols="5"><?php echo $row['perbldg'] ?></textarea>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p><strong>House No.&nbsp;</strong><span class="text-danger">*</span></p>
                                                            <textarea class="shadow-sm form-control" required="" name="perhouse" rows="3" cols="5"><?php echo $row['perhouse'] ?></textarea>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p><strong>Street/Lane Name&nbsp;</strong><span class="text-danger">*</span></p>
                                                            <textarea class="shadow-sm form-control" required="" name="perstreet" rows="3" cols="5"><?php echo $row['perstreet'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Locality/Post Office&nbsp;</strong>
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <textarea class="shadow-sm form-control" required="" name="perlocal" rows="3" cols="5"><?php echo $row['perlocal'] ?></textarea>
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>State</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="text" required="" style="font-family:Roboto, sans-serif;" id="state" name="pstate" value="<?php echo $row['perstate'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>District</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="text" name="perdistr" required="" value="<?php echo $row['perdistr'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Village/Town</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" required="" style="font-family:Roboto, sans-serif;" id="city" name="pvilage" value="<?php echo $row['pervillage'] ?>" />

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>Pin Code&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="perpin" value="<?php echo $row['perpin'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <!--Informants Information -->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Informants Information</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p><strong>First Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="inffname" value="<?php echo $row['inffname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Middle Name</strong>&nbsp;<span class="text-danger">*</span></p><input class="shadow-sm form-control" type="text" required="" name="infmname" value="<?php echo $row['infmname'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Last Name</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="text" required="" name="inflname" value="<?php echo $row['inflname'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p><strong>Address</strong><span class="text-danger">*</span></p>
                                                        <textarea class="shadow-sm form-control" required="" name="infaddress" rows="3" cols="5"><?php echo $row['infaddress'] ?></textarea>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>Pin Code&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="infpin" value="<?php echo $row['infpin'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p>
                                                            <strong>Mobile</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="infmobile" value="<?php echo $row['infmobile'] ?>" />
                                                        <p class="text-danger" style="font-family:monospace; font-size:15px;">(P.S. Enter the Mobile Number which is registered in your Aadhar Card)</p>
                                                    </div><br>
                                                    <div class="col-lg-4">
                                                        <p><strong>Reporting Date</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="date" required="" name="reportdate" value="<?php echo $row['reportdate'] ?>">
                                                    </div>
                                                    <div class="col">
                                                        <p>
                                                            <strong>Email Id</strong>&nbsp;
                                                            <span class="text-danger">*</span>
                                                        </p>
                                                        <input class="shadow-sm form-control" type="email" name="impemail" required="" value="<?php echo $row['PrimaryEmail'] ?>">
                                                        <p class="text-danger" style="font-family:monospace; font-size:15px;">(P.S. Enter the Email ID on which we should notify)</p>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <!--Other Information -->
                                        <div class="form-section">
                                            <div class="section-head">
                                                <h4>Other Information</h4>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p><strong>Age of Mother at Time of Birth&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="ageofmth" value="<?php echo $row['mage'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>Number of Child Born Alive&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="numchildborn" value="<?php echo $row['chborn'] ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p><strong>Duration of Pregnancy(weeks)&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="number" required="" name="durapreg">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p><strong>Delivery Method&nbsp;</strong><span class="text-danger">*</span></p>
                                                        <select class="shadow-sm form-select" style="font-family:Roboto, sans-serif;" name="delmeth">
                                                            <option style="display:none"></option>
                                                            <option value="Normal Delivery" <?php if ($row['delmeth'] == "Normal Delivery") echo 'selected = "selected"'; ?>>Normal Delivery</option>
                                                            <option value="Caesaren Delivery(C-Section)" <?php if ($row['delmeth'] == "Caesaren Delivery(C-Section") echo 'selected = "selected"'; ?>>Caesaren Delivery(C-Section)</option>
                                                            <option value="Water Birth" <?php if ($row['delmeth'] == "Water Delivery") echo 'selected = "selected"'; ?>>Water Birth</option>
                                                            <option value="Scheduled Induction Birth" <?php if ($row['delmeth'] == "Scheduled Induction Birth") echo 'selected = "selected"'; ?>>Scheduled Induction Birth</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Type of Attention at Delivery</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <select class="shadow-sm form-select" style="font-family:Roboto, sans-serif;" name="attendel">
                                                            <optgroup label="Type of Attention at Delivery">
                                                                <option style="display:none"></option>
                                                                <option value="Institutional-Government">Institutional-Government</option>
                                                                <option value="Institutional-Private/Non-Government">Institutional-Private/Non-Government</option>
                                                                <option value="Doctor,Nurse or Trained Midwife">Doctor,Nurse or Trained Midwife</option>
                                                                <option value="Traditional Birth Attendant">Traditional Birth Attendant</option>
                                                                <option value="Relatives or Other">Relatives or Other</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <p><strong>Aadhar Document(pdf file)</strong>&nbsp;<span class="text-danger">*</span></p>
                                                        <input class="shadow-sm form-control" type="file" required="" name="aadharproof" accept=".png,.jpg,.pdf" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p>
                                                            <strong>Affidavit Document (pdf file) (optional)</strong>&nbsp;
                                                        </p>
                                                        <input class="shadow-sm form-control" type="file" name="affproof">
                                                        <p class="text-danger" style="font-family:monospace; font-size:15px;">(P.S. Applying a year after child's birth? Attach the affiduvate doc stating the reason behind delay. If not done so, your application will be rejected)
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br /><br />

                                        <div class="justify-content-center d-flex form-group mb-3">
                                            <div id="submit-btn">
                                                <div class="row">
                                                    <button class="btn btn-primary btn-light m-0 rounded-pill px-4" name="submit" style="min-width:200px; background-color:black; color:white;" action method="POST" target="hidden_iframe">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </section>
                        <?php
                        }

                        if (isset($_POST['submit'])) {
                            //information of child
                            $firstname = $_POST['fname'];
                            $midname = $_POST['mname'];
                            $lastname = $_POST['lname'];
                            $gender = $_POST['gender'];
                            $dob = $_POST['dob'];
                            $weight = $_POST['cweight'];
                            $aadhar = $_POST['aadhar'];
                            //place of birth
                            $pob = $_POST['pob'];
                            $bldg_no_name = $_POST['pobblg'];
                            $house_no = $_POST['pobhouse'];
                            $street_lane = $_POST['pobstreet'];
                            $pstate = $_POST['pstate'];
                            $district = $_POST['pobdistr'];
                            $village_town = $_POST['pobvillage'];
                            $pincode = $_POST['pobpin'];
                            //fathers information
                            $fname = $_POST['fthfname'];
                            $fmname = $_POST['fthmname'];
                            $flname = $_POST['fthlname'];
                            $faadhar = $_POST['faadhar'];
                            $femail = $_POST['femail'];
                            $fmobile = $_POST['fmobile'];
                            $freligion = $_POST['freligion'];
                            $foccup = $_POST['foccup'];
                            $feducate = $_POST['feducate'];
                            //mothers information
                            $mname = $_POST['mthfname'];
                            $mmidname = $_POST['mthmname'];
                            $mlname = $_POST['mthlname'];
                            $maadhar = $_POST['maadhar'];
                            $memail = $_POST['memail'];
                            $mmobile = $_POST['mmobile'];
                            $mreligion = $_POST['mreligion'];
                            $moccup = $_POST['moccup'];
                            $meducate = $_POST['meducate'];
                            //permanent address
                            $place = $_POST['place1'];
                            $perbldg = $_POST['perbldg'];
                            $perhouse = $_POST['perhouse'];
                            $perstreet = $_POST['perstreet'];
                            $perlocal = $_POST['perlocal'];
                            $perstate = $_POST['pstate'];
                            $perdistr = $_POST['perdistr'];
                            $pervillage = $_POST['pvilage'];
                            $perpin = $_POST['perpin'];
                            //informants information
                            $inffname = $_POST['inffname'];
                            $infmname = $_POST['infmname'];
                            $inflname = $_POST['inflname'];
                            $infaddress = $_POST['infaddress'];
                            $infpin = $_POST['infpin'];
                            $infmobile = $_POST['infmobile'];
                            $reportdate = $_POST['reportdate'];
                            $impemail = $_POST['impemail'];
                            //other information
                            $mage = $_POST['ageofmth'];
                            $chborn = $_POST['numchildborn'];
                            $delmeth = $_POST['delmeth'];

                            // $conn = mysqli_connect('localhost', 'root', '', 'example');
                            // if (isset($_POST['submit'])) {
                            $fileName = $_FILES['aadharproof']['name'];
                            $fileTmpName = $_FILES['aadharproof']['tmp_name'];
                            $path1 = "../aadharproof/" . $fileName;
                            move_uploaded_file($fileTmpName, $path1);

                            $afdFileName = $_FILES['affproof']['name'];
                            $afdFileTmpName = $_FILES['affproof']['tmp_name'];
                            $path2 = "../affproof/" . $afdFileName;
                            move_uploaded_file($afdFileTmpName, $path2);

                            $uid = intval($id);
                            $query1 = mysqli_query($con, "UPDATE info_of_child SET firstname='$firstname',midname='$midname',lastname='$lastname',dob='$dob',gender='$gender',cweight=$weight,aadhar=$aadhar WHERE id=$uid");
                            $query2 = mysqli_query($con, "UPDATE place_of_birth SET pob='$pob',bldg_no_name='$bldg_no_name',house_no='$house_no',street_lane='$street_lane',pstate='$pstate',district='$district',village_town='$village_town',pincode=$pincode WHERE id=$uid");
                            $query3 = mysqli_query($con, "UPDATE fathers_info SET fname='$fname',fmname='$fmname',flname='$flname',faadhar=$faadhar,femail='$femail',fmobile=$fmobile,freligion='$freligion',foccup='$foccup',feducate='$feducate' WHERE id=$uid");
                            $query4 = mysqli_query($con, "UPDATE mothers_info SET mfname='$mname',mmidname='$mmidname',mlname=,'$mlname'maadhar=$maadhar,memail='$memail',mmobile=$mmobile,mreligion='$mreligion',moccup='$moccup',meducate='$meducate' WHERE id=$uid");
                            $query5 = mysqli_query($con, "UPDATE permanent_addr SET place='$place',perbldg='$perbldg',perhouse='$perhouse',perstreet='$perstreet',perlocal='$perlocal',perstate='$perstate',perdistr='$perdistr',pervillage='$pervillage',perpin=$perpin) WHERE id=$uid");
                            $query6 = mysqli_query($con, "UPDATE informants_info SET inffname='$inffname',infmname='$infmname',inflname='$inflname',infaddress='$infaddress',infpin=$infpin,infmobile=$infmobile,reportdate='$reportdate',PrimaryEmail='$impemail') WHERE id=$uid");
                            $query7 = mysqli_query($con, "UPDATE other_info SET mage=$mage,chborn='$chborn',delmeth='$delmeth',aadharproof='$fileName',affproof='$afdFileName' WHERE id=$uid");
                            $query8 = mysqli_query($con, "UPDATE appid SET status='Pending' WHERE userID=$uid");

                            // If none of the queries run then error
                            if ((!$query1) && (!$query2) && (!$query3) && (!$query4) && (!$query5) && (!$query6) && (!$query7) && (!$query8)) {
                                echo '<script type="text/javascript">
                                        alert("Error");
                                    </script>';
                            } else {
                                echo '<script type="text/javascript">
                                alert("\nRecord Updated Successfully\nWait for the Admin to Verify the Details\nYou will be notified the same");
                                window.location.replace("./index.php")
                                </script>';
                            }
                        }
                        ?>
        <?php }
                }
            }
        }

        ?>
        <!-- End: Application Form -->
        <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="./assets/js/vanilla-zoom.js"></script>
        <script src="./assets/js/theme.js"> </script>
        <script src="./assets/js/new-app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    </body>

    </html>
<?php } ?>