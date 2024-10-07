function hitungBilanganGenap(awal, akhir) {
    let totalGenap = 0;
    let daftarGenap = [];
    let angka = awal;

    while (angka <= akhir) {
        if (angka % 2 === 0) {
            totalGenap++;
            daftarGenap.push(angka);
        }
        angka++;
    }

    alert(`Jumlah angka genap: ${totalGenap} (${daftarGenap.join(', ')})`);
}

function tugasNomor1() {
    let angkaAwal = prompt("Masukkan Angka Awal: ");
    let angkaAkhir = prompt("Masukkan Angka Akhir: ");

    
    if (isNaN(angkaAwal) || isNaN(angkaAkhir)) {
        alert("Input harus berupa angka!");
        tugasNomor1(); 
    } else {
        angkaAwal = Number(angkaAwal);
        angkaAkhir = Number(angkaAkhir);

        
        if (!Number.isInteger(angkaAwal) || !Number.isInteger(angkaAkhir)) {
            alert("Input harus berupa bilangan bulat!");
            tugasNomor1(); 
        } else if (angkaAkhir > angkaAwal) {
            hitungBilanganGenap(angkaAwal, angkaAkhir);
        } else {
            alert("Angka akhir harus lebih besar dari angka awal!");
            tugasNomor1(); 
        }
    }
}

function tugasNomor2() {
    let hargaBarang = prompt("Masukkan harga barang: ");
    let kategoriBarang = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ");
    let hargaSetelahDiskon;
    let persentaseDiskon;

    switch (kategoriBarang) {
        case "Elektronik":
            persentaseDiskon = 10;
            hargaSetelahDiskon = hargaBarang - (hargaBarang * 0.10);
            break;
        case "Pakaian":
            persentaseDiskon = 20;
            hargaSetelahDiskon = hargaBarang - (hargaBarang * 0.20);
            break;
        case "Makanan":
            persentaseDiskon = 5;
            hargaSetelahDiskon = hargaBarang - (hargaBarang * 0.05);
            break;
        case "Lainnya":
            persentaseDiskon = 0;
            hargaSetelahDiskon = hargaBarang;
            break;
        default:
            alert("Inputan Salah");
            return;
    }

    alert(`Harga awal: Rp${hargaBarang} \nDiskon: ${persentaseDiskon}% \nHarga setelah diskon: Rp${hargaSetelahDiskon}`);
}

function tugasNomor3() {
    let daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    let jumlahHari = daftarHari.length;

    let hariMulai = prompt("Masukkan hari awal (contoh: Senin): ");
    let jumlahHariMaju = Number(prompt("Masukkan berapa hari ke depan: "));

    let indeksHariMulai = daftarHari.indexOf(hariMulai);

    if (indeksHariMulai !== -1) {
        indeksHariMulai += jumlahHariMaju;
        indeksHariMulai %= jumlahHari;

        alert("Hari nya adalah: " + daftarHari[indeksHariMulai]);
    } else {
        alert("Hari yang dimasukkan tidak valid.");
    }
}

function tugasNomor4() {
    let angkaAcak = Math.floor(Math.random() * 100) + 1;
    console.log(angkaAcak);

    let permainanAktif = true;
    let jumlah = 0;

    let tebakanPengguna = Number(prompt("Masukkan Angka dari 1-100: "));
    if (isNaN(tebakanPengguna)) {
        alert("Input harus berupa angka!");
        tugasNomor4()
    } else {
        while (permainanAktif) {
            jumlah++;
            if (tebakanPengguna === angkaAcak) {
                alert("Mantap, kamu berhasil menebak angka dengan benar!");
                alert(`Jumlah percobaan: ${jumlah}`)
                permainanAktif = false;
            } else if (tebakanPengguna < angkaAcak) {
                alert("Tebakan terlalu kecil, coba lagi!");
    
            } else if (tebakanPengguna > angkaAcak) {
                alert("Tebakan terlalu tinggi, coba lagi!");
            }
    }
    

    }
}

  