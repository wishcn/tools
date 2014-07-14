<?php
interface Parse {
    public function where($maps=null);
}

class Model implements Parse {
    public function where($maps=null) {
        $arr = array();
        $pre = "WHERE ";
        $norSymbol = array('eq'=>'=','neq'=>'<>','gt'=>'>','egt'=>'>=','lt'=>'<','elt'=>'<=','like'=>'LIKE',);
        $andSymbol = array('between'=>'BETWEEN','not between'=>'NOT BETWEEN',);
        $mutSymbol = array('in'=>'IN','not in'=>'NOT IN',);
        $empSymbol = array('exp'=>'',);
        $symbol = array_merge($norSymbol, $andSymbol, $mutSymbol, $empSymbol);
        if (!is_array($maps)) {
            return $maps ? $pre.$maps : '';
        }

        foreach ($maps as $field => $map) {
            // 处理字段
            if (!preg_match('/^__/', $field)) {
                $pos = explode('.', $field);
                $field = isset($pos[1]) ? "{$pos[0]}.`{$pos[1]}`" : "`{$pos[0]}`";
            }

            // 处理各种条件
            if ( $field == '__string' ) { // 针对特殊的一些做处理
                $arr[] = "({$map})";
            } else if ( !is_array($map) ) { // 如果不为数组则直接加
                $arr[] = "({$field} = ".$this->filterType($map).")";
            } else if ( is_array($map) && isset($map[0]) && array_key_exists($map[0], $empSymbol) ) { // 处理exp表达示
                $arr[] = "({$field} {$map[1]})";
            } else if ( is_array($map) && isset($map[0]) && array_key_exists($map[0], $norSymbol) ) { // 如果为数组单独处理
                $arr[] = "({$field} {$symbol[$map[0]]} ".$this->filterType($map[1]).")";
            } else if ( is_array($map) && isset($map[0]) && array_key_exists($map[0], $andSymbol) ) { // 处理between表达示
                $arr[] = "({$field} {$symbol[$map[0]]} (".$this->filterType($map[1][0])." AND ".$this->filterType($map[1][1])."))";
            } else if ( is_array($map) && isset($map[0]) && array_key_exists($map[0], $mutSymbol) ) { // 处理in数组
                $arr[] = "({$field} {$symbol[$map[0]]} (".join(', ',$this->filterType($map[1])).")";
            }
        }
        $res = $arr ? $pre.join($arr, ' AND ') : '';
        return $res;
    }

    private function filterType($value) {
        if (is_bool($value) || is_null($value)) {
            return $value ? 1 : 0;
        } else if (is_float($value) || is_int($value) || is_numeric($value)) {
            return $value;
        } else if (is_array($value)) {
            return array_map(array($this,'filterType'), $value);
        } else if (is_null($value)) {
            return 'null';
        } else {
            return '"'.$value.'"';
        }
    }
}

// test for parse::where()
$m = new Model();
$res = $m->where(array(
    'id_gt' => array('gt', 1),
    'status' => '2',
    'time_between' => array(
        'between',
        array(1, 10),
    ),
    'left_between' => array(),
    'id_in' => array(
        'in',
        array(1, 2, 3, 4),
    ),
    'id_exp' => array('exp', 'in (1,2,3,4)'),
    'title_like' => array(
        'like',
        "%{title}%",
    ),
    'pic' => 'img01',
    '__string' => '(is_all = 1 OR store = 1)',
));
echo "test for parse::where(array)\n";
var_dump($res);
echo "\n";

echo "test for parse::where(string)\n";
$res = $m->where('title like "%{title}%"');
var_dump($res);
echo "\n";

echo "test for parse::where(empty)\n";
$res = $m->where('');
var_dump($res);
$res = $m->where(array());
var_dump($res);
$res = $m->where(null);
var_dump($res);
echo "\n";

echo "test for parse::where(boolean)\n";
$res = $m->where(true);
var_dump($res);
$res = $m->where(false);
var_dump($res);
echo "\n";
