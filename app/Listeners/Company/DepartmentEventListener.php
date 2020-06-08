<?php

namespace App\Listeners\Company;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\Company\Department\DepartmentCreated;
use App\Events\Company\Department\DepartmentUpdated;
use App\Events\Company\Department\DepartmentDeleted;

class DepartmentEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
    public function onCreated($event)
    {
        logger('Department Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        logger('Department Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        logger('Department Deleted');
    }

    public function subscribe($events)
    {
        $events->listen(
            DepartmentCreated::class,
            'App\Listeners\Company\DepartmentEventListener@onCreated'
        );

        $events->listen(
            DepartmentUpdated::class,
            'App\Listeners\Company\DepartmentEventListener@onUpdated'
        );

        $events->listen(
            DepartmentUpdated::class,
            'App\Listeners\Company\DepartmentEventListener@onDeleted'
        );

    }
}
