<h2>Asset list returned by character_model->listAssets()</h2>
<pre class="prettyprint">
array(8) {
  [672]=>
  array(4) {
    [0]=>
    array(7) {
      ["itemID"]=>
      string(9) "157284907"
      ["locationID"]=>
      string(8) "60003760"
      ["typeID"]=>
      string(3) "672"
      ["quantity"]=>
      string(1) "1"
      ["flag"]=>
      string(1) "4"
      ["singleton"]=>
      string(1) "1"
      ["rawQuantity"]=>
      string(2) "-1"
    }
    ["name"]=>
    string(15) "Caldari Shuttle"
    ["total"]=>
    int(1)
    ["prices"]=>
    array(2) {
      ["timestamp"]=>
      string(19) "2012-08-13 15:10:31"
      [0]=>
      array(3) {
        ["buy"]=>
        string(9) "19,501.00"
        ["sell"]=>
        string(9) "19,568.69"
        ["margin"]=>
        float(0.35)
      }
    }
  }
  [11132]=>
  array(4) {
    [0]=>
    array(6) {
      ["itemID"]=>
      string(13) "1006164163603"
      ["locationID"]=>
      string(8) "60003760"
      ["typeID"]=>
      string(5) "11132"
      ["quantity"]=>
      string(1) "1"
      ["flag"]=>
      string(1) "4"
      ["singleton"]=>
      string(1) "0"
    }
    ["name"]=>
    string(16) "Minmatar Shuttle"
    ["total"]=>
    int(1)
    ["prices"]=>
    array(2) {
      ["timestamp"]=>
      string(19) "2012-08-13 15:10:32"
      [0]=>
      array(3) {
        ["buy"]=>
        string(9) "17,103.12"
        ["sell"]=>
        string(9) "17,999.99"
        ["margin"]=>
        float(4.98)
      }
    }
  }

...and so on...
</pre>
<h2>Single item stack, as returned from </h2>
<pre class="prettyprint">
array (size=3)
  0 => 
    array (size=7)
      'itemID' => string '1004161663809' (length=13)
      'locationID' => string '60003466' (length=8)
      'typeID' => string '3766' (length=4)
      'quantity' => string '1' (length=1)
      'flag' => string '4' (length=1)
      'singleton' => string '1' (length=1)
      'rawQuantity' => string '-1' (length=2)
  'name' => string 'Vigil' (length=5)
  'total' => int 1
</pre>