<?php

namespace Factum\Models;

class Company extends \VivaCMS\Models\Model
{

    /**
     * The model table in database
     *
     * @var string
     */
	protected $table = 'companies';

    /**
     * The model relations map
     *
     * @var array
     */
	protected $modelRelations = ['user','city','postal_code','customers','providers','invoices'];	
		
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','reference','email','telephone','name','code','address','city_id','postal_code_id','tax_id'
    ];	

    /**
     * Model structure
     *
     * @var array
     */	 
	protected $structure = array(
		'params' => [
			"id" => [
				"type" => "hidden",
				"exportable" => false
			],
			"user_id" => [	
				"type" => "select",
				"api" => [
					"url" => "users",
					"obj"=>"obj.full_name",
					"params" => [
						"sort" => [["param" => "full_name", "order" => "ASC"]]
					]
				]
			],	
			"reference" => [
				"type" => "string",
				"maxLength" => 128
			],
			"email" => [
				"type" => "string",
				"maxLength" => 128,
				"email" => true
			],
			"telephone" => [
				"type" => "string",
				"nullable" => true,
				"minLength" => 9,
				"maxLength" => 9,
				"masks" => ["numeric"]
			],		
			"name" => [
				"type" => "string",
				"maxLength" => 64,
			],			
			"code" => [
				"type" => "string",
				"maxLength" => 64
			],
			"address" => [
				"type" => "string",
				"nullable" => true,
				"maxLength" => 128
			],
			"city_id" => [	
				"type" => "select2",
				"nullable" => true,
				"optionName" => ["city","translation","name"],
				"api" => [
					"url" => "cities",				
					"obj"=>"obj.translation.name + ' (' + obj.state.translation.name + ') '",
					"params" => [
						"with" => ["translation","state.translation"],
						"where"=> [[
							"relation" => "translation",
							"param" => "name",
							"operator" => "LIKE",
							"value" => "%params.term%",
						]],
						"sort" => [[
							"relation" => "translation",
							"param" => "name",
							"order" => "ASC",
						]]
					]
				]
			],			
			"postal_code_id" => [
				"type" => "select2",
				"nullable" => true,
				"optionName" => ["postal_code","code"],
				"api" => [
					"url" => "postal_codes",	
					"objPre"=>"cities_names = '('; for(var i=1; i<=obj.cities.length; i++){ if(i>1){ cities_names += ', '; }; cities_names += obj.cities[(i-1)].translation.name; }; cities_names += ')'; if(obj.code<10000){ paddedCode = '0'+obj.code }else{ paddedCode = obj.code; }",
					"obj"=>"paddedCode + ' ' + cities_names",
					"params" => [
						"where"=> [[
							"param" => "code",
							"operator" => "LIKE",
							"value" => "params.term%",
						]],
						"sort" => [[
							"param" => "code",
							"order" => "ASC",
						]],
						"with" => ["cities.translation"]
					]
				]
			],			
			"tax_id" => [
				"type" => "integer",
			]		
		]
	);		

    /**
     * Company user
     *
     * @return \VivaCMS\Models\User Model
     */
    public function user()
	{
        return $this->belongsTo(\VivaCMS\Models\User::class);
    }
	
    /**
     * Company Customers
     *
     * @return Company Model
     */
    public function customers()
	{
        return $this->belongsToMany(Company::class,'company_customers','company_id','customer_company_id');
    }

    /**
     * Company Providers
     *
     * @return Company Model
     */
    public function providers()
	{
        return $this->belongsToMany(Company::class,'company_customers','customer_company_id','company_id');
    }	
	
    /**
     * Company Invoices
     *
     * @return Invoice Model
     */
    public function invoices()
	{
        return $this->hasMany(Invoice::class);
    }	
	
}
