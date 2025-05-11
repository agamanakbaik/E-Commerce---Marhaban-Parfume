<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Cegah browser menyimpan cache halaman admin
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>

</head>

<script>
    var isLoggedIn = <?= json_encode($loggedIn) ?>; // Kirim status login ke JavaScript
</script>
<script src="main.js"></script> <!-- Hubungkan file JS -->

<body class="bg-secondary">
    <div class="container p-0 mb-4 mt-4 rounded-3 shadow bg-white">
        <!-- Menu -->
        <nav class="d-md-flex p-4">
            <div>
                <h1>Marhaban Parfume</h1>
            </div>

            <div class="ms-auto my-auto">
                <ul class="list-inline m-0">
                    <li class="list-inline-item mx-md-3">
                        <a href="#" class="text-decoration-none text-dark fw-bold dropdown-toggle" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Produk Kami
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="halamanadmin.php">Semua Kategori</a></li>
                            <li><a class="dropdown-item" href="halamanadmin.php?category_id=1">Bibit Parfume</a></li>
                            <li><a class="dropdown-item" href="halamanadmin.php?category_id=2">Botol Parfume</a></li>
                            <li><a class="dropdown-item" href="halamanadmin.php?category_id=3">Paket Usaha</a></li>
                        </ul>
                    </li>
                    <li class="list-inline-item mx-md-3"><a href="#tentangkami"
                            class="text-decoration-none text-dark fw-bold">Tentang Kami</a></li>
                    <li class="list-inline-item mx-md-3"><a href="#caraorder"
                            class="text-decoration-none text-dark fw-bold">Cara Order</a></li>

                    <!-- Keranjang -->
                    <li class="list-inline-item mx-md-3">
                        <a href="cart.php" class="text-decoration-none text-dark fw-bold">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>

                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-bs-toggle="dropdown" aria-expanded="false"
                            style="background-color: #fff; border: #fff; color: #212529; margin-bottom: 7px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-baseline-density-medium">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 20h16" />
                                <path d="M4 12h16" />
                                <path d="M4 4h16" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Akun Saya</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </nav>

        <!-- Banner -->
        <div class="px-4 mb-4">
            <img src="images/banner.jpg" class="w-100 rounded-3">
        </div>

        <!-- Katalog -->
        <h3 class="text-center">Our Collection</h3>
        <div class="text-center w-50 mx-auto fw-light">
            Toko Grosir Marhaban Perfume menjual berbagai aroma bibit parfum, botol parfum, perlengkapan racik parfum,
            dll.
            Wajib bertanya-tanya terlebih dahulu sebelum melakukan pengambilan barang agar kami cek ketersediaan bahan
            yang diinginkan.
            <br>Jam Operasional: Senin - Sabtu 08:30-17:00

            <!-- Tombol Tambah Produk -->
            <div class="text-center my-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    Tambah Produk
                </button>
            </div>

            <!-- Modal Tambah Produk -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Nama Produk" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php
                                        include 'db.php'; // jika belum dimasukkan
                                        $result = mysqli_query($conn, "SELECT * FROM categories");
                                        while ($cat = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Produk</label>
                                    <textarea id="description" name="description" class="form-control"
                                        placeholder="Deskripsi Produk" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="number" id="price" name="price" class="form-control"
                                        placeholder="Harga" required>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Produk</label>
                                    <input type="file" id="image" name="image" class="form-control" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah Produk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div id="kumpulan_katalog" class="row row-cols-md-3 row-cols-2 gx-5 p-5">
            <?php
            include 'db.php';

            // Pastikan koneksi database tersedia
            if (!$conn) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }

            // Ambil data dari tabel products
            $result = mysqli_query($conn, "SELECT * FROM products");

            if (!$result) {
                die("Query error: " . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($result)) {
                // Pastikan data aman untuk ditampilkan
                $name = htmlspecialchars($row["name"]);
                $description = htmlspecialchars($row["description"]);
                $price = number_format($row["price"], 0, ',', '.'); // Format harga
                $image = !empty($row["image"]) ? "images/" . $row["image"] : "images/no-image.jpg"; // Fallback jika gambar kosong
            
                echo "
                    <div class='col mb-5'>
                        <div class='card'>
                            <img src='$image' class='card-img-top' alt='$name' />
                            <div class='card-body'>
                                <p class='card-text'>$name</p>
                            </div>
                            <div class='d-none deskripsi'>
                                <p>$description</p>
                            </div> 
                            <div class='card-footer d-md-flex' style='gap:10px;'>
                                <a class='btn btn-sm btn-primary d-block btnDetail'>Detail</a>
                                                <a href='#' 
                   class='btn btn-sm btn-danger d-block btnDelete' 
                   data-id='{$row['id']}'>
                   Delete
                </a>



                                <a href='#' 
                                    class='btn btn-sm btn-success d-block btnEdit' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editProductModal'
                                    data-id='{$row['id']}'
                                    data-name='" . htmlspecialchars($row['name']) . "'
                                    data-description='" . htmlspecialchars($row['description']) . "'
                                    data-price='{$row['price']}'
                                    data-image='{$row['image']}'
                                    >Edit
                                </a>
                                <span class='ms-auto text-danger fw-bold d-block text-center harga'>Rp. $price</span>
                            </div>
                        </div>
                    </div>";
            }

             // Pastikan koneksi database tersedia
             if (!$conn) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }
            if (isset($_GET['category_id'])){
                $category_id = $_GET["category_id"];
            // Ambil data dari tabel products
            $result = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id");
            } else if(!isset($_GET['category_id'])) {
                $result = mysqli_query($conn, "SELECT * FROM products ");
            }
            else {
                echo "Parameter category_id tidak ditemukan.";
            }
            ?>


            < <div class="card-body">
        </div>
        <div class="d-none deskripsi"><!--class d none supaya tidak terlihat-->
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni laboriosam soluta ea illo
                distinctio pariatur aut ipsum dolorum nam corporis fugit eaque ipsa similique autem tempore
                esse eos nulla, et facere? Sint eos reprehenderit eligendi. Iste doloribus quasi sequi
                quaerat perspiciatis, aliquid vero adipisci excepturi. </p>
        </div>

    </div>
    <!-- Tentang Kami -->
    <div class="px-4 py-4 bg-secondary text-center">
        <div class="mx-auto w-75">
            <h3 id="tentangkami" class="text-white">Tentang Kami</h3>
            <p class="text-center text-white">
                <img src="images/about-us.png" align="left" style="width:100px; height: auto;" class="me-3 mb-3" />
                Marhaban Perfume telah berkarya sejak tahun 2017 dan didirikan oleh Bapak Syarif Salim Bahanan. Kami
                menyediakan berbagai jenis parfum berkualitas dan melayani pengiriman ke seluruh Indonesia. Toko
                kami berlokasi di Jl. Empang No.31B, Empang, Kota Bogor, Jawa Barat 16132.
            </p>
        </div>
    </div>

    <!-- Cara Order -->
    <div class="px-4 py-4 bg-light text-center">
        <div class="mx-auto w-75">
            <h3 id="caraorder">Cara Order</h3>
            <p class="text-center">
                <img src="images/order.png" align="right" style="width:100px; height: auto;" class="ms-3 mb-3" />
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem praesentium optio, asperiores et
                illum nam. Natus tempore ad sint eius deleniti autem aliquam nam adipisci atque quaerat libero et
                quisquam placeat deserunt, quae explicabo exercitationem voluptate nostrum facere ut error quam
                itaque dolorem! Exercitationem, sapiente in? Aliquam distinctio incidunt illo!
            </p>
        </div>
    </div>
    <!--copyright-->
    <div class="text-center p-4 border-top">&copy; 2025 Marhaban Perfume. -Pusat Grosir Parfume Berkualitas</div>
    </div>
    <!--MODAL-->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none btnModal" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="update_product.php" method="POST" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama Produk</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="edit-description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-price" class="form-label">Harga</label>
                        <input type="number" name="price" id="edit-price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Gambar Baru (Opsional)</label>
                        <input type="file" name="image" id="edit-image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modalTitle" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="modalImage col-md-6 col-12"></div>
                    <div class="col-md-6 col-12">
                        <div class="modalDeskripsi"></div>
                        <div class="d-md-flex">
                            <a href="" target="_blank" class="btn btn-sm btn-warning d-block btnBeli">Beli Produk
                                Ini</a>
                            <span class="ms-auto text-danger fw-bold d-block text-center modalHarga"></span>
                        </div>
                        <a style="" href="">tambahkan ke keranjang</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

        <script src="javascript/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <!-- modal delete-->
        <script>
