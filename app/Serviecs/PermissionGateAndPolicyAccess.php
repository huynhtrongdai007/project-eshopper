<?php

namespace App\Serviecs;
use Illuminate\Support\Facades\Gate;



class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess() {
        $this->defineGateCategory();
    }

    public function defineGateCategory() {
        Gate::define('category-list','App\Policies\CategoryPolicy@view');
        Gate::define('category-create','App\Policies\CategoryPolicy@create');
        Gate::define('category-update','App\Policies\CategoryPolicy@update');
        Gate::define('category-delete','App\Policies\CategoryPolicy@delete');
    }

}