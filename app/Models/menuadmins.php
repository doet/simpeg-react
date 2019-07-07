<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class menuadmins extends Model
{

  public static function get_data($induk=0)
  {
 		$data = array();
	  $query = self::where('parent_id', '=', $induk)
      ->where(function ($q){
        $q->where('akses', 'like', '%'.Auth::user()->id.'%');
      })
      ->get();

		foreach($query as $row){
			$data[] = array(
				'id'	=>$row->id,
				'parent'=>$row->parent_id,
				'nama'	=>$row->label,      
				'part'	=>$row->part,
				'icon'	=>$row->icon,
				'child'	=>self::get_data($row->id),
				'akses' =>$row->akses,
			);
		}
		return $data;
	}

	public static function var_menu($induk=0)
	{
		$query = self::where('id', '=', $induk)->first();

		$data = array(
			'id'	=>$query['id'],
			'parent'=>$query['parent_id'],
			'nama'	=>$query['label'],
			'part'	=>$query['part'],
			'icon'	=>$query['icon'],
			'akses' =>$query['akses'],
		);

		if ($query['parent_id']!=0){
			$data[]=self::var_menu($query['parent_id']);
		}
		return $data;
	}

	public static function aktif_menu($induk=0)
	{
		$var=self::var_menu($induk);

		$n= $var['parent'];
		if ($var['parent']==0)$data[]=$var;
		while($n > 0) {

			$data[] =  $var;

			$var= $var[0];
			$n=$var['parent'];
			//$n=0;
			if ($var['parent']==0)$data[] =  $var;
		}

		return $data;
	}

}
