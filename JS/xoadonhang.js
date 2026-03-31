function huyDonHang(dh_id) {
    if (confirm("Bạn có chắc muốn hủy đơn hàng này?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../CLASS/xoadonhang.php", true); 
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                window.location.reload(); 
            }
        };
        xhr.send("action=xoa_don_hang&dh_id=" + dh_id);
    }
}






