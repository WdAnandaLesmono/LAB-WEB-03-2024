function countEvenNumbers(start, end) {
    let count = 0;
    let evenNumbers = [];

    for (let i = start; i <= end; i++) {
        if (i % 2 === 0) {
            count++;
            evenNumbers.push(i);
        }
    }
    console.log(`Bilangan genap : ${evenNumbers.join(', ')}`);
    return count;
}
console.log(`Jumlah bilangan genap : ${countEvenNumbers(1, 10)}`);