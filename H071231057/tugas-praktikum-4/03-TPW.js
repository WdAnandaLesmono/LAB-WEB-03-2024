import readline from 'readline';

const hariDalamSeminggu = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

function hitungHariMendatang(hariSekarang, jumlahHari) {
    const indeksHariSekarang = hariDalamSeminggu.map(hari => hari.toLowerCase()).indexOf(hariSekarang.toLowerCase());

    if (indeksHariSekarang === -1) {
        return "Hari tidak valid!";
    }

    const indeksHariMendatang = (indeksHariSekarang + jumlahHari) % 7;

    return hariDalamSeminggu[indeksHariMendatang];
}

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function tanyaHariIni() {
    rl.question('Masukkan hari ini : ', (hariIni) => {

        if (hariDalamSeminggu.map(hari => hari.toLowerCase()).indexOf(hariIni.toLowerCase()) === -1) {
            console.log("Masukkan nama hari yang valid!");
            tanyaHariIni(); 

        } else {
            rl.question('Masukkan jumlah hari yang ingin dihitung: ', (jumlahHari) => {
                jumlahHari = parseInt(jumlahHari);

                if (isNaN(jumlahHari)) {
                    console.log("Jumlah hari harus berupa angka!");
                    tanyaHariIni(); 
                } else {
                    const hariMendatang = hitungHariMendatang(hariIni, jumlahHari);
                    console.log(`Hari ini adalah ${hariIni}, dan ${jumlahHari} hari yang akan datang adalah ${hariMendatang}.`);
                    rl.close(); 
                }
            });
        }
    });
}

tanyaHariIni(); 