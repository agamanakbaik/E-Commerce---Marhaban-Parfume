<?php
//include 'db.php';

// Pastikan koneksi database tersedia
//if (!$conn) {
//   die("Koneksi database gagal: " . mysqli_connect_error());
//}

// Ambil data dari tabel products
//$result = mysqli_query($conn, "SELECT * FROM products");

//if (!$result) {
//  die("Query error: " . mysqli_error($conn));
//}

//while ($row = mysqli_fetch_assoc($result)) {
// Pastikan data aman untuk ditampilkan
//  $name = htmlspecialchars($row["name"]);
//$description = htmlspecialchars($row["description"]);
//$price = number_format($row["price"], 0, ',', '.'); // Format harga
// $image = !empty($row["image"]) ? "uploads/" . $row["image"] : "images/no-image.jpg"; // Fallback jika gambar kosong

//} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--ikon keranjang-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
                            <li><a class="dropdown-item" href="index.php">Semua Kategori</a></li>
                            <li><a class="dropdown-item" href="index.php?category_id=1">Bibit Parfume</a></li>
                            <li><a class="dropdown-item" href="index.php?category_id=2">Botol Parfume</a></li>
                            <li><a class="dropdown-item" href="index.php?category_id=3">Paket Usaha</a></li>
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
            Diharapkan bertanya-tanya terlebih dahulu sebelum melakukan pengambilan barang agar kami cek ketersediaan
            bahan
            yang diinginkan.
            <br>Jam Operasional: Senin - Sabtu 08:30-17:00
        </div>
        <div style="padding-right: 50px;" class="mb-3 mt-3">
            <input type="text" class="form-control" style="width:40%; margin-left: auto; position:relative; top:40px;"
                id="cari-list" placeholder="Cari List Disini...">
        </div>
        <div class="row row-cols-md-3 row-cols-2 gx-5 p-5">
            <?php
            include 'db.php';

            // Pastikan koneksi database tersedia
            if (!$conn) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }
            if (isset($_GET['category_id'])) {
                $category_id = $_GET["category_id"];
                // Ambil data dari tabel products
                $result = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id");
            } else if (!isset($_GET['category_id'])) {
                $result = mysqli_query($conn, "SELECT * FROM products ");
            } else {
                echo "Parameter category_id tidak ditemukan.";
            }


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
                <div class='col mb-5 product-item' data-name='$name' data-description='$description'>
                    <div class='card'>
                        <img src='$image' class='card-img-top' alt='$name' />
                        <div class='card-body'>
                            <p class='card-text'>$name</p>
                        </div>
                        <div class='d-none deskripsi'>
                            <p>$description</p>
                        </div> 
                        <div class='card-footer d-md-flex'>
                            <a class='btn btn-sm btn-primary d-block btnDetail'>Detail</a>
                            <span class='ms-auto text-danger fw-bold d-block text-center harga'>Rp. $price</span>
                        </div>
                    </div>
                </div>";
            }
            ?>


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
                    Pilih produk yang diinginkan, lalu klik menu Detail. Jika hanya membeli satu produk, klik tombol
                    <i>Beli Produk Ini</i>. Namun jika ingin membeli lebih dari satu produk, masukkan ke keranjang
                    terlebih dahulu.
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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let loggedIn = false; // Default user dianggap belum login

            // Ambil status session dari PHP
            fetch('session.php')
                .then(response => response.json())
                .then(data => {
                    loggedIn = data.loggedIn; // Simpan status login
                })
                .catch(error => console.error('Error fetching session:', error));
            // Event untuk tombol Detail (menampilkan modal)
            document.querySelectorAll('.btnDetail').forEach(item => {
                item.addEventListener('click', (e) => {
                    let card = e.target.closest('.card');
                    let gambar = card.querySelector('.card-img-top').src;
                    let harga = card.querySelector('.harga').innerHTML;
                    let judul = card.querySelector('.card-text').innerHTML;
                    let deskripsi = card.querySelector('.deskripsi')
                        ? card.querySelector('.deskripsi').innerHTML
                        : '<i>tidak ada informasi yang tersedia</i>';

                    let tombolModal = document.querySelector('.btnModal');
                    tombolModal.click();

                    document.querySelector('.modalTitle').innerHTML = judul;
                    let image = document.createElement('img');
                    image.src = gambar;
                    image.classList.add('w-100');
                    document.querySelector('.modalImage').innerHTML = '';
                    document.querySelector('.modalImage').appendChild(image);
                    document.querySelector('.modalDeskripsi').innerHTML = deskripsi;
                    document.querySelector('.modalHarga').innerHTML = harga;

                    // Simpan link pembelian di tombol Beli
                    const nohp = '6289510175754';
                    let pesan = `Hallo kak! Saya tertarik dengan produk ini: ${judul}, dengan harga ${harga}. Berikut gambar produknya: ${gambar}`;
                    let url = `https://api.whatsapp.com/send?phone=${nohp}&text=${encodeURIComponent(pesan)}`;
                    let btnBeli = document.querySelector('.btnBeli');
                    btnBeli.setAttribute('data-url', url); // Simpan URL di atribut data
                });
            });

            // Event untuk tombol Beli
            document.querySelector('.btnBeli').addEventListener('click', function (e) {
                if (!loggedIn) {
                    // e.preventDefault(); // Hentikan tombol dari membuka link
                    // alert("Silakan login terlebih dahulu untuk membeli produk.");
                    // } else {
                    let url = this.getAttribute('data-url');
                    window.location.href = url; // Arahkan ke WhatsApp jika user login
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Live Search
            document.getElementById('cari-list').addEventListener('keyup', function () {
                const keyword = this.value.toLowerCase();
                const items = document.querySelectorAll('.product-item');

                items.forEach(function (item) {
                    const name = item.getAttribute('data-name').toLowerCase();
                    const description = item.getAttribute('data-description').toLowerCase();

                    if (name.includes(keyword) || description.includes(keyword)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <!--<script src="javascript/main.js"></script>-->
</body>

</html>