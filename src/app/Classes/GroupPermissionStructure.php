<?php

namespace LaravelEnso\RoleManager\app\Classes;

use Illuminate\Support\Collection;
use LaravelEnso\Helpers\Classes\Object;

class GroupPermissionStructure
{
    private $groups;
    private $structure;

    public function __construct(Collection $groups)
    {
        $this->groups = $groups;
        $this->structure = new Object();
        $this->build();
    }

    public function get()
    {
        return $this->structure;
    }

    private function build()
    {
        $this->groups->each(function ($group) {
            $this->fillStructure($group);
        });
    }

    private function fillStructure($group)
    {
        $labels = collect(explode('.', $group->name));
        $count = $labels->count();
        $obj = $this->structure;

        $labels->each(function ($label, $index) use ($count, &$obj, $group) {
            if (!property_exists($obj, $label)) {
                $obj->$label = $index < $count - 1 ? new Object() : $group->permissions;
            }

            $obj = $obj->$label;
        });
    }
}