<?php 
    $task_list = filter_input(INPUT_POST,"tasklist", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

    if ($task_list === null) {
        $task_list = array();
    }

    $action = filter_input(INPUT_POST,"action");
    $errors = array();

    switch ($action) {
        case "add":
            $new_task = filter_input(INPUT_POST,"task");
            if (empty($new_task)) {
                $errors[] = 'The new task cannot be empty'; 
            } else {
                $task_list[] = $new_task;
            }
            break;
        case 'delete':
            $task_index = filter_input(INPUT_POST,'taskid', FILTER_VALIDATE_INT);
            if ($task_index === null) {
                $errors[] = 'The task cannot be deleted';
            } else {
                unset($task_list[$task_index]);
                $task_list = array_values($task_list);
            }
            break;
    }

    include('task_list.php');
?>