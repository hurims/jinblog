const name_key = 'my_name';
const numOfColumns = 5;
const numOfElems = [10,4,10,4,10];
const scrollSpeedMs = 10;
const operators = ['+', '-', '×', '÷']
const calculatable_operators = ['+', '-', '*', '/']

num_elems = [];

elem = document.querySelector('#col0');
for (var i = 0; i < numOfColumns; i++) {
  elem = document.querySelector('#col' + i);
  num_elems.push(elem);
}

score_elem = document.getElementById('score');
rank_desc_elem = document.getElementById('rank_desc');
reset_button = document.getElementById('retry');

const showNumber = (column_index, value) => {
  num_elems[column_index].innerHTML = value;
}

const getValueFromIndex = (column_index, num_index) => {
  elem = num_elems[column_index];
  var value;
  if (elem.className == 'num') {
    value = num_index;
  } else if (elem.className == 'op') {
    value = operators[num_index];
  }
  return value;
}

const getIndexFromValue = (column_index, num_value) => {
  elem = num_elems[column_index];
  var index;
  if (elem.className == 'num') {
    index = parseInt(num_value);
  } else if (elem.className == 'op') {
    index = operators.indexOf(num_value)
  }
  return index;
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
  showNumber(cur_column_index, getValueFromIndex(cur_column_index, cur_num_index));
  startScroll();
};

const hideAllNumbers = () => {
  for (var i = 0; i < numOfColumns; i++) {
    showNumber(i, "")
  }  
}

const getPickedIndex = (column_index) => {
  num_value = num_elems[column_index].innerHTML;
  return getIndexFromValue(column_index, num_value);
}

const showOutput = (show) => {
  score_elem.hidden = !show;
  rank_desc_elem.hidden = !show;
}

const showButton = (show) => {
  reset_button.hidden = !show;
}

const sendResult = (data, callback) => {
  const xhr = new XMLHttpRequest();
  const form = new FormData();

  // Push our data into our FormData object
  for (const [name, value] of Object.entries(data)) {
    form.append(name, value);
  }

  // Define what happens on successful data submission
  xhr.addEventListener("load", (event) => {
  });

  // Define what happens in case of an error
  xhr.addEventListener("error", (event) => {
  });

  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4) {
      callback(xhr.response);
    }
  };  

  // Set up our request
  xhr.open("POST", "http://jyhur.com/game/record.php");

  // Send our FormData object; HTTP headers are set automatically
  xhr.send(form);  
}

const showRanking = (post_response) => {
  // console.log(post_response);
  json = JSON.parse(post_response);
  desc = "Your rank is " + json.total_rank + ".";

  percentile = (json.total_rank * 1. / json.total_count) * 100;
  percentile = Math.round(percentile * 10) / 10;
  desc += " Top " + percentile + "%."

  rank_desc_elem.innerHTML = desc;
}

const finishGame = () => {
  stopScroll();

  num1 = getPickedIndex(0);
  op1 = operators[getPickedIndex(1)];
  num2 = getPickedIndex(2);
  op2 = operators[getPickedIndex(3)];
  num3 = getPickedIndex(4);
  expression = "" + num1 + calculatable_operators[operators.indexOf(op1)] + num2 + calculatable_operators[operators.indexOf(op2)] + num3;
  console.log(expression)
  result = eval(expression);
  if (result == Infinity) {
    result = 0;
  }
  score_elem.innerHTML = result;
  
  name = document.getElementById('name').value
  sendResult({"score": result, "name": name, "expression": expression}, showRanking);

  if (name) {
    localStorage.setItem(name_key, name);
  }

  showOutput(true);
  showButton(true);  
}

const pickNumber = () => {
  cur_column_index++;
  if (cur_column_index == 5) {
    finishGame();
  }
}

const restoreName = () => {
  var name = document.getElementById('name').value
  if (!name) {
    document.getElementById('name').value = localStorage.getItem(name_key);
  }
}

const init = () => {
  spinning = true;
  cur_column_index = 0;
  cur_num_index = 0;

  restoreName();
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
