<?php

/* * 
 * 公共模型
 */

namespace Common\Model;
use Think\Model;

class CommonModel extends Model {
    /**
     * 使用正则验证数据  (thinPHP 内置)
     * @param string $value  要验证的数据
     * @param string $rule 验证规则
     */
    public function regex($value,$rule) {
        $validate = array(
            'require'   =>  '/\S+/',
            'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(:\d+)?(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
            'currency'  =>  '/^\d+(\.\d+)?$/',
            'number'    =>  '/^\d+$/',
            'zip'       =>  '/^\d{6}$/',
            'integer'   =>  '/^[-\+]?\d+$/',
            'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
            'english'   =>  '/^[A-Za-z]+$/',
        );
        // 检查是否有内置的正则表达式
        if(isset($validate[strtolower($rule)]))
            $rule       =   $validate[strtolower($rule)];
        return preg_match($rule,$value)===1;
    }
    
    /**
     * 更改指定表的指定字段
     */
    public function updateField(){
        $primary = array(
            'goods' => 'goods_id',
            'goods_category' => 'id',
            'brand' => 'id',
            'goods_attribute' => 'attr_id',
            'ad' =>'ad_id',
        );
        $model = D($_POST['table']);
        $model->$primary[$_POST['table']] = $_POST['id'];
        $model->$_POST['field'] = $_POST['value'];
        $model->save();
        $return_arr = array(
            'status' => 1,
            'msg'   => '操作成功',
            'data'  => array('url'=>U('Admin/Goods/goodsAttributeList')),
        );
        $this->ajaxReturn(json_encode($return_arr));
    }
    
    /**
     * 过滤多余参数
     * @param unknown $data
     * @param unknown $param
     * @return array
     */
    public function param_filter($data, $param){
        $ret_data= array();
        if (empty($data) || empty($param) || !is_array($param)){
            return $ret_data;
        }
        foreach ($param as $val){
            if (isset($data[$val])){
                $ret_data[$val] = $data[$val];
            }else{
                $ret_data[$val] = '';
            }
        }
        return $ret_data;
    }
    
    /**
     * 删除表
     */
    final public function drop_table($tablename) {
        $tablename = C("DB_PREFIX") . $tablename;
        return $this->query("DROP TABLE $tablename");
    }

    /**
     * 读取全部表名
     */
    final public function list_tables() {
        $tables = array();
        $data = $this->query("SHOW TABLES");
        foreach ($data as $k => $v) {
            $tables[] = $v['tables_in_' . strtolower(C("DB_NAME"))];
        }
        return $tables;
    }

    /**
     * 检查表是否存在 
     * $table 不带表前缀
     */
    final public function table_exists($table) {
        $tables = $this->list_tables();
        return in_array(C("DB_PREFIX") . $table, $tables) ? true : false;
    }

    /**
     * 获取表字段 
     * $table 不带表前缀
     */
    final public function get_fields($table) {
        $fields = array();
        $table = C("DB_PREFIX") . $table;
        $data = $this->query("SHOW COLUMNS FROM $table");
        foreach ($data as $v) {
            $fields[$v['Field']] = $v['Type'];
        }
        return $fields;
    }

    /**
     * 检查字段是否存在
     * $table 不带表前缀
     */
    final public function field_exists($table, $field) {
        $fields = $this->get_fields($table);
        return array_key_exists($field, $fields);
    }
    
	/**
	 *  获取当前时间
	 */
	public function mDate() {
		return date ( 'Y-m-d H:i:s' );
	}
	
	/**
	 * 手机号隐藏中间四位
	 */
	function hide_phone($str){
	    $resstr=substr_replace($str,'****',3,4);
	    return $resstr;
	}
	
	/**
	 * 循环报数出列,获取最后一个人
	 * @param 人数 $num
	 * @param 报数 $n
	 */
    public function getLastOne($num, $n){
       $arr = range(1,$num);
       $i = 0;
       while (count($arr) > 1){
           foreach ($arr as $key=>$val){
               $i++;
               if ($i == $n){
                   unset($arr[$key]);
                   $i = 0;
                   break;
               }
           }
       }
       return current($arr);
    }
}

