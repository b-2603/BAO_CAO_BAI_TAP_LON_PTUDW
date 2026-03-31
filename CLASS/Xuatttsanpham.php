<?php
include ("Ketnoi.php");
class dulieu extends tmdt
{
    private function mapDanhMucTen($ten)
    {
        $map = array(
            'THE HOLIDAY SHOP' => 'BỘ SƯU TẬP THỂ THAO',
            'BEDDING' => 'ÁO THỂ THAO',
            'RUGS' => 'GIÀY CHẠY BỘ',
            'MIRRORS & WALL ART' => 'ÁO KHOÁC & HOODIE',
            'KITCHEN' => 'PHỤ KIỆN',
            'ARCHIVE SALE' => 'SALE',
        );

        return isset($map[$ten]) ? $map[$ten] : $ten;
    }

    public function xuatdsdanhmuc($sql)
    {
        $link = $this->ketnoi();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
    
        if ($i > 0) {
            $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
    
            while ($row = mysqli_fetch_array($ketqua)) {
                $dm_iddanhmuc = $row['dm_iddanhmuc'];
                $dm_ten = $this->mapDanhMucTen($row['dm_ten']);
                $dm_mota = $row['dm_mota'];
                $dm_anhsub1 = $row['dm_anhsub1'];
                $dm_anhsub2 = $row['dm_anhsub2'];
    
                $sql_danhmuccon = "SELECT dmc_tencon, dmc_idcon FROM danhmuccon WHERE dm_iddanhmuc = $dm_iddanhmuc";
                $ketqua_danhmuccon = mysqli_query($link, $sql_danhmuccon);
    
                $danhmuccon_list = '';
                while ($row_con = mysqli_fetch_array($ketqua_danhmuccon)) {
                    $dmc_idcon = $row_con['dmc_idcon'];
                    $dmc_tencon = $row_con['dmc_tencon'];
                    $url_dmc = "Category.php?id_con=$dmc_idcon";
                    if ($id_user) {
                        $url_dmc .= "&id_user=$id_user";
                    }
                    $danhmuccon_list .= '<a href="'.$url_dmc.'">' . $dmc_tencon . '</a>';
                }
    
                $url_dm = "Category.php?id_chinh=$dm_iddanhmuc";
                if ($id_user) {
                    $url_dm .= "&id_user=$id_user";
                }
    
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="'.$url_dm.'">'.$dm_ten.'</a>
                        <ul class="sub_menu" style="height: 350px;">
                            <div class="row">
                                <div class="dau" style="font-size: 14px;">
                                    <li>
                                        ' . $danhmuccon_list . '
                                        <a href="'.$url_dm.'">Xem tất cả</a>
                                    </li>
                                </div>
                                <div class="giua">
                                    <img src="'. $dm_anhsub1 .' " alt="'.$dm_ten.'" style="width: 200px; height:265px;">
                                </div>
                                <div class="duoi">
                                    <img src="' . $dm_anhsub2 .'" alt="'.$dm_ten.'" style="width: 400px; height:265px;">
                                </div>
                            </div>
                        </ul>
                    </li>
                ';
            }
        } else {
            echo "Không có dữ liệu";
        }
    }
    
    public function xuatmenumannho($sql)
    {
        $link = $this->ketnoi();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
    
        if ($i > 0) {
            while ($row = mysqli_fetch_array($ketqua)) {
                $dm_iddanhmuc = $row['dm_iddanhmuc'];
                $dm_ten = $this->mapDanhMucTen($row['dm_ten']);
                echo '
                    <li class="nav-item"><a class="nav-link" href="Category.php?id_chinh=' . $dm_iddanhmuc . '">' . $dm_ten . '</a></li>
                ';
            }
        } else {
            echo "Không có dữ liệu";
        }
    }
    
