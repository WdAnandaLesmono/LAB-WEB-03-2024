
const readline = require('readline');

const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout
    });
    
    function CountEvenNumber(start, end) {
            let count = 0;
            let evenNumber = [];
        
            for (let i = start; i <= end; i++) {
                    if (i % 2 === 0) {
                            count++;
                            evenNumber.push(i);
                        }
                
                    }
                    return { count, evenNumber };
                }
                
                rl.question('Masukkan nilai start: ', (start) => {
    rl.question('Masukkan nilai end: ', (end) => {
            const result = CountEvenNumber(parseInt(start), parseInt(end));
            console.log(`Output: ${result.count} (${result.evenNumber.join(', ')})`);
        rl.close();
    });
});



// function CountEvenNumber(start, end) {
//      let count = 0;
//      let evenNumber = [];

//      for (let i = start; i <= end; i++) {
//         if (i % 2 === 0) {
//             count++;
//             evenNumber.push(i)
//         }
//      }
//      return {count, evenNumber} ;
// }

// const result = CountEvenNumber(1,10);
// console.log(`Output: ${result.count} (${result.evenNumber.join(', ')})`);