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
     * The attributes that are dates.
     *
     * @var array
     */	
	protected $dates = ['date'];			
		
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','receiver_company_id','date','code','name','base','taxes','total','status'
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
			"company_id" => [	
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
			"code" => [
				"type" => "text",
				"nullable" => true,
				"minLength" => 1,
				"maxLength" => 9,
				"masks" => ["numeric"]
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
		],		
		"validation" => [
			"rules" => [
				"company_id" => 'bail|required|exists:companies,id',
				"receiver_company_id" => 'bail|required|exists:companies,id',
				"date" => 'bail|nullable|date_format:"d/m/Y"',
				"code" => 'bail|numeric|min:1',
				"name" => 'bail|required|max:64',
				"base" => 'bail|required|regex:/^\d*(\.,\d{1,4})?$/|min:0',
				"taxes" => 'bail|nullable|regex:/^\d*(\.,\d{1,4})?$/|min:0',
				"total" => 'bail|nullable|regex:/^\d*(\.,\d{1,4})?$/|min:0'
			],
			"messages" => [
				"company_id.required" => 'Debe introducirse una empresa emisora',	
				"company_id.exists" => 'La empresa emisora es incorrecta',	
				"receiver_company_id.required" => 'Debe introducirse una empresa receptora',	
				"receiver_company_id.exists" => 'La empresa receptora es incorrecta',
				"date.date_format" => 'El formato de la fecha es incorrecto. Debe ser dd/mm/aaaa',
				"code.numeric" => 'El código de factura tiene que tener un valor numérico',
				"code.min" => 'El código de factura debe ser un número positivo',
				"name.required" => 'Debe introducir un nombre para la factura',
				"name.max" => 'El nombre de la factura no puede tener más de 64 caracteres',
				"base.required" => 'Debe introducir la base imponible de la factura',
				"base.regex" => 'La base imponible de la factura debe ser un número con hasta 4 decimales',
				"base.min" => 'La base imponible de la factura debe ser un número mayor que cero',
				"taxes.regex" => 'La cuota impositiva de la factura debe ser un número con hasta 4 decimales',
				"taxes.min" => 'La cuota impositiva de la factura debe ser un número mayor que cero',
				"total.regex" => 'El total de la factura debe ser un número con hasta 4 decimales',
				"total.min" => 'El total de la factura debe ser un número mayor que cero'
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
        return $this->belongsTo(Company::class,'company_id','id');
    }
	
    /**
     * Invoice receiver
     *
     * @return Company Model
     */
    public function receiver()
	{
        return $this->belongsTo(Company::class,'receiver_company_id','id');
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
