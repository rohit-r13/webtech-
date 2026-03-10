<!DOCTYPE html>
<html>
<head>
  <title>Simple Calculator</title>
  <style>
    body {
      font-family:Arial, sans-serif;
      background-color: #f0f8ff;
      display: flex;
      justify-content:center;
      align-items:center;
      height:100vh;
      margin:0;
    }
    .calculator {
      background-color:#1d1d1d;
      padding:20px;
      border-radius: 37px;
      box-shadow:0 0 12px rgba(0, 0, 0, 0.17);
      width:320px;
    }
    h2 {
      text-align: center;
      color:#003366;
      margin-bottom:13px;
    }
    #display {
      width:100%;
      height: 50px;
      font-size: 21px;
      text-align: right;
      margin-bottom: 13px;
      padding: 9px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }
    .buttons {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }
    button {
      padding: 15px;
      font-size: 18px;
      border: none;
      border-radius: 8px;
      background-color: #003366;
      color: white;
      cursor: pointer;
    }
    button:hover {
      background-color: #0055aa;
    }
    .clear {
      background-color:green;
    }
    .clear:hover {
      background-color:darkblue;
    }
    .equal {
      background-color:gray;
    }
    .equal:hover {
      background-color:darkgray;
    }
  </style>
</head>
<body>

  <div class="calculator">
    <h2>Basic Calculator</h2>
    <input type="text" id="display" readonly>
    <div class="buttons">
      <button onclick="addValue('1')">1</button>
      <button onclick="addValue('2')">2</button>
      <button onclick="addValue('3')">3</button>
      <button onclick="addValue('/')">+</button>
      <button onclick="addValue('4')">4</button>
      <button onclick="addValue('5')">5</button>
      <button onclick="addValue('6')">6</button>
      <button onclick="addValue('-')">-</button>
      <button onclick="addValue('7')">7</button>
      <button onclick="addValue('8')">8</button>
      <button onclick="addValue('9')">9</button>
      <button onclick="addValue('*')">*</button>
      <button onclick="addValue('0')">0</button>
      <button class="clear" onclick="clearscn()">C</button>
      <button class="equal" onclick="calresult()">=</button>
      <button onclick="addValue('/')">/</button>
    </div>
  </div>
  <script>
    function addValue(value) {
      var dis = document.getElementById("display");
      var lastcharacter = dis.value.charAt(dis.value.length-1);

      if (
        (lastcharacter==='+'||lastcharacter==='-'||lastcharacter==='*'||lastcharacter==='/') &&
        (value==='+'||value==='-'||value==='*'||value==='/')
      ) {
        alert("invalid inputs");
        return;
      }
      dis.value=dis.value+value;
    }

    function clearscn() {
      document.getElementById("display").value="";
    }
    function calresut() {
      var dis = document.getElementById("display");
      if (dis.value==="") {
        alert("Please enter a number or expression.");
        return;
      }
      try {
        dis.value = eval(dis.value);
      } catch (error) {
        alert("invalid inputs");
        dis.value="";
      }
    }
  </script>
</body>
</html>