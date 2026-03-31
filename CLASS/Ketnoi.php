<?php
class tmdt
{
    public function ketnoi()
    {
        $con = mysqli_connect("localhost", "root", "", "baitaplon");

        if (!$con) {
            echo "Lỗi kết nối: " . mysqli_connect_error();
            exit();
        }

        mysqli_set_charset($con, "utf8");
        return $con;
    }
}
?>
