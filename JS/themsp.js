function submit1(sp_id) {
    var anh = document.getElementById('mainImage').src;
    var ten = document.getElementById('ten').textContent;
    var kichThuoc = document.getElementById("size-select-" + sp_id).value;
    var soLuong = document.getElementById("so_luong-" + sp_id).value;
    var giaSanPham = document.getElementById("gia_sp").textContent;
    var tongtien = document.getElementById("tong_tien-" + sp_id).textContent;

    var formData = new FormData();
    formData.append('sp_id', sp_id);
    formData.append('mainImage', anh);
    formData.append('ten', ten);
    formData.append('kich_thuoc', kichThuoc);
    formData.append('so_luong', soLuong);
    formData.append('gia_san_pham', giaSanPham);
    formData.append('tong_tien', tongtien);

    fetch('../CLASS/Themspvaogio.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.success) {
            window.location.href = '../PHP/Bag.php';
            return;
        }
        if (data && data.redirect) {
            window.location.href = data.redirect;
            return;
        }
        console.error("Lỗi thêm giỏ:", data);
    })
    .catch(err => {
        console.error("Lỗi fetch:", err);
    });
}
