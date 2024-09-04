<?php

namespace Code16\Embed\Rules;

use Closure;
use Code16\Embed\Exceptions\ServiceNotFoundException;
use Code16\Embed\ServiceFactory;
use Code16\Embed\Services\Fallback;
use Code16\Embed\ValueObjects\Url;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;

class EmbeddableUrl implements ValidationRule
{
    protected array $allowedServices = [];
    protected ServiceFactory $serviceFactory;

    public function __construct()
    {
        $this->serviceFactory = new ServiceFactory;
    }

    public function allowedServices(array $services): self
    {
        $this->allowedServices = $services;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            if($service = $this->serviceFactory::getByUrl(new Url($value))) {
                if (count($this->allowedServices) != 0) {
                    $count = collect($this->allowedServices)
                        ->filter(fn($allowedService) => $service instanceof $allowedService)
                        ->count();
                    
                    if ($count === 0) {
                        $fail($this->unknownServiceMessage());
                    }
                }
            } else {
                $fail($this->unknownServiceMessage());
            }
        } catch (Exception) {
            $fail($this->unknownServiceMessage());
        }
    }

    /** @deprecated use unknownServiceMessage() instead. Will be removed in 3.x */
    protected function message()
    {
    }

    protected function unknownServiceMessage(): string
    {
        // Workaround for deprecation v1.x; remove in 3.x
        if($message = $this->message()) {
            return $message;
        }

        $allowedServiceClasses = count($this->allowedServices) > 0 ? $this->allowedServices : $this->serviceFactory->serviceClasses();
        $commaSeparatedServiceNames = collect($allowedServiceClasses)
            ->reject(fn ($serviceClass) => $serviceClass === Fallback::class)
            ->map(fn ($serviceClass) => class_basename($serviceClass))
            ->sort()
            ->join(', ', ' or ');

        return "The :attribute must be a URL from one of the following services: $commaSeparatedServiceNames.";
    }
}
