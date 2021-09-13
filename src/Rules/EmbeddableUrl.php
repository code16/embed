<?php

namespace Code16\Embed\Rules;

use Code16\Embed\Exceptions\ServiceNotFoundException;
use Code16\Embed\ServiceFactory;
use Code16\Embed\Services\Fallback;
use Code16\Embed\ValueObjects\Url;
use Illuminate\Contracts\Validation\Rule;

class EmbeddableUrl implements Rule
{
    protected array $allowedServices = [];
    protected ServiceFactory $serviceFactory;

    public function __construct()
    {
        $this->serviceFactory = new ServiceFactory;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $service = $this->serviceFactory::getByUrl(new Url($value));
        } catch (ServiceNotFoundException $th) {
            return false;
        }

        if (count($this->allowedServices) === 0) {
            return true;
        }

        return collect($this->allowedServices)
                ->filter(fn ($allowedService) => $service instanceof $allowedService)
                ->count() > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $allowedServiceClasses = count($this->allowedServices) > 0 ? $this->allowedServices : $this->serviceFactory->serviceClasses();
        $commaSeparatedServiceNames = collect($allowedServiceClasses)
            ->reject(fn ($serviceClass) => $serviceClass === Fallback::class)
            ->map(fn ($serviceClass) => class_basename($serviceClass))
            ->sort()
            ->join(', ', ' or ');

        return "The :attribute must be a URL from one of the following services: $commaSeparatedServiceNames.";
    }

    public function allowedServices(array $services): self
    {
        $this->allowedServices = $services;

        return $this;
    }
}
