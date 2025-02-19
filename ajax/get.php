<?php

include('connectToDB.php');
$rs = $connection->query("SELECT * FROM `tbl_employee`");

while ($row = mysqli_fetch_assoc($rs)) {
    echo '
            <tr>
                    <td>'.$row['id'].'</td>
                    <td><img src="Image/'.$row['profile'].'" alt="" style="max-width: 120px;"></td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['phone_number'].'</td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Remove</button>
                    </td>
                </tr>
        ';
}
