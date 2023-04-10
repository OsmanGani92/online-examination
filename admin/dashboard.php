<?php

include('soes.php');

$object = new soes();

if (!$object->is_login()) {
    header("location:" . $object->base_url . "");
}

if (!$object->is_master_user()) {
    header("location:" . $object->base_url . "admin/result.php");
}

include('header.php');

// Table chart select data
$object->query = "
                    SELECT * FROM subject_soes 
                    WHERE subject_status = 'Enable' 
                    ORDER BY subject_name ASC
                    ";
$courses = $object->get_result();
?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<!-- Content Row -->
<div class="row row-cols-5">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col mb-4">
        <div class="card border-left-primary shadow bg-gradient-dark text-white h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Today Result Publish
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $object->Get_total_result(); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col mb-4">
        <div class="card border-left-primary shadow bg-gradient-dark text-white h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Exam
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $object->Get_total_exam(); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-edit fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col mb-4">
        <div class="card border-left-primary shadow bg-gradient-dark text-white h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Examinee
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold"><?php echo $object->Get_total_student(); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col mb-4">
        <div class="card border-left-primary shadow bg-gradient-dark text-white h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Course
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $object->Get_total_subject(); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card border-left-primary bg-gradient-dark text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Classes
                        </div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $object->Get_total_classes(); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-door-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-dark text-white">
                <strong>Course Wise Exam Details</strong>
            </div>
            <div class="card-body">
                <div class="row form-group">
                    <label for="course_id" class="col-md-2">Select Course :</label>
                    <div class="col-md-4">
                        <select name="course_id" class="form-control course_id" id="course_id">
                            <?php
                            foreach ($courses as $key => $row) {
                                echo '<option value="' . $row["subject_id"] . '">' . $row["subject_name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row form-group table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Exam Name</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Total Examine</th>
                            <th scope="col">Total Questions</th>
                            <th scope="col">Total Marks</th>
                        </tr>
                        </thead>
                        <tbody id="chart_table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-gradient-dark text-white">
                <strong>Class Wise Examinees</strong>
            </div>
            <div class="card-body">
                <div id="columnChart" style="width: 100%; height: 450px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-gradient-dark text-white">
                <strong>Status Wise Exams</strong>
            </div>
            <div class="card-body">
                <div id="piechart" style="width: 100%; height: 450px;"></div>
            </div>
        </div>
    </div>
</div>
<br>
<?php
include('footer.php');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $(document).ready(function () {
        $('.course_id').trigger('change');
        getClassWiseExaminees();
        getStatusWiseExams()
    })

    $(document).on('change', '.course_id', function () {

        var course_id = $(this).val();

        $.ajax({

            url: "ChartController.php",

            method: "POST",

            data: {course_id: course_id, action: 'fetch_course_wise_exam_data'},

            dataType: 'JSON',

            success: function (response) {
                $('#chart_table').html(response.tableData);
            }

        })

    });

    function getClassWiseExaminees() {
        $.ajax({

            url: "ChartController.php",

            method: "POST",

            data: {action: 'class_wise_examine'},

            dataType: 'JSON',

            success: function (response) {
                console.log(response)
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable(
                        response
                    );


                    var chart = new google.visualization.ColumnChart(document.getElementById('columnChart'));

                    chart.draw(data);
                }
            }

        })
    }

    function getStatusWiseExams() {
        $.ajax({

            url: "ChartController.php",

            method: "POST",

            data: {action: 'fetch_status_wise_exam'},

            dataType: 'JSON',

            success: function (response) {
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable(
                        response
                    );

                    var options = {
                        pieHole: 0.4,
                        chartArea: {
                            left: 40,
                            top: 10,
                            width: "100%",
                            height: "100%"
                        },
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
            }

        })
    }
</script>
