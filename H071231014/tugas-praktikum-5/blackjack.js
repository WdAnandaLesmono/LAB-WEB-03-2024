let dealerSum = 0;
let visibleDealerSum = 0;
let playerSum = 0;

let dealerAceCount = 0;
let playerAceCount = 0;

let hidden;
let deck;

let canHit = true;
let gameOver = false;
let playerBalance = 5000;
let currentBet = 0;

window.onload = function() {
    document.getElementById("place-bet").addEventListener("click", placeBet);
    document.getElementById("hit").addEventListener("click", hit);
    document.getElementById("stay").addEventListener("click", stay);
    document.getElementById("restart").addEventListener("click", restartGame);
    updateBalance();
}

function placeBet() {
    let betAmount = parseInt(document.getElementById("bet-amount").value);
    if (betAmount < 100 || betAmount > playerBalance) {
        alert("Invalid bet amount. Please enter a value between $100 and your current balance.");
        return;
    }
    currentBet = betAmount;
    playerBalance -= currentBet;
    updateBalance();
    document.getElementById("bet-container").style.display = "none";
    document.getElementById("game-area").style.display = "block";
    startGame();
}

function startGame() {
    deck = createDeck();
    shuffleDeck(deck);
    dealerSum = 0;
    visibleDealerSum = 0;
    playerSum = 0;
    dealerAceCount = 0;
    playerAceCount = 0;
    canHit = true;
    gameOver = false;

    document.getElementById("dealer-cards").innerHTML = "";
    document.getElementById("player-cards").innerHTML = "";
    document.getElementById("results").innerText = "";

    hidden = deck.pop();
    let hiddenImg = document.createElement("img");
    hiddenImg.src = "./cards/BACK.png";
    hiddenImg.id = "hidden-card";
    document.getElementById("dealer-cards").append(hiddenImg);
    dealerSum += getValue(hidden);
    dealerAceCount += checkAce(hidden);

    let visibleCard = deck.pop();
    addCardToDealer(visibleCard);
    visibleDealerSum += getValue(visibleCard);
    dealerSum += getValue(visibleCard);
    dealerAceCount += checkAce(visibleCard);

    for (let i = 0; i < 2; i++) {
        let card = deck.pop();
        addCardToPlayer(card);
        playerSum += getValue(card);
        playerAceCount += checkAce(card);
    }

    document.getElementById("hit").disabled = false;
    document.getElementById("stay").disabled = false;

    updateScores();
}

function hit() {
    if (!canHit) return;

    let card = deck.pop();
    addCardToPlayer(card);
    playerSum += getValue(card);
    playerAceCount += checkAce(card);

    if (reduceAce(playerSum, playerAceCount) > 21) {
        canHit = false;
        document.getElementById("hit").disabled = true;
        stay();
    }

    updateScores();
}

function stay() {
    canHit = false;
    document.getElementById("hit").disabled = true;
    document.getElementById("stay").disabled = true;


    let hiddenImg = document.getElementById("hidden-card");
    hiddenImg.src = "./cards/" + hidden + ".png";


    while (dealerSum < 17) {
        let card = deck.pop();
        addCardToDealer(card);
        dealerSum += getValue(card);
        dealerAceCount += checkAce(card);
    }

    dealerSum = reduceAce(dealerSum, dealerAceCount);
    playerSum = reduceAce(playerSum, playerAceCount);

    gameOver = true;
    updateScores();

    let message = "";
    if (playerSum > 21) {
        message = "You Lose!";
    } else if (dealerSum > 21) {
        message = "You Win!";
        playerBalance += currentBet * 2;
    } else if (playerSum == dealerSum) {
        message = "Tie!";
        playerBalance += currentBet;
    } else if (playerSum > dealerSum) {
        message = "You Win!";
        playerBalance += currentBet * 2;
    } else if (playerSum < dealerSum) {
        message = "You Lose!";
    }

    document.getElementById("results").innerText = message;
    updateBalance();

    if (playerBalance <= 0) {
        gameOver = true;
        document.getElementById("game-over").style.display = "flex";
    } else {
        setTimeout(() => {
            document.getElementById("bet-container").style.display = "block";
            document.getElementById("game-area").style.display = "none";
        }, 3000);
    }
}

function updateScores() {
    if (gameOver) {
        document.getElementById("dealer-score").innerText = dealerSum;
    } else {
        document.getElementById("dealer-score").innerText = visibleDealerSum;
    }
    document.getElementById("player-score").innerText = reduceAce(playerSum, playerAceCount);
}

function createDeck() {
    let ranks = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
    let suits = ["C", "D", "H", "S"];
    let deck = [];

    for (let i = 0; i < suits.length; i++) {
        for (let j = 0; j < ranks.length; j++) {
            deck.push(ranks[j] + "-" + suits[i]);
        }
    }

    return deck;
}

function shuffleDeck(deck) {
    for (let i = 0; i < deck.length; i++) {
        let j = Math.floor(Math.random() * deck.length);
        let temp = deck[i];
        deck[i] = deck[j];
        deck[j] = temp;
    }
}

function getValue(card) {
    let data = card.split("-");
    let value = data[0];

    if (isNaN(value)) {
        if (value == "A") {
            return 11;
        }
        return 10;
    }
    return parseInt(value);
}

function checkAce(card) {
    if (card[0] == "A") {
        return 1;
    }
    return 0;
}

function reduceAce(playerSum, playerAceCount) {
    while (playerSum > 21 && playerAceCount > 0) {
        playerSum -= 10;
        playerAceCount -= 1;
    }
    return playerSum;
}

function addCardToPlayer(card) {
    let cardImg = document.createElement("img");
    cardImg.src = "./cards/" + card + ".png";
    document.getElementById("player-cards").append(cardImg);
}

function addCardToDealer(card) {
    let cardImg = document.createElement("img");
    cardImg.src = "./cards/" + card + ".png";
    document.getElementById("dealer-cards").append(cardImg);
}

function updateBalance() {
    document.getElementById("balance-amount").innerText = playerBalance;
}

function restartGame() {
    playerBalance = 5000;
    updateBalance();
    document.getElementById("game-over").style.display = "none";
    document.getElementById("bet-container").style.display = "block";
    document.getElementById("game-area").style.display = "none";
}