function submit1(sp_id) {
    var mainImageEl = document.getElementById('mainImage');
    var tenEl = document.getElementById('ten');
    var sizeEl = document.getElementById("size-select-" + sp_id);
    var soLuongEl = document.getElementById("so_luong-" + sp_id);
    var giaSpEl = document.getElementById("gia_sp");
    var tongTienEl = document.getElementById("tong_tien-" + sp_id);

    if (!mainImageEl || !tenEl || !sizeEl || !soLuongEl || !giaSpEl || !tongTienEl) {
        alert("Không thể thêm vào giỏ hàng. Vui lòng tải lại trang.");
        console.error("Thiếu phần tử cần thiết để thêm giỏ:", {
            mainImageEl,
            tenEl,
            sizeEl,
            soLuongEl,
            giaSpEl,
            tongTienEl
        });
        return;
    }

    var anh = mainImageEl.src;
    var ten = tenEl.textContent;
    var kichThuoc = sizeEl.value;
    var soLuong = soLuongEl.value;
    var giaSanPhamText = giaSpEl.textContent;
    var tongtienText = tongTienEl.textContent;
    var giaSanPham = giaSanPhamText.replace(/[^0-9]/g, '');
    var tongtien = tongtienText.replace(/[^0-9]/g, '');

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
        body: formData,
        credentials: 'same-origin',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(text => {
        let data = null;
        try {
            data = JSON.parse(text);
        } catch (e) {}
        if (data && data.success) {
            window.location.href = '../PHP/Bag.php';
            return;
        }
        if (data && data.redirect) {
            window.location.href = data.redirect;
            return;
        }
        if (data && data.message) {
            alert(data.message);
        }
        if (!data) {
            alert(text);
        }
        console.error("Lỗi thêm giỏ:", text);
    })
    .catch(err => {
        console.error("Lỗi fetch:", err);
    });
}
