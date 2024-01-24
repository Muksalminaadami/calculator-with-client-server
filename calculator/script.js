// script.js

let currentInput = '';
let currentOperation = '';

function appendNumber(number) {
    currentInput += number;
    updateDisplay();
}

function setOperation(operation) {
    currentOperation = operation;
    currentInput += ` ${operation} `;
    updateDisplay();
}

function clearDisplay() {
    currentInput = '';
    currentOperation = '';
    updateDisplay();
}

function calculate() {
    const requestData = {
        operation: currentOperation,
        operand1: parseFloat(currentInput.split(currentOperation)[0]),
        operand2: parseFloat(currentInput.split(currentOperation)[1]),
    };

    fetch('calculator_server.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestData),
    })
    .then(response => response.json())
    .then(data => {
        currentInput = data.result;
        updateDisplay();
    });
}

function updateDisplay() {
    document.getElementById('display').value = currentInput;
}
