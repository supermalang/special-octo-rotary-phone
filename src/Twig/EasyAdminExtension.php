<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\Component\Workflow\Workflow;

class EasyAdminExtension extends AbstractExtension
{
    public function __construct( Workflow $wf){
        $this->workflow = $wf;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('next_step', [$this, 'getAllowedTransitions']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    /**
     * Returns only the actions/transitions that are allowed at the current status of the entity
     * @param actions the array of EasyAdmin actions that are passed
     * @param wf_name the Workflow/state machine name
     * @param entity the entity
     */
    public function getAllowedTransitions($actions, string $wf_name, $entity){
        $transitions = $this->workflow->getEnabledTransitions($entity);
        $activeActions = [];

        foreach($actions as $action){
            for($i=0; $i< count($transitions); $i++){
                if($this->workflow->can($entity, $action['name']) && !in_array($action, $activeActions) ){ 
                    $actionName = $action['name'];
                    $activeActions[$actionName] = $action;
                }
            }
        }
        return $activeActions;
    }


    public function doSomething($value)
    {
        // ...
    }
}
