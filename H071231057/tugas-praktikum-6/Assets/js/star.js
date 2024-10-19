 // Menghasilkan bintang
 const starContainer = document.getElementById('stars');
 const numberOfStars = 30;

 for (let i = 0; i < numberOfStars; i++) {
     const star = document.createElement('div');
     const size = Math.random() * 3 + 2;
     const positionX = Math.random() * 100;

     star.style.width = `${size}px`;
     star.style.height = `${size}px`;
     star.style.left = `${positionX}vw`;
     star.style.top = `-${size}px`;
     star.className = 'star';

     const duration = Math.random() * 5 + 5;
     star.style.animationDuration = `${duration}s`;

     starContainer.appendChild(star);
 }

 // Lottie Animation
 const animation = lottie.loadAnimation({
     container: document.getElementById('lottie-animation'),
     renderer: 'svg',
     loop: true,
     autoplay: true,
     path: 'Assets/images/login_fixed.json' 
 });