    public function linkheader(){
        $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
        $current_page = basename($_SERVER['PHP_SELF']);
        if (isset($_GET['id_con']) || isset($_GET['id_chinh'])) {
            $id_con = isset($_GET['id_con']) ? (int)$_GET['id_con'] : null;
            $id_chinh = isset($_GET['id_chinh']) ? (int)$_GET['id_chinh'] : null;
            $category_link = "Category.php";
            if ($id_user) {
                $category_link .= "?id_user=" . $id_user;
                if ($id_con) {
                    $category_link .= "&id_con=" . $id_con;
                } elseif ($id_chinh) {
                    $category_link .= "&id_chinh=" . $id_chinh;
                }
            } else {
                if ($id_con) {
                    $category_link .= "?id_con=" . $id_con;
                } elseif ($id_chinh) {
                    $category_link .= "?id_chinh=" . $id_chinh;
                }
            }
            echo '
            <div class="banner row text-center text-white mb-0">
                <a id="shop-link" href="' . $category_link . '" style="text-decoration: none;">
                    <p class="text-white mt-1">Đang mở:
                        <span id="shop-name" class="text-white mt-1 fw-bold">DANH MỤC</span>
                        <i class="bi bi-arrow-right text-white"></i>
                    </p>
                </a>
            </div>';
            
        }
        elseif ($current_page === 'index.php') {
            $category_link = "Category.php";
        if ($id_user) {
            $category_link .= "?id_user=" . $id_user;
        }
        echo '
            <div class="banner row text-center text-white mb-0">
                <a id="shop-link" href="' . $category_link . '" style="text-decoration: none;">
                    <p class="text-white mt-1">Đang mở:
                        <span id="shop-name" class="text-white mt-1 fw-bold">DANH MỤC</span>
                        <i class="bi bi-arrow-right text-white"></i>
                    </p>
                </a>
            </div>';
        }
        
        else {
            $home_link = "index.php";
            if ($id_user) {
                $home_link .= "?id_user=" . $id_user;
            }
            echo '
            <div class="banner row text-center text-white mb-0">
                <a id="shop-link" href="' . $home_link . '" style="text-decoration: none;">
                    <p class="text-white mt-1">Đang mở:
                        <span id="shop-name" class="text-white mt-1 fw-bold">TRANG CHỦ</span>
                        <i class="bi bi-arrow-right text-white"></i>
                    </p>
                </a>
            </div>';
        }
        
    }
    public function xuatdssanpham($sql)
    {
        $link = $this->ketnoi(); 
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
    
        if ($i > 0) {
            while ($row = mysqli_fetch_array($ketqua)) {
                $sp_id = $row['sp_id'];
                $sp_ten = $row['sp_ten'];
                $sp_gia = $row['sp_gia'];
                $sp_anh1 = $row['sp_anh1'];
                $sp_anh2 = $row['sp_anh2'];
    
                $chitiet = "SELECT ct_luotdanhgia, ct_kichthuoc, ct_danhgia, ct_motangan
                            FROM sanpham_chitiet 
                            WHERE sp_id = $sp_id";
                $ketqua_chitiet = mysqli_query($link, $chitiet);
                
                while ($row = mysqli_fetch_array($ketqua_chitiet)) {
                    $ct_danhgia = $row['ct_danhgia'];
                    $ct_mota = $row['ct_motangan'];
                    $ct_luotdanhgia = $row['ct_luotdanhgia'];
                    $ct_kichthuoc = $row['ct_kichthuoc'];
                    $kichthuoc_array = explode(',', $ct_kichthuoc);
                }
                // Tạo link cho chi tiết sản phẩm nếu có user
                $chitietsanpham_link = "chitietsanpham.php?sp_id=" . $sp_id;
                if ($id_user) {
                    $chitietsanpham_link .= "&id_user=" . $id_user;
                }
    
                echo '
                    <div class="col-3 col-md-3 px-2">
                    <a href="' . $chitietsanpham_link . '">
                        <div class="product-item horizontal-product-item" data-category="' . $sp_id . '" data-name="" data-price="' . $sp_gia . '" data-image="' . $sp_anh1 . '">
                            <div class="product-image">
                                <img src="' . $sp_anh1 . '" class="main-img" alt="' . $sp_ten . '" loading="lazy" decoding="async">
                                <img src="' . $sp_anh2 . '" class="hover-img" alt="' . $sp_ten . '" loading="lazy" decoding="async">
                            </div>
                            <h2 class="product-name horizontal-product-item text-start text-uppercase">' . $sp_ten . '</h2>
                            <p class="chi_tiet_sp text-start">' . $ct_mota . '</p>
                            <div class="row justify-content-between align-items-center">
                                <div class="rating">
                                    ' . $ct_danhgia . '
                                    <span class="review-count">(' . $ct_luotdanhgia . ' đánh giá)</span>
                                </div>
                                <div class="d-flex justify-content-start align-items-center">
                                    <p class="product-price mt-3" style="width: auto;">$' . $sp_gia . '</p>
                                    <button class="view-details-btn" style="width: auto;">
                                        
                                            <img src="https://i.postimg.cc/bNcMh14k/themgiohang.png" alt="" style= "width:30px; height: 30px;">
                 
                                    </button>
                    </a>
                                    <label for="color-select-' . $sp_id . '" style="display:none;">Chọn kích thước:</label>
                                    <select id="color-select-' . $sp_id . '" style="display:none;">';
    
                foreach ($kichthuoc_array as $kichthuoc) {
                    echo '<option value="' . $kichthuoc . '">' . $kichthuoc . '</option>';
                }
    
                echo '
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo '<div class="row pt-3 pb-5">
                    <hr style="width: 200%; margin: 0 auto;">
                    <div class="h2 text-center line-heading" style="font-size: 24px; font-weight: bold; margin-bottom: 20px; margin-top: 20px; clear:both ">
                        DANH MỤC TRỐNG !!!
                    </div>
                    <hr style="width: 200%; margin: 0 auto;">
                  </div>';
        }
    }
    
    public function slidedanhmuc($sql)
    {
        $link = $this->ketnoi(); 
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
    
        if ($i > 0) {
            if (isset($_GET['id_con'])) {
                $danhmuccon_id = (int)$_GET['id_con'];
                $sql_danhmuccon = "SELECT dmc_idcon, dmc_mota, dmc_motachitiet FROM danhmuccon WHERE dmc_idcon = '$danhmuccon_id'";
                $ketqua_danhmuccon = mysqli_query($link, $sql_danhmuccon);
    
                if (mysqli_num_rows($ketqua_danhmuccon) > 0) {
                    while ($row_dmc = mysqli_fetch_array($ketqua_danhmuccon)) {
                        $dmc_mota = $row_dmc['dmc_mota'];
                        $dmc_motachitiet = $row_dmc['dmc_motachitiet'];

                        echo '
                        <div class="row pt-3 pb-5">
                            <div class="h2 text-center line-heading" style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
                                ' . $dmc_mota . '
                            </div>
                            <div class="text-center" style="max-width: 700px; margin: 0 auto; font-size: 15px; line-height: 1.5; color: #555;">
                                ' . $dmc_motachitiet . '
                            </div>
                        </div>';
                    }
                }
            } 
            // Nếu không có id_con nhưng có id_chinh
            else if (isset($_GET['id_chinh'])) {
                $danhmuc_id = (int)$_GET['id_chinh'];
                $sql_danhmuc = "SELECT dm_mota, dm_motachitiet, dm_anh1, dm_anh2, dm_anh3 FROM danhmuc WHERE dm_iddanhmuc = '$danhmuc_id'";
                $ketqua_danhmuc = mysqli_query($link, $sql_danhmuc);
    
                if (mysqli_num_rows($ketqua_danhmuc) > 0) {
                    while ($row_dm = mysqli_fetch_array($ketqua_danhmuc)) {
                        $dm_mota = $row_dm['dm_mota'];
                        $dm_motachitiet = $row_dm['dm_motachitiet'];
                        $dm_anh1 = $row_dm['dm_anh1'];
                        $dm_anh2 = $row_dm['dm_anh2'];
                        $dm_anh3 = $row_dm['dm_anh3'];

                        // Override hero carousel images for sportswear theme (category id 1)
                        if ($danhmuc_id == 1) {
                            $dm_anh1 = 'https://images.pexels.com/photos/5384619/pexels-photo-5384619.jpeg';
                            $dm_anh2 = 'https://images.pexels.com/photos/1103833/pexels-photo-1103833.jpeg';
                            $dm_anh3 = 'https://images.pexels.com/photos/27862760/pexels-photo-27862760.jpeg';
                        }
                        // Override hero carousel images for sportswear theme (category id 2)
                        if ($danhmuc_id == 2) {
                            $dm_anh1 = 'https://images.pexels.com/photos/6230435/pexels-photo-6230435.jpeg';
                            $dm_anh2 = 'https://images.pexels.com/photos/6311564/pexels-photo-6311564.jpeg';
                            $dm_anh3 = 'https://images.pexels.com/photos/7202266/pexels-photo-7202266.jpeg';
                        }
                        // Override hero carousel images for sportswear theme (category id 3)
                        if ($danhmuc_id == 3) {
                            $dm_anh1 = 'https://images.pexels.com/photos/1456737/pexels-photo-1456737.jpeg';
                            $dm_anh2 = 'https://images.pexels.com/photos/1456733/pexels-photo-1456733.jpeg';
                            $dm_anh3 = 'https://images.pexels.com/photos/1192043/pexels-photo-1192043.jpeg';
                        }
                        // Override hero carousel images for sportswear theme (category id 4)
                        if ($danhmuc_id == 4) {
                            $dm_anh1 = 'https://images.pexels.com/photos/14313014/pexels-photo-14313014.jpeg';
                            $dm_anh2 = 'https://images.pexels.com/photos/5068713/pexels-photo-5068713.jpeg';
                            $dm_anh3 = 'https://images.pexels.com/photos/28758129/pexels-photo-28758129.jpeg';
                        }
                        // Override hero carousel images for sportswear theme (category id 5)
                        if ($danhmuc_id == 5) {
                            $dm_anh1 = 'https://images.pexels.com/photos/257970/pexels-photo-257970.jpeg';
                            $dm_anh2 = 'https://images.pexels.com/photos/8032833/pexels-photo-8032833.jpeg';
                            $dm_anh3 = 'https://images.pexels.com/photos/2570139/pexels-photo-2570139.jpeg';
                        }
 
                        echo '
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="' . $dm_anh1 . '" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="' . $dm_anh2 . '" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="' . $dm_anh3 . '" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Trước</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Sau</span>
                            </button>
                        </div>
                        <div class="row pt-3 pb-5">
                            <div class="h2 text-center line-heading" style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
                                ' . $dm_mota . '
                            </div>
                            <div class="text-center" style="max-width: 700px; margin: 0 auto; font-size: 15px; line-height: 1.5; color: #555;">
                                ' . $dm_motachitiet . '
                            </div>
                        </div>';
                    }
                }
            }
        } else {
            echo "Không có dữ liệu";
        }
    }
    
    public function anhdaidien($sql)
    {
                echo '
                    <a href="#"><img src="https://i.postimg.cc/0QCwcHtN/logout.png" alt="Đăng nhập" id="nutdangnhap" style="width: 20px; height: 20px;"></a>
                ';
    }
    
    public function xuatthongtinchitiet($sql)
    {
        $link = $this->ketnoi();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        
        if ($i > 0) {
            $row = mysqli_fetch_array($ketqua);
            $sp_id = $row['sp_id'];
            $sp_ten = $row['sp_ten'];
            $sp_gia = $row['sp_gia'];
            $sp_anh1 = $row['sp_anh1'];
            
            $chitiet = "SELECT * FROM sanpham_chitiet WHERE sp_id = $sp_id";
            $ketqua_chitiet = mysqli_query($link, $chitiet);
            $rows = mysqli_fetch_array($ketqua_chitiet);
            
            $ct_mota = $rows['ct_motangan'];
            $ct_kichthuoc = $rows['ct_kichthuoc'];
            $ct_album1 = $rows['ct_album1'];
            $ct_album2 = $rows['ct_album2'];
            $ct_album3 = $rows['ct_album3'];
            $ct_motachitiet = $rows['ct_motachitiet'];
            $ct_xuatxu = $rows['ct_xuatxu'];
            $kichthuoc_array = explode(',', $ct_kichthuoc);
            
            echo '
                <div class="container mb-5 product-details">
                    <div class="row g-0">
                        <!-- Cột Trái: Hình ảnh sản phẩm -->
                        <div class="col-md-6">
                            <div class="border-0">
                                <img id="mainImage" src="' . $sp_anh1 . '" class="product-image" style="width:550px; height: 450px;" alt="Sản phẩm" loading="eager" decoding="async">
                                <div class="d-flex justify-content-center ">
                                    <div class="row">
                                        <div class="col-12 mb-2 mt-0">
                                            <img src="' . $ct_album1 . '" class="thumbnail " style="width:180px; height:180px;" onclick="changeImage(this)" loading="lazy" decoding="async">
                                            <img src="' . $ct_album2 . '" class="thumbnail" style="width:180px; height:180px;" onclick="changeImage(this)" loading="lazy" decoding="async">
                                            <img src="' . $ct_album3 . '" class="thumbnail" style="width:180px; height:180px;" onclick="changeImage(this)" loading="lazy" decoding="async">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Cột Phải: Thông tin sản phẩm -->
                        <div class="col-md-6" style="background-color: #f9f9f9;padding:10px;">
                            <h1 id="ten">' . $sp_ten . '</h1>
                            <p id="gia_sp">' . $sp_gia . 'đ</p>
                            <p id="xuatxu_sp"><label id="label-style"><i>Xuất xứ: ' . $ct_xuatxu . '</i></label></p>
                            <p>Mô tả: ' . $ct_mota . '</p>
                            <p>
                                <strong>
                                    <label for="size-select-' . $sp_id . '">Kích thước:</label>
                                    <br>
                                </strong>
                                <select id="size-select-' . $sp_id . '" style="width:120px" class="form-control w-25">';
            
            foreach ($kichthuoc_array as $kichthuoc) {
                echo '<option value="' . $kichthuoc . '">' . $kichthuoc . '</option>';
            }
            
            echo '
                                </select>
                            </p>
                            <div>
                            </div>
                            <p class="mt-3"><strong>Số lượng:</strong></p>
                            <input type="number" name="so_luong" id="so_luong-' . $sp_id . '" value="1" min="1" class="form-control w-25" onchange="tinhTongTien(' . $sp_gia . ', this.value, ' . $sp_id . ')">
                            <p class="mt-3"><strong>Tổng tiền: </strong><span id="tong_tien-' . $sp_id . '">' . $sp_gia . 'đ</span></p>
                            <div class="mt-3">
                                <div class="col-12 mt-4">
                                    <button type="button" class="add-to-cart-btnn" onclick="submit1(' . $sp_id . ')">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="background-color:#f9f9f9;">
                        <div class="product-description mt-5">
                            <h1>Mô tả</h1>
                            <div class="tab-content active" id="description">
                                <p id="product-story">' . $ct_motachitiet . '</p>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function tinhTongTien(gia, so_luong, sp_id) {
                        var tong_tien = gia * so_luong;
                        document.getElementById("tong_tien-" + sp_id).innerText = tong_tien;
                    }
                </script>
            ';
        } else {
            echo 'Dữ liệu không được load thành công';
        }
    }
    
    public function xuatgiohang($sql)
    {     
        $link = $this->ketnoi();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);     
    
        if ($i > 0) {
            $row = mysqli_fetch_array($ketqua);
            $gh_id = $row['gh_id'];
            $gh_tongtien = $row['gh_tongtien'];
    
            $chitiet = "SELECT * FROM giohang_chitiet WHERE gh_id = $gh_id";
            $ketqua_chitiet = mysqli_query($link, $chitiet);
    
            while ($rows = mysqli_fetch_array($ketqua_chitiet)) {
                $ctgh_id = $rows['ctgh_id'];
                $ghct_anhsp = $rows['ghct_anhsp'];
                $ghct_tensp = $rows['ghct_tensp'];
                $ctgh_kichthuoc = $rows['ctgh_kichthuoc'];
                $ctgh_soluong = $rows['ctgh_soluong'];
                $ctgh_gia = $rows['ctgh_gia'];
                $tongtien_sp = $rows['ctgh_tongtien'];
      
                echo '
                    <div class="cart-item" id="cart-item-' . $ctgh_id . '">
                        <input type="checkbox" name="selected_items[]" value="' . $ctgh_id . '">
                        <img src="' . $ghct_anhsp . '" alt="' . $ghct_tensp . '">
                        <h2>' . $ghct_tensp . '</h2>
                        <p>Kích thước: <span>' . $ctgh_kichthuoc . '</span></p>
                        <div class="price-quantity" style="width: 350px; text-align: center">
                            <span class="item-price">' . $ctgh_gia . '$</span> x 
                            <input type="number" name="quantity[' . $ctgh_id . ']" class="quantity" value="' . $ctgh_soluong . '" min="1" data-id="' . $ctgh_id . '">
                             = <span class="total-price" data-id="' . $ctgh_id . '">' . ($ctgh_soluong * $ctgh_gia) . '$</span> <!-- Cập nhật tổng tiền sản phẩm -->
                        </div>
                        <span class="remove-item" data-id="' . $ctgh_id . '" style="width: 50px; text-align: center">&times;</span>
                    </div>
                ';
            }
        }
    }
    
