document.querySelectorAll(".btnCart").forEach((button) => {
    button.addEventListener("click", function () {
        let id = this.getAttribute("data-id");
        let name = this.getAttribute("data-name");
        let price = this.getAttribute("data-price");

        // Ambil data keranjang dari LocalStorage
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        // Cek apakah produk sudah ada di keranjang
        let existingProduct = cart.find((item) => item.id === id);
        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            cart.push({ id, name, price, quantity: 1 });
        }

        // Simpan kembali ke LocalStorage
        localStorage.setItem("cart", JSON.stringify(cart));

        alert(name + " ditambahkan ke keranjang!");
    });
});
