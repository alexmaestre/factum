<?php

namespace Factum\Console;

use Illuminate\Console\Command;
use VivaCMS\Services\Installation\InstallationManager;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factum:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Factum Package';

    /**
     * Schema repositories path
     *
     * @var string
     */
    protected $schemas = __DIR__.'/../../installation/schemas';		
	
    /**
     * Data repositories path
     *
     * @var string
     */
    protected $datasets = __DIR__.'/../../installation/datasets';	
	
    /**
     * Package layers
     *
     * @var array
     */
    protected $layers = [
		["type"=>1,"https"=>1,"router"=>"factum","namespace"=>"Factum\\Controllers","package"=>"alexmaestre/factum","error_404"=>"404","language_id"=>1,"country_id"=>209,"time_zone_id"=>340,"currency_id"=>1]
	];
	
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$startTime = microtime(true);
				
		$this->comment(PHP_EOL."Creando capas");
		InstallationManager::createLayers($this->layers);
		$this->info("Capa(s) creada(s)");			
		
		$this->comment(PHP_EOL."Cargando tabla(s)");
		InstallationManager::installSchema($this->schemas);	
		$this->info("Tablas cargada(s)");	
		
		$this->comment(PHP_EOL."Cargando repositorio(s)");
		InstallationManager::installDataset($this->datasets);	
		$this->info("Repositorio(s) cargados");		
		
		$this->comment(PHP_EOL."Creando enlace(s) simbólico(s) a assets del package");
		if(!is_link(base_path().'/public/assets/factum')){
			exec('ln -s ../../vendor/alexmaestre/factum/resources/assets/factum '.base_path().'/public/assets/factum');
		};
		$this->info("Enlace(s) creado(s)");			
		
		$this->comment(PHP_EOL."Actualizando configuración y caché de Laravel");
		exec('php '.base_path().'/artisan vendor:publish --provider="Factum\Providers\FactumServiceProvider"');
		exec('php '.base_path().'/artisan config:cache');
		$this->info("Caché y configuración actualizadas");				
		
		$endTime = number_format((microtime(true)-$startTime), 2, ',', ' ');
		$this->comment(PHP_EOL."---------------------------------------------");		
        $this->comment("     El plugin Factum ha sido instalado");
		$this->comment("     Tiempo de instalación: ".$endTime." segundos");
		$this->comment("---------------------------------------------".PHP_EOL);
    }
}