    public function dssp_donhang($selected_items) {
        $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
        $selected_items_str = implode(",", array_map('intval', $selected_items));
        $link = $this->ketnoi(); 
    
//Lấy các sản phẩm được chọn
        $query_chitiet = "SELECT * FROM giohang_chitiet WHERE gh_id IN 
                          (SELECT gh_id FROM giohang WHERE gh_iduser = '$id_user') 
                          AND ctgh_id IN ($selected_items_str)";
        $result_chitiet = mysqli_query($link, $query_chitiet);
        $tong_tien = 0;
        $danhsach_sp = array();
    
        while ($row = mysqli_fetch_array($result_chitiet)) {
            $item = array(
                'id_sanpham' => $row['ctgh_idsp'],
                'so_luong'   => $row['ctgh_soluong'],
                'gia_ban'    => $row['ctgh_gia'],
                'thanh_tien' => $row['ctgh_tongtien'],
                'tensp'      => $row['ghct_tensp'],
                'anhsp'      => $row['ghct_anhsp']
            );
            $tong_tien += $row['ctgh_tongtien'];
            $danhsach_sp[] = $item;
        }
//Lưu vào session
        $_SESSION['donhang_tam'] = array(
            'user_id' => $id_user,
            'tong_tien' => $tong_tien,
            'trang_thai' => 'Cho_xac_nhan',
            'san_pham' => $danhsach_sp
        );
        mysqli_close($link);
    
        echo "<script>window.location.href='Donhang.php';</script>";
    }

