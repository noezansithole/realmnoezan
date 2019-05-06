<?php namespace Realm\AddressBook;

use Backend;
use System\Classes\PluginBase;

/**
 * AddressBook Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'AddressBook',
            'description' => 'No description provided yet...',
            'author'      => 'Realm',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        

        return [
            'Realm\AddressBook\Components\ContactList' => 'ContactList',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'realm.addressbook.some_permission' => [
                'tab' => 'AddressBook',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'addressbook' => [
                'label'       => 'AddressBook',
                'url'         => Backend::url('realm/addressbook/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['realm.addressbook.*'],
                'order'       => 500,
            ],
        ];
    }
}
