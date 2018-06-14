<?php

namespace Factum\Models;

class Invoice extends \VivaCMS\Models\Model
{

    /**
     * The model table in database
     *
     * @var string
     */
	protected $table = 'invoices';

    /**
     * The model relations map
     *
     * @var array
     */
	protected $modelRelations = ['company','receiver','items'];	
		
    /**
     * Disable timestamps
     *
     * @var boolean
     */		
	public $timestamps = false; 		
		
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','receiver_company_id','date','name','base','taxes','total','status'
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
			"issuer_company_id" => [	
				"type" => "select",
				"api" => [
					"url" => "companies",
					"obj"=>"obj.reference",
					"params" => [
						"sort" => [["param" => "reference", "order" => "ASC"]]
					]
				]
			],		
			"receiver_company_id" => [
				"type" => "select",
				"api" => [
					"url" => "companies",
					"obj"=>"obj.reference",
					"params" => [
						"sort" => [["param" => "reference", "order" => "ASC"]]
					]
				]
			],
			"date" => [
				"type" => "date"
			],	
			"name" => [
				"type" => "text",
				"minLength" => 2,
				"maxLength" => 128,
			],
			"base" => [
				"type" => "text",
				"maxLength" => 12,
				"masks" => ["coordinate"]
			],	
			"taxes" => [
				"type" => "text",
				"maxLength" => 12,
				"masks" => ["coordinate"]
			],	
			"total" => [
				"type" => "text",
				"maxLength" => 12,
				"masks" => ["coordinate"]
			],				
			"status" => [
				"type" => "boolean"
			]		
		]
	);		

    /**
     * Invoice issuer company
     *
     * @return Company Model
     */
    public function company()
	{
        return $this->belongsTo(Company::class,'company_id','companies','id');
    }
	
    /**
     * Invoice receiver
     *
     * @return Company Model
     */
    public function receiver()
	{
        return $this->belongsTo(Company::class,'receiver_company_id','companies','id');
    }

    /**
     * Invoice items
     *
     * @return InvoiceItem Model
     */
    public function items()
	{
        return $this->hasMany(InvoiceItem::class);
    }	
	
}
