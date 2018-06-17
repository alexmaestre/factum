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
				"maxLength" => 32
			],
			"name" => [
				"type" => "text",
				"minLength" => 2,
				"maxLength" => 128,
			],
			"base" => [
				"type" => "money",
				"maxLength" => 12,
				"masks" => ["money"]
			],	
			"taxes" => [
				"type" => "money",
				"maxLength" => 12,
				"masks" => ["money"]
			],	
			"total" => [
				"type" => "money",
				"maxLength" => 12,
				"masks" => ["money"]
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
				"code" => 'bail|required|min:1|max:32',
				"name" => 'bail|required|max:64',
				"base" => 'bail|nullable|regex:/^\d*([.,]\d{1,4})?$/|min:0',
				"taxes" => 'bail|nullable|regex:/^\d*([.,]\d{1,4})?$/|min:0',
				"total" => 'bail|nullable|regex:/^\d*([.,]\d{1,4})?$/|min:0'
			],
			"messages" => [
				"company_id.required" => 'Debe introducirse una empresa emisora',	
				"company_id.exists" => 'La empresa emisora es incorrecta',	
				"receiver_company_id.required" => 'Debe introducirse una empresa receptora',	
				"receiver_company_id.exists" => 'La empresa receptora es incorrecta',
				"date.date_format" => 'El formato de la fecha es incorrecto. Debe ser dd/mm/aaaa',
				"code.required" => 'Debe introducir el código o numeración de la factura',
				"code.max" => 'El código o numeración de la factura no puede tener más de 32 caracteres',
				"name.required" => 'Debe introducir un nombre para la factura',
				"name.max" => 'El nombre de la factura no puede tener más de 64 caracteres',
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
	
    /**
     * Recalculate based on items
     *
     * @return string
     */	
    public function recalculate()
    {
		$base = 0;
        foreach($this->items as $item){
			$base = $base + $item->base;
		}
        $this->base = $base;
		$this->calculateTaxesAndTotal();
		parent::save();
    }	
	
    /**
     * Calculat taxes and total
     *
     * @return void
     */	
    public function calculateTaxesAndTotal()
    {
        $this->taxes = $this->base * ($this->receiver->vat->value/100);
        $this->total = $this->base + $this->taxes;
    }	
	
    /**
     * Update taxes and total when invoice is saved
     *
     * @return void
     */	
    public function save(array $options = [])
    {
		$this->calculateTaxesAndTotal();
        parent::save();
    }	
	
}
