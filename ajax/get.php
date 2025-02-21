<?php

include('connectToDB.php');
$rs = $connection->query("SELECT * FROM `tbl_employee`");

while ($row = mysqli_fetch_assoc($rs)) {
    echo '
            <tr>
                    <td>'.$row['id'].'</td>
                    <td><img src="Image/'.$row['profile'].'" alt="'.$row['profile'].'" style="max-width: 120px;"></td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['phone_number'].'</td>
                    <td>
                        <button id="btn-open-update" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        <button class="btn btn-danger">Remove</button>
                    </td>
                </tr>
        ';
}
