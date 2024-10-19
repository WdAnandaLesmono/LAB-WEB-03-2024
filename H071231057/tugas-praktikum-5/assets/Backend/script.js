const suits = ["C", "D", "H", "S"];
const values = [
    { name: "A", value: 11 },
    { name: "2", value: 2 },
    { name: "3", value: 3 },
    { name: "4", value: 4 },
    { name: "5", value: 5 },
    { name: "6", value: 6 },
    { name: "7", value: 7 },
    { name: "8", value: 8 },
    { name: "9", value: 9 },
    { name: "10", value: 10 },
    { name: "J", value: 10 },
    { name: "Q", value: 10 },
    { name: "K", value: 10 }
];

const blackJackCards = [];

suits.forEach(suit => {
    values.forEach(value => {
        blackJackCards.push({
            name: `${value.name}-${suit}`,
            src: `assets/images/cards/${value.name}-${suit}.png`,
            value: value.value
        });
    });
});

console.log(blackJackCards);


// console.log(blackJackCards.length);

let playerMoney = 0;
let playerDeck = [];
let playerSum = 0;
let betAmount = 0;
let botDeck = [];
let botSum = 0;


let deck = [];

const inputDeposito = document.getElementById("inputDeposito");
const modalStart = new bootstrap.Modal(document.getElementById("modalStart"));

const buttonStart = document.getElementById("buttonStart");
const buttonHit = document.getElementById("buttonHit");
const buttonHold = document.getElementById("buttonHold");
const buttonBet = document.getElementsByClassName("buttonBet");

const textPlayerBet = document.getElementById("textPlayerBet");
const textPlayerSums = document.getElementById("textPlayerSums");
const textPlayerMoney = document.getElementById("textPlayerMoney");

const botDeckContainer = document.getElementById("botDeckContainer");
const playerDeckContainer = document.getElementById("playerDeckContainer");

const textBotSums = document.getElementById("textBotSums");


modalStart.show();

// #code tanpa alert if else deposito
// const startGame = () => {
//     playerMoney = inputDeposito.value;
//     modalStart.hide();
//     startTurn();
// }

// #Kode perkondisian if else inputan deposito
const startGame = () => {
    const depositAmount = parseFloat(inputDeposito.value) ;
    if (depositAmount < 50 ) {
        alert("Tidak mampu jangan berjudi! Tobat!");
        return;
    } else if (depositAmount >= 50) {
        alert("Good Luck!");
       
    }
    playerMoney = depositAmount;
    modalStart.hide();
    startTurn();
}

const startTurn = () => {
    

    if (playerMoney <= 0) {
        alert("UANG HABIS! DEPO LAGI! NEXT GAME MENANG PASTI!!");
        restartGame();
        return;
    }


    deck = shuffle(blackJackCards.slice());

    playerDeck = [];
    playerSum = 0;
    betAmount = 0;
    botDeck = [];
    botSum = 0;
    playerDeckContainer.innerHTML = "";
    botDeckContainer.innerHTML = "";

    addPlayerDeck(getCard());
    addPlayerDeck(getCard());
    addBotDeck(getCard());

    setPlayerMoney(playerMoney);
    setPlayerBet(betAmount);

    disableHitHold(true);
    disableBetButton(false);
}

// kalau nol, beliau balik buat masukkan tabungan
const restartGame = () => {
    modalStart.show(); 
    playerMoney = 0;
    
}


const disableHitHold = (disable) => {

    if (disable) {
        buttonHit.disabled = true;
        buttonHold.disabled = true;
    }else{
        buttonHit.disabled = false;
        buttonHold.disabled = false;
    }
}

const disableBetButton = (disable) => {

    const buttonsArray = Array.from(buttonBet);

    if (disable) {
        buttonsArray.forEach(button => {
            button.disabled = true;
        });
    } else {
        buttonsArray.forEach(button => {
            button.disabled = false;
        });
    }
}

const shuffle = (cards) => {
    for (let i = 0; i < cards.length; i++) {
        const j = Math.floor(Math.random() * (i + 1));
        [cards[i], cards[j]] = [cards[j], cards[i]];
    }
    return cards;
}

const getCard = () => {
    return deck.pop();
}

const hit = () => {
    disableBetButton(true);
    addPlayerDeck(getCard());
    if (playerSum > 21) {
        displayModal('modalKalah');
        disableHitHold(true);
    }
}

const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));
const addBotDeckWithDelay = async (card) => {
    addBotDeck(card);
    await delay(500);
    if (botSum < 17) {
        const nextCard = getCard();
        await addBotDeckWithDelay(nextCard);
    } else {
        finalizeHold();
    }
}

const hold = async () => {
    disableBetButton(true);
    const card = getCard();
    await addBotDeckWithDelay(card);
}

const finalizeHold = () => {
    if (botSum > 21) {
        displayModal('modalMenang');
        setPlayerMoney(playerMoney += (betAmount * 2));
    } else {
        if (playerSum > botSum) {
            displayModal('modalMenang');
            setPlayerMoney(playerMoney += (betAmount * 2));
        } else if (playerSum < botSum) {
            displayModal('modalKalah');
        } else {
            displayModal('modalSeri');
            setPlayerMoney(playerMoney += betAmount);
        }
    }
    disableHitHold(true);
    disableBetButton(false);
}

const placeBet = (amount) => {
    if ((playerMoney -= amount) < 0) {
        playerMoney += amount;
        alert("Uang tidak cukup");
    }else{
        betAmount += amount;
        setPlayerMoney(playerMoney);
        setPlayerBet(betAmount);
        disableHitHold(false);
    }
}

function displayModal(modalId) {
    const modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();

    modal._element.addEventListener('hidden.bs.modal', function () {
        startTurn();
    });
}

const addPlayerDeck = (card) => {
    playerDeck.push(card);
    const img = document.createElement('img');
    img.src = card.src;
    img.alt = card.name;
    img.width = 100;
    img.classList.add('mx-1');
    img.classList.add('swipe-down');
    playerDeckContainer.appendChild(img);
    setPlayerSum(card);
}

const addBotDeck = (card) => {
    botDeck.push(card);
    const img = document.createElement('img');
    img.src = card.src;
    img.alt = card.name;
    img.width = 100;
    img.classList.add('mx-1');
    img.classList.add('swipe-down');
    botDeckContainer.appendChild(img);
    setBotSum(card);
    
    if (botDeck.length <= 1) {
        const backImg = document.createElement('img');
        backImg.src = 'assets/images/cards/BACK.png';
        backImg.alt = 'Flipped';
        backImg.width = 100;
        backImg.classList.add('mx-1');
        backImg.classList.add('swipe-down');
        botDeckContainer.appendChild(backImg);
    } else {
        const backImg = botDeckContainer.querySelector('img[src="assets/images/cards/BACK.png"]');
        if (backImg) {
            botDeckContainer.removeChild(backImg);
        }
    }
}

const setPlayerMoney = (text) => {
    textPlayerMoney.textContent = text;
}
const setPlayerBet = (text) => {
    textPlayerBet.textContent = text;
}
const setPlayerSum = (card) => {
    playerSum += getCardValue(playerSum, card);
    textPlayerSums.textContent = playerSum;
}
const setBotSum = (card) => {
    botSum += getCardValue(botSum, card);
    textBotSums.textContent = botSum;
}
const getCardValue = (currentSum, card) => {
    if (card.value === 11) {
        return (currentSum + 11 > 21) ? 1 : 11;
    }
    return parseInt(card.value);
}