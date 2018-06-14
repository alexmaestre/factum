<?php
namespace VivaCMS\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Ingresos extends Controller{

    /**
     * Get model objects data as JSON
     *
     * @return Response
     */
    public function index($params=null)
    {
		if(config('layer')->type == 2){
			return json_encode($this->all($params),JSON_UNESCAPED_UNICODE);
		}else{
			if(!self::authorize('get')){ throw new ACLException('No dispone de permisos para ver este recurso'); };
			$plural = str_plural(class_basename($this->model));
			if(!empty($this->take)){$params["take"]=$this->take;};
			echo view('vivacms::admin/'.underscore($plural))->with(lcfirst($plural),$this->all($params))->render();			
		}
    }
	
}