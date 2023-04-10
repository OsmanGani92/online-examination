<?php
include('soes.php');

$object = new soes();

if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch_course_wise_exam_data') {
        $object->query = "SELECT exam_title, subject_total_question, marks_per_right_answer, class_name, COUNT(student_to_class_soes.class_id) as total_student
        FROM exam_soes 
        JOIN subject_wise_exam_detail
        ON exam_soes.exam_id = subject_wise_exam_detail.exam_id
        JOIN class_soes
        ON exam_soes.exam_class_id = class_soes.class_id
        JOIN student_to_class_soes
        ON student_to_class_soes.class_id = class_soes.class_id
        WHERE subject_wise_exam_detail.subject_id = '" . $_POST["course_id"] . "'
        GROUP BY exam_soes.exam_title
        ";

        $result = $object->get_result();
        $data = array();
        $html = '';
        foreach ($result as $row) {
            $data['total_marks'] = $row['subject_total_question'] * $row['marks_per_right_answer'];
            $html .= '<tr>
                        <td>' . $row["exam_title"] . '</td>
                        <td>' . $row["class_name"] . '</td>
                        <td>' . $row["total_student"] . '</td>
                        <td>' . $row["subject_total_question"] . '</td>
                        <td>' . $data["total_marks"] . '</td>
                       </tr>';
        }

        echo json_encode(['tableData' => $html]);
    }

    if ($_POST["action"] == 'class_wise_examine') {
        $object->query = "SELECT class_name, COUNT(student_to_class_soes.class_id) as total_examine
            FROM class_soes
            JOIN student_to_class_soes
            ON class_soes.class_id = student_to_class_soes.class_id
            GROUP BY student_to_class_soes.class_id";
        $result = $object->get_result();
        $data = [['Class Name', 'Total Examinees']];
        foreach ($result as $row) {
            $data[] = [$row['class_name'], (int)$row['total_examine']];
        }

        echo json_encode($data);
    }

    if ($_POST["action"] == 'fetch_status_wise_exam') {
        $object->query = "SELECT exam_title, exam_status, COUNT(exam_status) as total_exams FROM `exam_soes` 
        GROUP BY exam_status";
        $result = $object->get_result();
        $data = [['Exam Status', 'Count']];
        foreach ($result as $row) {
            $data[] = [$row['exam_status'], $row['total_exams']];
        }

        echo json_encode($data);
    }
}