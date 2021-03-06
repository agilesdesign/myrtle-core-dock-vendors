<?php

namespace Myrtle\Core\Docks;

use Myrtle\Core\Roles\Models\Role;
use Myrtle\Core\Users\Models\User;
use Myrtle\Core\Docks\Facades\Docks;
use Myrtle\Core\Vendors\Models\Vendor;
use Myrtle\Core\Phones\Models\PhoneType;
use Illuminate\Support\Facades\View;
use Myrtle\Core\Addresses\Models\AddressType;
use Myrtle\Core\Vendors\Policies\VendorsPolicy;

class VendorsDock extends Dock
{
    /**
     * Description for Dock
     *
     * @var string
     */
    public $description = 'Vendor management system';

    /**
     * Explicit Gate definitions
     *
     * @var array
     */
    public $gateDefinitions = [
        'vendors.access.admin' => VendorsPolicy::class . '@accessAdmin',
        'vendors.admin' => VendorsPolicy::class . '@admin'
    ];

    /**
     * Policy mappings
     *
     * @var array
     */
    public $policies = [
        Vendor::class => VendorsPolicy::class,
        VendorsPolicy::class => VendorsPolicy::class,
    ];

    /**
     * List of config file paths to be loaded
     *
     * @return array
     */
    public function configPaths()
    {
        return [
            'docks.' . self::class => dirname(__DIR__, 3) . '/config/docks/vendors.php',
            'abilities' => dirname(__DIR__, 3) . '/config/abilities.php',
        ];
    }

    /**
     * List of migration file paths to be loaded
     *
     * @return array
     */
    public function migrationPaths()
    {
        return [
            dirname(__DIR__, 3) . '/database/migrations',
        ];
    }

    /**
     * List of routes file paths to be loaded
     *
     * @return array
     */
    public function routes()
    {
        return [
            'admin' => dirname(__DIR__, 3) . '/routes/admin.php',
        ];
    }

    /**
     * Boot View Composers
     */
    public function viewComposers()
    {
        View::composer('admin::vendors.*', function ($view) {
            $dock = Docks::get('vendors');
            $view->withDock($dock);
        });

        View::composer('admin::vendors.settings.edit', function ($view) {
            $dock = Docks::get('vendors');
            $view->withDock($dock);
        });

        View::composer('admin::docks.vendors.settings.edit', function ($view) {
            $view
                ->withAddresstypes(AddressType::pluck('name', 'id'))
                ->withPhonetypes(PhoneType::pluck('name', 'id'));
        });

        View::composer('admin::*.permissions.edit', function ($view) {
            $users = User::all()->keyBy('id')->map(function ($user, $key) {
                return '(#' . $user->id . ')' . ' ' . $user->name->lastFirst;
            })->toArray();

            $roles = Role::pluck('name', 'id');

            $view->withUsers($users)->withRoles($roles);
        });
    }
}