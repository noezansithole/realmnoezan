<?php namespace Realm\AddressBook\Models;

use Model;

/**
 * Contacts Model
 */
class Contacts extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'realm_addressbook_contacts';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
     public $hasMany = [
        
        'emails' => ['Realm\AddressBook\Models\CEmail','key'=>'contact_id'],
        'contactnumbers' => ['Realm\AddressBook\Models\CNumber','key'=>'contact_id']
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
