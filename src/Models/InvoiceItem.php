<?php

namespace Factum\Models;

class InvoiceItem extends \VivaCMS\Models\Model
{

    /**
     * The model table in database
     *
     * @var string
     */
	protected $table = 'invoice_items';

    /**
     * The model relations map
     *
     * @var array
     */
	protected $modelRelations = ['invoice'];	
		
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
        'invoice_id','name','base'
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
			"invoice_id" => [	
				"type" => "select",
				"api" => [
					"url" => "invoices",
					"obj"=>"obj.name",
					"params" => [
						"sort" => [["param" => "name", "order" => "ASC"]]
					]
				]
			],		
			"name" => [
				"type"=>"string",
				"minLength" => 2,
				"maxLength" => 120,
			],
			"base" => [
				"type" => "text",
				"maxLength" => 12,
				"masks" => ["coordinate"]
			]	
		]
	);		

    /**
     * Item Invoice
     *
     * @return Item Model
     */
    public function invoice()
	{
        return $this->belongsTo(Invoice::class);
    }
	
}
