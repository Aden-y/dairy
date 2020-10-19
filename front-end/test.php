<html>

<head>
  <title></title>
  <style type="text/css">
    div.box {
      width: 10vw;
      height: 8vw;
      background: rgb(0, 200, 0);
      margin: 1vw;
      float: left;
      text-align: center;
      font-size: 5vw;
    }
  </style>
  
  <script type="text/javascript">
    var count = 1;
    function func1() {
      var container = document.getElementById("container");
      var newBox = document.createElement("div");
      newBox.className = "box";
      var last = parseInt(container.lastElementChild.innerHTML);
      newBox.innerHTML = last * 2;
      container.appendChild(newBox);
      count++;
      alert(sum());
    }
    function func2() {
      var container = document.getElementById("container");
      if (count > 1) {
        container.removeChild(container.firstElementChild);
        count--;
      }
    }

    function sum() {
      var container = document.getElementById('container');
      var node = container.firstElementChild;
      var sum = 0.0;
      while(node) {
          sum+= parseInt(node.innerHTML)
          node = node.nextElementSibling;
      }
      return sum;
    }
  </script>
</head>

<body>
  <button id="button1" onClick="func1()">Button 1</button>
  <button id="button2" onClick="func2()">Button 2</button>
  <div id="container">
    <div class="box">1</div>
  </div>
</body>

</html>

<?php
function test($num, $list) {
  $N = count($list);
  if ($num >= $N) {
  echo "$num is out of range";
  }
  else {
  $value = $list[$num];
  $result = 0;
  for ($k=0; $k < $N; $k++) {
  if ($list[$k] < $value) {
  $result += $list[$k];
  }
  }
  echo '$num = '.$num.', $result = '.$result;
  }
  }
  $arr = array(5, 3, 6, 4, 7, 1, 2);

  test(0, $arr);
  echo('<br>');
  test(1, $arr);
  echo('<br>');
  test(7, $arr);
  sizeof($arr);
  $stock = array("A" =>10, "B" => 4, "C" => 6,"D" => 2, "E" => 5, "F" => 1);
  $stock['G'] = 5;

  echo '<table><tr><th>ID</th> <th> Quantity</th></tr>';
  asort($stock);
  foreach ($stock as $key => $value) {
    if($value < 6) {
      echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
    }
    
  }
  echo '</table>';


?>