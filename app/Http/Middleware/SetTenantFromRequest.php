<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
// use Symfony\Component\HttpFoundation\Response;

class SetTenantFromRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Let's see if already checked
        if (! empty($request->session()->get('current_tenant_url')) && str_contains(url()->current(), $request->session()->get('current_tenant_url'))) {
            return $next($request);
        }

        // Just one query
        $tenants = Tenant::select(['id', 'method', 'method_value', 'name', 'logo_path'])->get();

        // URL segment method
        $url_segment = $request->segment(1);
        $tenant = $tenants->where('method', 'url_segment')
            ->where('method_value', $url_segment)
            ->first();

        // Subdomain method
        if (! $tenant) {
            list($subdomain) = explode('.', $request->getHost(), 2);
            $tenant = $tenants->where('method', 'subdomain')
            ->where('method_value', $subdomain)
            ->first();
        }

        // Domain method
        if (! $tenant) {
            $domain = $request->getHost();
            $tenant = $tenants->where('method', 'domain')
                ->where('method_value', $domain)
                ->first();
        }

        // Assigning tenant
        if ($tenant) {
            // Set the current tenant
            $this->setTenantConfig($tenant);
        } else {
            // No tenant recognized. Set not found
            abort('404');
        }

        return $next($request);
    }


    public function setTenantConfig(Tenant $tenant, Request $request)
    {
        if ($tenant->method == 'url_segment') {
            $url = $request->getHost().'/'.$request->segment(1);
        } else {
            $url = $request->getHost();
        }
        $request->session()->put('current_tenant_url', $url);
        $request->session()->put('current_tenant_id', $tenant->id);
        $request->session()->put('current_tenant_name', $tenant->name);
        $request->session()->put('current_tenant_logo_path', $tenant->logo_path);
        // config([
        //     'tenancy.current_tenant_id' => $tenant->id,
        //     'tenancy.current_tenant_name' => $tenant->name,
        //     'tenancy.current_tenant_logo_path' => $tenant->logo_path,
        // ]);
    }
}
