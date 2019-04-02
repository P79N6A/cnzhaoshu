<?php 

class Messageattrbute
{
	public function Order_oneattribute($attribute){
		$str = '';
	    if($attribute['name']) $str .= $attribute['name'].' ';
	    if($attribute['number']) $str .= $attribute['number'].$attribute['unit'].' ';

	    foreach ($attribute as $key => $value) {
	    	if(($key == 'age') && $value) $str .= '苗龄'.$value.'年 ';
	    	if(($key == 'branch_bough_number') && $value) $str .= '分枝数'.$value.'个 ';
	    	if(($key == 'substrate') && $value) $str .= '基质'.$value.'';
	    	if($key == 'dbh'){
	    	    if($attribute['dbh_type'] == '5') $str .= '胸径'.intval(10*$value)/10 .'公分 ';
	    	    if($attribute['dbh_type'] == '6') $str .= '地径'.intval(10*$value)/10 .'公分 ';
	    	    if($attribute['dbh_type'] == '7') $str .= '盆径'.intval(10*$value)/10 .'公分 ';
	    	}
	    	if($key == 'height'){
	    	    if($attribute['height_type'] == '10') $str .= '株高'.intval(10*$value)/10 .'米 ';
	    	    if($attribute['height_type'] == '11') $str .= '条长'.intval(10*$value)/10 .'米 ';
	    	    if($attribute['height_type'] == '12') $str .= '主枝长'.intval(10*$value)/10 .'米 ';
	    	}
	    	if(($key == 'branch_point_height') && $value){
	    	   $str .= '分枝点高'.intval(10*$value)/10 .'米 '; 
	    	} 
	    	if(($key == 'crownwidth') && $value){
	    	    $str .= '冠幅'.intval(10*$value)/10 .'米 ';
	    	}
	    }
	    return $str;
	}

	public function Ordersattribute($attribute){

		$str = '';
		$attributename = ["trunk_diameter"=>"胸径","ground_diameter"=>"地径","plant_height"=>"株高","crown"=>"冠幅","branch_number"=>"分枝数","bough_number"=>"主枝数","age"=>"苗龄","branch_length"=>"条长","bough_length"=>"主蔓(枝)长","branch_point_height"=>"分枝点高","pot_diameter"=>"盆径","plant_height_cm"=>"株高","crown_cm"=>"冠幅","substrate"=>"基质","mark"=>"备注"];
		$attributeunit = ["trunk_diameter"=>"公分","ground_diameter"=>"公分","plant_height"=>"米","crown"=>"米","branch_number"=>"个","bough_number"=>"个","age"=>"年","branch_length"=>"米","bough_length"=>"米","branch_point_height"=>"米","pot_diameter"=>"公分","plant_height_cm"=>"公分","crown_cm"=>"公分","substrate"=>" ","mark"=>" "];
		if($attribute['name']) $str .= $attribute['name'].' ';
		if($attribute['count']) $str .= $attribute['count'].$attribute['unit'].' ';

		foreach ($attribute as $key => $value) {
			if($attributename[$key] && $value){
				$attr = str_replace(',','-',$value);
				$str .= $attributename[$key].':'.$attr.$attributeunit[$key].' ';
			}
		}
		return $str;
	}
}
