<?php

namespace Factum\Console;

use Illuminate\Console\Command;
use VivaCMS\Services\Installation\InstallationManager;

class UninstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factum:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall Factum Package';

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
     * Package controller
     *
     * @var string
     */
    protected $controller = 'Factum\\Controllers';		
	
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
		
		$this->comment(PHP_EOL."Borrando capas");
		InstallationManager::deleteLayers($this->controller);	
		$this->info("Capas borradas)");		
	
		$this->comment(PHP_EOL."Borrando tabla(s)");
		InstallationManager::uninstallSchema($this->schemas);
		$this->info("Datos borrado(s)");	
	
		$this->comment(PHP_EOL."Borrando repositorio(s) de datos");
		InstallationManager::uninstallDataset($this->datasets);
		$this->info("Repositorio(s) de datos borrado(s)");		
		
		$this->comment(PHP_EOL."Eliminado enlace(s) simbólico(s) a assets del package");
		$ls = base_path().'/public/assets/vivazzio';
		if(file_exists($ls)){ unlink($ls); };
		$this->info("Enlace(s) eliminado(s)");			
		
		$endTime = number_format((microtime(true)-$startTime), 2, ',', ' ');
		$this->comment(PHP_EOL."---------------------------------------------");		
        $this->comment("     El plugin Factum ha sido eliminado");
		$this->comment("     Tiempo de desinstalación: ".$endTime." segundos");
		$this->comment("---------------------------------------------".PHP_EOL);
    }
}


