<?php
// 插入或更新属性字典
// var data = {"type":1,"typename":"落叶乔木","name":"","ldname","","unit":"株","attribute":"6,8,13"};

require 'pinyin.php';

class attribute 
{
    public static function update($data) {
		if ($data['name']) {
			$attribute_fields = array('jianpin=?');
			$sql_attribute_array = array(getPinyin($data['name']));

			foreach ($data as $key => $value) {
				if ($value) {
					// 逐列处理
					if ($key=='name' || $key=='ldname') {
						$value = str_replace("'", "’", $value);
						$value = str_replace('"', "’", $value);
						$value = str_replace(',', "，", $value);
					}
					array_push($attribute_fields, $key.'=?');
					array_push($sql_attribute_array, $value);
				}
			}

			$db = new db();

			// 检查是否存在，存在更新，不存在插入
			$sql = 'select name from dictionary_attribute where name=?';
			$result = $db->prepare_query( $sql, array($data['name']) );
			// echo json_encode($result).', '.json_encode($sql_grade_array).', '.$sql.'<br><br>';
			if ($result) {
				$sql = 'update dictionary_attribute set '.join(',',$attribute_fields).' where name=?';
				array_push($sql_attribute_array, $data['name']);
			} else {
				$sql = 'insert into dictionary_attribute set '.join(',',$attribute_fields);
			}

			$db->prepare_exec( $sql, $sql_attribute_array );

			// 清楚未匹配关键词
			$sql = 'update dictionary_none set state=1 where name=?';
			$db->prepare_exec( $sql, array( $data['name'] ) );

			// 更新树的拉丁名、单位
			$sql = 'update tree set ldname=?,unit=? where name=?';
			$db->prepare_exec( $sql, array( $data['ldname'], $data['unit'], $data['name'] ) );


			unset($db);
		}
	}
}

?>