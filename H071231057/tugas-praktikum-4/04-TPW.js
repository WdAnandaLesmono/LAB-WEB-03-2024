const readline = require('readline');


const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});


const angkaTebakan = Math.floor(Math.random() * 100) + 1;
let jumlahPercobaan = 0;

console.log("Selamat datang di permainan Tebak Angka!\nKomputer telah memilih sebuah angka antara 1 dan 100.\nCoba tebak angkanya!");


// Error handling
function validasiInput(tebakanPengguna) {
    if (!Number.isInteger(tebakanPengguna)) {
        return "Masukkan angka bulat yang valid!";
    } else if (tebakanPengguna < 1 || tebakanPengguna > 100) {
        return "Masukkan angka antara 1 dan 100!";
    }
    return null;
}

// Start the game!
function tebakAngka() {
    rl.question('Masukkan salah satu dari angka 1 sampai 100: ', (jawaban) => {
        const tebakanPengguna = parseInt(jawaban);
        jumlahPercobaan++;

        const pesanError = validasiInput(tebakanPengguna);
        if (pesanError) {
            console.log(pesanError);
            tebakAngka();  
        } else if (tebakanPengguna < angkaTebakan) {
            console.log("Terlalu rendah! Coba lagi.");
            tebakAngka();  
        } else if (tebakanPengguna > angkaTebakan) {
            console.log("Terlalu tinggi! Coba lagi.");
            tebakAngka();  
        } else {
            console.log(`Selamat! Kamu berhasil menebak angka ${angkaTebakan} dengan benar.`);
            console.log(`Kamu memerlukan ${jumlahPercobaan}x percobaan.`);
            rl.close();  
        }
    });
}


tebakAngka();