    public function xuatthongtindonhang() {
        if (!isset($_SESSION['donhang_tam'])) {
            echo "<p>Không có đơn hàng tạm trong phiên làm việc.</p>";
            return;
        }
    
        $donhang = $_SESSION['donhang_tam'];
        $tong_tien = $donhang['tong_tien'];
        $danhsach_sp = $donhang['san_pham'];
    
        foreach ($danhsach_sp as $sp) {
            $anh = $sp['anhsp'];
            $ten = $sp['tensp'];
            $soluong = $sp['so_luong'];
            $gia = $sp['gia_ban'];
            $sp_tongtien = $sp['thanh_tien'];
    
            echo '
                <div class="muc_giohang">
                    <img src="' . $anh . '">
                    <div>
                        <p><strong>Sản phẩm:</strong> ' . $ten . '</p>
                        <p><strong>Số lượng:</strong> ' . $soluong . '</p>
                        <p><strong>Giá:</strong> ' . $gia . ' VND</p>
                        <p><strong>Tổng:</strong> ' . $sp_tongtien . ' VND</p>
                    </div>
                </div>
            ';
        }
    
        echo '
            </div>
            <div id="tong_tien" style="text-align: center;">
                Tổng tiền: <span>' . $tong_tien . ' VND</span>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <form method="POST">
                    <button type="submit" name="huy_donhang" class="nut_bam nut_huy">❌ Hủy Đơn Hàng</button>
                </form>
        ';
    }
    public function xuatthongtindonhangchitiet($dh_id)
    {
        $link = $this->ketnoi();
        $query_dh = "SELECT * FROM donhang WHERE dh_id = '$dh_id'";
        $ketqua = mysqli_query($link, $query_dh);
    
        if (!$ketqua) {
            die("Lỗi truy vấn đơn hàng: " . mysqli_error($link));
        }
    
        $row = mysqli_fetch_array($ketqua);
        $dh_tongtien = $row['dh_tongtien'];
        $query_ctdh = "SELECT * FROM donhang_chitiet WHERE dh_id = '$dh_id'";
        $kq_ctdh = mysqli_query($link, $query_ctdh);
    
        if (!$kq_ctdh) {
            die("Lỗi truy vấn chi tiết đơn hàng: " . mysqli_error($link));
        }
    
        while ($rows = mysqli_fetch_array($kq_ctdh)) {
            $anh = $rows['dhct_anhsp'];
            $ten = $rows['dhct_tensp'];
            $soluong = $rows['dhct_soluong'];
            $gia = $rows['dhct_giabansp'];
            $sp_tongtien = $rows['dhct_thanhtien'];
    
            echo '
                <div class="muc_giohang">
                    <img src="'. $anh . '">
                    <div>
                        <p><strong>Sản phẩm:</strong>' . $ten . '</p>
                        <p><strong>Số lượng:</strong> ' . $soluong . '</p>
                        <p><strong>Giá:</strong> '.$gia.' VND</p>
                        <p><strong>Tổng:</strong> '.$sp_tongtien.' VND</p>
                    </div>
                </div>
            ';
        }
    
        echo '   
            </div>
            </div>
            <div id="tong_tien" style="text-align: center;">
                Tổng tiền: <span>'.$dh_tongtien.' VND</span>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <form method="POST">
                    <button type="submit" name="huy_donhang" class="nut_bam nut_huy">❌ Hủy Đơn Hàng</button>
                </form>
            </div>
        </div>';
    }  
    public function xoaDonHang() {
            unset($_SESSION['donhang_tam']);
            unset($_SESSION['dh_id_moi']);
            echo "<script>window.location.href = 'Bag.php';</script>";
    }
    public function hienThiThongTinDonHang($id_user, $id_donhang) {
        $conn =  $this->ketnoi();

        $query_vc = "SELECT * FROM vanchuyen WHERE user_id = '$id_user' AND dh_id = '$id_donhang' LIMIT 1";
        $result_vc = mysqli_query($conn, $query_vc);
        $vanchuyen = mysqli_fetch_assoc($result_vc);
    
        $query_dh = "SELECT * FROM donhang WHERE dh_id = '$id_donhang'";
        $result_dh = mysqli_query($conn, $query_dh);
        $donhang = mysqli_fetch_assoc($result_dh);
    
        $query_sp = "SELECT * FROM donhang_chitiet WHERE dh_id = '$id_donhang'";
        $result_sp = mysqli_query($conn, $query_sp);
        echo '
        <div class="col-md-8">
            <div class="invoice-info">
                <div class="row">
                    <div class="col-md-6 info-group">
                        <label>Tên người nhận:</label>
                        <p>' . $vanchuyen['vc_tenKH'] . '</p>
                    </div>
                    <div class="col-md-6 info-group">
                        <label>Số điện thoại:</label>
                        <p>' . $vanchuyen['vc_sdt'] . '</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 info-group">
                        <label>Địa chỉ giao hàng:</label>
                        <p>' . $vanchuyen['vc_diachi'] . '</p>
                    </div>
                    <div class="col-md-6 info-group">
                        <label>Ngày đặt hàng:</label>
                        <p>' .$donhang['dh_ngaytao']. '</p>
                    </div>
                </div>
            </div>
    
            <!-- Danh sách sản phẩm -->
            <table class="table product-table table-bordered">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>';
    
                while ($sp = mysqli_fetch_assoc($result_sp)) {
                    echo '<tr>
                            <td class="product-name">' . $sp['dhct_tensp'] . '</td>
                            <td>' . number_format($sp['dhct_giabansp'], 0, ',', '.') . '₫</td>
                            <td>' . $sp['dhct_soluong'] . '</td>
                            <td>' . number_format($sp['dhct_thanhtien'], 0, ',', '.') . '₫</td>
                        </tr>';
                }
    
        echo '  </tbody>
            </table>
        </div>';
        
        echo '
        <div class="col-md-4">
            <div class="total-price" style="text-align: center;">
                Tổng Tiền: '.$donhang['dh_tongtien'].'₫ 
            <br>💰 💰 💰 💰 💰
            </div>';
    
        mysqli_close($conn);
    }
    public function xuatlichsudonhang() {
        if (!isset($_SESSION['id_user'])) {
            echo "<p>Bạn chưa đăng nhập!</p>";
            return;
        }
        $id_user = $_SESSION['id_user'];
        $conn = $this->ketnoi();

        mysqli_set_charset($conn, 'utf8');
    
        $query = "SELECT dh_id, dh_tongtien, dh_trangthai, dh_ngaytao
                  FROM donhang 
                  WHERE user_id = '$id_user' 
                  ORDER BY dh_ngaytao DESC";
        $result = mysqli_query($conn, $query);
    
        echo '<div class="container">';
        echo '<h2>Lịch sử đơn hàng</h2>';
        echo '<table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>';
    
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['dh_id'];
            $ngay = date("d/m/Y", strtotime($row['dh_ngaytao']));
            $tong = number_format($row['dh_tongtien'], 0, ',', '.') . '₫';
            $trangthai = $row['dh_trangthai'];
            if ($trangthai == 'Cho_xac_nhan') {
                $btn = "
                    <form method='POST' action='../PHP/Donhangchitiet.php?dh_id=$id'>
                        <input type='hidden' name='dh_id' value='$id'>
                        <input type='submit' name='thanhtoan' class='btn-cancel' value='Thanh toán' />
                        <button class='btn-cancel' onclick=\"huyDonHang($id)\">Hủy</button>
                    </form>";
            } else if ($trangthai == 'Da_thanh_toan') {
                $btn = "<button class='btn-cancel' disabled>Không thể hủy</button>";
            } else if ($trangthai == 'Thanhtoan_Thatbai') {
                $btn = "
                    <form method='POST' action='../PHP/Donhangchitiet.php?dh_id=$id'>
                        <input type='hidden' name='dh_id' value='$id'>
                      <input type='submit' name='thanhtoan' class='btn-cancel' value='Thanh toán' />
                    <button class='btn-cancel' onclick=\"huyDonHang($id)\">Hủy</button>
                    </form>";
            }else if ($trangthai == 'Dang_giao') {
                $btn = "<button class='btn-cancel' disabled>Đang giao - Không thể hủy</button>";
            } else if ($trangthai == 'Da_giao') {
                $btn = "<button class='btn-cancel' disabled>Đã giao - Không thể hủy</button>";
            } else if ($trangthai == 'Da_huy') {
                $btn = "<button class='btn-cancel' disabled>Đơn đã hủy</button>";
            } else {
                $btn = "<button class='btn-cancel' disabled>Không rõ trạng thái</button>";
            }
    
            echo "<tr>
                    <td>#{$id}</td>
                    <td>{$ngay}</td>
                    <td>{$tong}</td>
                    <td>{$trangthai}</td>
                    <td>{$btn}</td>
                  </tr>";
        }
    
