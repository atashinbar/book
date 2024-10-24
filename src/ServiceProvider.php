<?php

namespace BookPlugin;

class ServiceProvider
{
    protected $services = [];

    public function register($service)
    {
        $this->services[] = $service;
    }

    public function boot()
    {
        foreach ($this->services as $service) {
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
}
