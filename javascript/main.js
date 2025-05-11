document.querySelectorAll('.btnDetail').forEach(item => {
    item.addEventListener('click', (e) => {
        let card = e.target.closest('.card');
        let gambar = card.querySelector('.card-img-top').src;
        let harga = card.querySelector('.harga').innerHTML;
        let judul = card.querySelector('.card-text').innerHTML;
        let deskripsi = card.querySelector('.deskripsi')? card.querySelector('.deskripsi').innerHTML : '<i>tidak ada informasi yang tersedia</i>'; //pake ? apakah di bagian  deskripsi  ada sebuah class bernama deskripsi jika ada keluarkan innerHTMLnya jika da kasih keterangan

        let tombolModal = document.querySelector('.btnModal'); //variabel
        tombolModal.click(); //aksi

        document.querySelector('.modalTitle').innerHTML = judul;
        let image = document.createElement('img');
        image.src = gambar;
        image.classList.add('w-100');
        document.querySelector('.modalImage').innerHTML = ''
        document.querySelector('.modalImage').appendChild(image);
        document.querySelector('.modalDeskripsi').innerHTML = deskripsi;
        document.querySelector('.modalHarga').innerHTML = harga;

        const nohp = '6289510175754';
        let pesan = `https://api.whatsapp.com/send?phone=${nohp}&text=Hallo kak!saya terterik dengan produk ini &{gambar}`;

        document.querySelector('.btnBeli').href = pesan;

    });
});
