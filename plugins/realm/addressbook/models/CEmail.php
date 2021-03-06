<?php namespace Realm\AddressBook\Models;

use Model;

/**
 * CEmail Model
 */
class CEmail extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'realm_addressbook_c_emails';

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
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
