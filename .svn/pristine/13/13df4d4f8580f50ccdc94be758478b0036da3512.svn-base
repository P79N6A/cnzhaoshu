<?php
/**
* 项目操作
*/
class record 
{
	/**
	* 查找条件汇总
	*/
	public static function getValue($option, $isWhere)
	{
		if (is_string($option)) $option = json_decode($option, true);
		$fields = array();
		$values = array();

		foreach ($option as $key => $value) {
			if ($isWhere && ($key=='active' || $key=='name')) { 
				// 养护项目，模糊查找
				array_push($fields, "$key like ?");
				array_push($values, '%'.$value.'%');
			} else if ($isWhere && $key=='date') {
				array_push($fields, "date(time)=?");
				array_push($values, $value);
			} else if ($isWhere && $key=='date1') {
				array_push($fields, "date(time)>=?");
				array_push($values, $value);
			} else if ($isWhere && $key=='date2') {
				array_push($fields, "date(time)<=?");
				array_push($values, $value);
			} else {
				array_push($fields, "$key=?");
				array_push($values, $value);
			}
		}

		return array('fields' => $fields, 'values' => $values);
	}

	public static function search($where, $limit) 
	{
		$db = new db();

		// 条件查询，至少有一个flagid
		$where = self::getValue($where, true);
		$sql = 'select * from map_record where '.join(' and ', $where['fields']).' and photo is not null order by time desc';
		if ($limit) $sql .= ' limit '.$limit;
			
		$result = $db->prepare_query($sql, $where['values']);

		unset($db);

		return $result;
	}

	public static function delete($recordid) 
	{
		$db = new db();

		$sql = 'select photo from map_record where id=?';
		$record = $db->prepare_query($sql, array($recordid))[0];

		$sql = 'delete from map_record where id=?';
		$result = $db->prepare_exec($sql, array($recordid));

		unset($db);

		foreach (explode(';', $record['photo']) as $key => $photo) {
			if ($photo) {
				if (substr($photo, -1)=='v') {
					// 视频
					unlink($_SERVER['DOCUMENT_ROOT'].'/videos/'.$photo.'.jpg');
					unlink($_SERVER['DOCUMENT_ROOT'].'/videos/'.$photo.'.mp4');
				} else {
					// 图片
					unlink($_SERVER['DOCUMENT_ROOT'].'/photos/m/'.$photo.'.jpg');
					unlink($_SERVER['DOCUMENT_ROOT'].'/photos/o/'.$photo.'.jpg');
				}
			}
		}

		return $result;
	}

	public static function insert($values) 
	{
		$values = self::getValue($values);
		$sql = 'insert ignore into map_record set '.join(',', $values['fields']);

		$db = new db();
		$recordid = $db->prepare_insert($sql, $values['values']);
		unset($db);

		return $recordid;  // 返回插入后生成的id
	}

	public static function update($value, $recordid) 
	{
		$sql = "update map_record set $value where id=$recordid";
		
		$db = new db();
		$db->exec($sql);
		unset($db);		
	}
}

?>