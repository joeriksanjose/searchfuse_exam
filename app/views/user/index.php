<div class="col-md-12">
    <table class="table table-hover">
        <tr>
            <td colspan="4">
                <?php if ($action != "task") { ?>
                    <a href="<?php echo url("user/task", ["status" => $status, "since" => $last_week_datetime]) ?>">
                        Show pending tasks since last week
                    </a>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th>Task ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
        </tr>

        <?php foreach($tasks as $task) { ?>
            <tr>
                <td><?php echo $task["id"]; ?></td>
                <td><?php echo $task["title"]; ?></td>
                <td><?php echo $task["description"]; ?></td>
                <td><?php echo convert_status_to_string($task["status"]); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>