        echo '</tbody></table></div>';
        mysqli_close($conn);
    }
    public function luuthongtinthanhtoan()
    {
        $conn = $this->ketnoi();
        mysqli_set_charset($conn, 'utf8');

        if (
            isset($_GET['partnerCode']) &&
            isset($_GET['orderId']) &&
            isset($_GET['amount']) &&
            isset($_GET['orderInfo']) &&
            isset($_GET['orderType']) &&
            isset($_GET['transId']) &&
            isset($_GET['payType']) &&
            isset($_GET['resultCode']) &&
            isset($_GET['extraData']) && is_numeric($_GET['extraData'])
        ) {
            $code_order = rand(0, 999);
            $partnerCode = mysqli_real_escape_string($conn, $_GET['partnerCode']);
            $orderId = (int)$_GET['orderId'];
            $amount = mysqli_real_escape_string($conn, $_GET['amount']);
            $orderInfo = mysqli_real_escape_string($conn, urldecode($_GET['orderInfo']));
            $orderType = mysqli_real_escape_string($conn, $_GET['orderType']);
            $transId = (int)$_GET['transId'];
            $payType = mysqli_real_escape_string($conn, $_GET['payType']);
            $resultCode = mysqli_real_escape_string($conn, $_GET['resultCode']);
            $dh_id = (int)$_GET['extraData']; 

            $sql = "INSERT INTO thanhtoan_momo 
                    (partnerCode, orderId, amount, orderInfo, orderType, transId, payType, code_cart) 
                    VALUES ('$partnerCode', '$orderId', '$amount', '$orderInfo', '$orderType', '$transId', '$payType', '$code_order')";

            if (mysqli_query($conn, $sql)) {
                if ($resultCode === '0') {
                    $update_sql = "UPDATE donhang SET dh_trangthai = 'Da_thanh_toan' WHERE dh_id = '$dh_id'";
                    mysqli_query($conn, $update_sql);
                    echo "<p style='color:green'>💰 Giao dịch thành công!</p>";
                } else {
                    $update_sql = "UPDATE donhang SET dh_trangthai = 'Thanhtoan_Thatbai' WHERE dh_id = '$dh_id'";
                    mysqli_query($conn, $update_sql);
                    echo "<p style='color:red'>❌ Giao dịch thất bại hoặc đang xử lý...</p>";
                }
            } else {
                echo "<p style='color:red'>Lỗi ghi log thanh toán!</p>";
            }
        } 
    }

}
?>    
