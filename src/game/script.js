const numOfColumns = 5;
const numOfElems = [10,4,10,4,10];
const scrollSpeedMs = 10;
const operators = ['+', '-', '*', '/']

num_elems = [];

for (var i = 0; i < numOfColumns; i++) {
  num_elems.push(new Array);

  for (var j = 0; j < numOfElems[i]; j++) {
    elem = document.querySelector('#col' + i + " #n" + j);
    num_elems[i].push(elem);
  }
}

output = document.getElementById('output');
reset_button = document.getElementById('retry');

const showNumber = (column_index_to_change, num_index_to_show) => {
  for (var i = 0; i < numOfElems[column_index_to_change]; i++) {
    num_elems[column_index_to_change][i].hidden = i != num_index_to_show;
  }
}

const startScroll = () => {
  setTimeout(scrollNumber, scrollSpeedMs);
}

const stopScroll = () => {
  spinning = false;
}

const scrollNumber = () => {
  if (!spinning) {
    return;
  }
  cur_num_index = (cur_num_index + 1) % numOfElems[cur_column_index];
  showNumber(cur_column_index, cur_num_index);
  startScroll();
};

const hideAllNumbers = () => {
  for (var i = 0; i < numOfColumns; i++) {
    for (var j = 0; j < numOfElems[i]; j++) {
       num_elems[i][j].hidden = true;
    }
  }  
}

const getPickedIndex = (column_index) => {
  for (var j = 0; j < numOfElems[column_index]; j++) {
     if (!num_elems[column_index][j].hidden) {
      return j;
     }
  }
}

const showOutput = (show) => {
  output.hidden = !show;
}

const showButton = (show) => {
  reset_button.hidden = !show;
}

const finishGame = () => {
  stopScroll();

  num1 = getPickedIndex(0);
  op1 = operators[getPickedIndex(1)];
  num2 = getPickedIndex(2);
  op2 = operators[getPickedIndex(3)];
  num3 = getPickedIndex(4);
  expression = "" + num1 + op1 + num2 + op2 + num3;
  console.log(expression)
  result = eval(expression);
  if (result == Infinity) {
    result = 0;
  }
  output.innerHTML = result;
  
  showOutput(true);
  showButton(true);
}

const pickNumber = () => {
  cur_column_index++;
  if (cur_column_index == 5) {
    finishGame();
  }
}

const init = () => {
  spinning = true;
  cur_column_index = 0;
  cur_num_index = 0;

  showOutput(false);
  hideAllNumbers(cur_column_index);
  showButton(false);
  startScroll();  

  reset_button.addEventListener('click', init, false);
}

init();

document.addEventListener(
  "keydown",
  (event) => {
    const keyName = event.key;
    if (keyName == ' ')
      pickNumber();
  },
  false
);

document.addEventListener("touchstart", pickNumber, false);
