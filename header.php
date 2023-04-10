<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Online Exam Management System</title>

	    <!-- Custom styles for this page -->
	    <link href="vendor/bootstrap/bootstrap.min.css" rel="stylesheet">

	    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	    <!-- Custom styles for this page -->
    	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	    <link rel="stylesheet" type="text/css" href="vendor/parsley/parsley.css"/>
	    <link rel="stylesheet" type="text/css" href="vendor/TimeCircle/TimeCircles.css"/>
	    <style>
	    	.border-top { border-top: 1px solid #e5e5e5; }
			.border-bottom { border-bottom: 1px solid #e5e5e5; }

			.box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
	    </style>
	</head>
	<body style="background: url('img/cool-background.png'); background-repeat: no-repeat; background-size: cover">
		<?php
		if($object->is_student_login())
		{
		?>
                <div class="navbar navbar-expand-lg navbar-dark bg-success">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10">
                                <a class="navbar-brand" href="#">Online Examination System</a>
                            </div>
                            <div class="col-md-2 text-right">
                                <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                                    <ul class="navbar-nav mr-auto">
                                        <!--		      		<li class="nav-item active">-->
                                        <!--		        		<a class="nav-link" href="student_dashboard.php">Home</a>-->
                                        <!--		      		</li>-->
                                        <li class="nav-item active">
                                            <a class="nav-link" href="exam.php">Exam</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="logout.php">Logout</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>


                    </div>
                </div>

            <?php
		}
		else
		{
		?>
<!--		<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">-->
<!--		    <h5 class="my-0 mr-md-auto font-weight-normal">Online Exam Management System</h5>-->
<!--		    -->
<!--	    </div>-->

	    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
	      	<h1 class="display-4">Online Exam Management System</h1>
	    </div>
	    <br />
	    <br />
	    <?php
		}
	    ?>
	    <div class="container-fluid">