<?php
namespace Factum\Providers;

use App;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use VivaCMS\Services\Routing\RoutingManager;

class FactumServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace;
	
	protected $commands = [
        'Factum\Console\InstallCommand','Factum\Console\UninstallCommand'
    ];	

     /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {				
		if(!App::runningInConsole()){ 	
			$layer = RoutingManager::getLayer();
			$path = __DIR__.'/../../resources/routes/'.$layer->router.'.php';
			if(file_exists($path)){ $this->loadRoutesFrom($path); }		
		}
		
        parent::boot();
    }
	
    public function register(){
		
		//Console Commands
		$this->commands($this->commands);
    }
	
}