$(document).ready(function () {
    $('.btnDelete').click(function (e) {
        e.preventDefault(); // Mencegah buka halaman

        if (!confirm("Yakin ingin menghapus produk ini?")) {
            return;
        }

        const productId = $(this).data('id');

        $.ajax({
            url: 'delete_product.php',
            type: 'POST',
            data: { id: productId },
            success: function (response) {
                if (response.trim() === 'success') {
                    alert("Produk berhasil dihapus.");
                    location.reload(); // Refresh halaman setelah hapus
                } else {
                    alert("Gagal menghapus: " + response);
                }
            },
            error: function () {
                alert("Terjadi kesalahan saat menghapus.");
            }
        });
    });
});
</script>




        <script> //javascript edit
            document.addEventListener("DOMContentLoaded", function () {
                const editButtons = document.querySelectorAll(".btnEdit");

                editButtons.forEach(button => {
                    button.addEventListener("click", function () {
                        const id = this.dataset.id;
                        const name = this.dataset.name;
                        const description = this.dataset.description;
                        const price = this.dataset.price;

                        document.getElementById("edit-id").value = id;
                        document.getElementById("edit-name").value = name;
                        document.getElementById("edit-description").value = description;
                        document.getElementById("edit-price").value = price;
                    });
                });
            });
        </script>

</body>

</html>