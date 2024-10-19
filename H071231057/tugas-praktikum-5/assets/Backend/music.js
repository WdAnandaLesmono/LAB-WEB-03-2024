
const backgroundMusic = document.getElementById("backgroundMusic");
const musicToggleButton = document.getElementById("toggleMusic");

// cek
let isMusicPlaying = false;

// on off
musicToggleButton.addEventListener("click", function (e) {
    e.preventDefault(); 

    if (isMusicPlaying) {
        backgroundMusic.pause(); 
        musicToggleButton.textContent = "MUSIC ON"; 
        musicToggleButton.classList.remove("btn-danger"); 
        musicToggleButton.classList.add("btn-success"); 
    } else {
        backgroundMusic.play().then(() => {
            musicToggleButton.textContent = "MUSIC OFF"; 
            musicToggleButton.classList.remove("btn-success"); 
            musicToggleButton.classList.add("btn-danger"); 
        }).catch(error => {
            console.error("Terjadi masalah saat memutar musik: ", error);
        });
    }

    isMusicPlaying = !isMusicPlaying; 
});