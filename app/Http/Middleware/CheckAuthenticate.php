<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Illuminate\Support\Facades\Config;
use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Support\Facades\DB;

class CheckAuthenticate
{
    use UsesTenantModel;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        
        $tenant = $this->getTenantModel()::whereDatabase($request->session()->get('database'))->first();

        if($tenant  != null) {
            $tenant->makeCurrent();
            Config::set("database.connections.tenant.database", $request->session()->get('database'));
        }else {
             Config::set("database.connections.tenant.database", "multitenancy");
        }


        if($request->getPathInfo() === '/logout') {
            Config::set("database.connections.tenant.database", $request->session()->get('database'));
        }


        return $next($request);
    }
}
