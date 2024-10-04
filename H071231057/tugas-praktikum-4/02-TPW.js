const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function tanyaHarga() {
    rl.question('Masukkan harga barang: ', (hargaInput) => {
        const harga = parseFloat(hargaInput);

        if (isNaN(harga) || harga <= 0) {
            console.error("Harga barang harus berupa angka positif.");
            tanyaHarga();
        } else {
            tanyaJenisBarang(harga);
        }
    });
}

function tanyaJenisBarang(harga) {
    rl.question('Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ', (jenisBarang) => {
        let diskon = 0;
        let validJenisBarang = true;

        switch (jenisBarang.toLowerCase()) {
            case 'elektronik':
                diskon = 10;
                break;
            case 'pakaian':
                diskon = 20;
                break;
            case 'makanan':
                diskon = 5;
                break;
            case 'lainnya':
                diskon = 0;
                break;
            default:
                validJenisBarang = false;
                console.error("Jenis barang tidak valid. Harus salah satu dari Elektronik, Pakaian, Makanan, Lainnya.");
        }

        if (validJenisBarang) {
            const besarDiskon = (diskon / 100) * harga;
            const hargaAkhir = harga - besarDiskon;

            console.log(`\nHarga awal: Rp${harga}`);
            console.log(`Diskon: ${diskon}%`);
            console.log(`Harga setelah diskon: Rp${hargaAkhir.toFixed(0)}`);
            rl.close();
        } else {
            tanyaJenisBarang(harga); 
        }
    });
}

tanyaHarga();








// const hargaInput = prompt("Masukkan harga barang:");
// const harga = parseFloat(hargaInput);

// if (isNaN(harga) || harga <= 0) {
//     console.error("Harga barang harus berupa angka positif.");
// } else {
//     const jenisBarang = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya):").toLowerCase();

//     let diskon = 0;
//     let validJenisBarang = true;

//     switch (jenisBarang) {
//         case 'elektronik':
//             diskon = 10;
//             break;
//         case 'pakaian':
//             diskon = 20;
//             break;
//         case 'makanan':
//             diskon = 5;
//             break;
//         case 'lainnya':
//             diskon = 0;
//             break;
//         default:
//             validJenisBarang = false;
//             console.error("Jenis barang tidak valid. Harus salah satu dari Elektronik, Pakaian, Makanan, Lainnya.");
//     }

//     if (validJenisBarang) {
//         const besarDiskon = (diskon / 100) * harga;
//         const hargaAkhir = harga - besarDiskon;

//         console.log(`Harga awal: Rp${harga}`);
//         console.log(`Diskon: ${diskon}%`);
//         console.log(`Harga setelah diskon: Rp${hargaAkhir.toFixed(0)}`);
//     }
// }
