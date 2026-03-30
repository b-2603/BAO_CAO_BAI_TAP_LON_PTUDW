function submit1(sp_id) {
    var anh = document.getElementById('mainImage').src;
    var baseUrl = window.location.origin;
    var relativePath = anh.replace(baseUrl + "/BAO%20CAO%20BAI%20TAP%20LON%20NHOM%2028/");
    var ten = document.getElementById('ten').textContent;
    var kichThuoc = document.getElementById("size-select-" + sp_id).value;
    var soLuong = document.getElementById("so_luong-" + sp_id).value;
    var giaSanPham = document.getElementById("gia_sp").textContent;
    var tongtien = document.getElementById("tong_tien-" + sp_id).textContent;
    var urlParams = new URLSearchParams(window.location.search);
    var id_user = urlParams.get('id_user');

    var formData = new FormData();
    formData.append('sp_id', sp_id);
    formData.append('mainImage', relativePath);
    formData.append('ten', ten);
    formData.append('kich_thuoc', kichThuoc);
    formData.append('so_luong', soLuong);
    formData.append('gia_san_pham', giaSanPham);
    formData.append('tong_tien', tongtien);

    fetch('../CLASS/Themspvaogio.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log("PHP trả về:", data);
        window.location.href = '../PHP/Bag.php?id_user=' + id_user;
    })
    .catch(err => {
        console.error("Lỗi fetch:", err);
    });
}
