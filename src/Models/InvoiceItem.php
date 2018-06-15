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
				"type"=>"text",
				"minLength" => 2,
				"maxLength" => 128,
			],
			"base" => [
				"type" => "text",
				"maxLength" => 12,
				"masks" => ["coordinate"]
			]	
		],
		"validation" => [
			"rules" => [
				"invoice_id" => 'bail|required|exists:invoices,id',
				"name" => 'bail|required|max:128',
				"base" => 'bail|required|regex:/^\d*(\.,\d{1,4})?$/|min:0'
			],
			"messages" => [
				"invoice_id.required" => 'Se debe indicar la factura a la cual se asocia el concepto',
				"invoice_id.exists" => 'El concepto debe pertener a una factura existente',	
				"name.required" => 'Debe indicar un nombre para el concepto',
				"name.max" => 'El nombre del item no puede tener más de 128 caracteres',
				"base.required" => 'Debe introducir la base imponible del concepto',
				"base.regex" => 'La base imponible del concepto debe ser un número con hasta 4 decimales',
				"base.min" => 'La base imponible del concepto debe ser un número mayor que cero'
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
