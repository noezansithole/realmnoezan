<?php namespace Realm\AddressBook\Components;

use Cms\Classes\ComponentBase;
use Realm\AddressBook\Models\Contacts as ContactsModel;
use Realm\AddressBook\Models\CNumber as CNumberModel;
use Realm\AddressBook\Models\CEmail as CEmailModel;

use Flash;
use Input;
Use Validator;
use Redirect;
use ValidationException;

class ContactItem extends ComponentBase
{
    public $contactitem;
    public function componentDetails()
    {
        return [
            'name'        => 'ContactItem Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'item' => [
                'title'       => 'Business Item',
                'description' => 'Slug for business item',
                'default'     => '{{ :item }}',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun(){
        ### VALIDATE ITEM NUMBER ###
        if($this->property('item') > 0 ){
            $this->contactitem = ContactsModel::find($this->property('item'));
            if(empty($this->contactitem))
              Flash::error("No Item Found ...");  
        }else{
            Flash::error("No Item Found ...");
        }
    }

    ### UPDATE CONTACT NUMBER ###
    public function onUpdateContact(){
        
        $validator = null;
        $validator = Validator::make(
            [
                'firstname' =>  Input::get('firstname'),
                'lastname' =>  Input::get('lastname')
            ],
            [
                'firstname' => 'required',
                'lastname' => 'required'
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        $q = ContactsModel::find($this->property('item'));
        if(!empty($q) && $q->id > 0){
            $q->firstname = Input::get('firstname');
            $q->lastname = Input::get('lastname');
            $q->save();
            Flash::success("Contact updated...");
            return Redirect::refresh();
        }else{
             Flash::error("Error: Could find contact...");
            return;   
        }
    }

    ### SAVE NEW NUMBER ###
    public function onSaveNumber(){
        $validator = Validator::make(
            [
                'contactnumber' =>  Input::get('contactnumber')
            ],
            [
                'contactnumber' => 'required'
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $q = ContactsModel::find($this->property('item'));
        if(!empty($q) && $q->id > 0){
            $cnumber = new CNumberModel();
            $cnumber->contact_id = $q->id;
            $cnumber->contactnumber = Input::get('contactnumber');
            $cnumber->save();
            
            if(!empty($cnumber) && $cnumber->id > 0){
                $i =  ContactsModel::find($this->property('item'));
                $this->page['response'] = $i->contactnumbers;
                Flash::success("New number saved");
                return;
            }else{
              Flash::error("Error: Could not save number...");
              return;   
            }

        }else{
              Flash::error("Could not find contact...");
              return; 
        }
    }

    ### SAVE NEW EMAIL ADDRESS ###
    public function onSaveEmail(){
        $validator = Validator::make(
            [
                'email' =>  Input::get('email')
            ],
            [
                'email' => 'email|required'
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $q = ContactsModel::find($this->property('item'));
        if(!empty($q) && $q->id > 0){
            $cemail = new CEmailModel();
            $cemail->contact_id = $q->id;
            $cemail->email = Input::get('email');
            $cemail->save();
            
            if(!empty($cemail) && $cemail->id > 0){
                $i =  ContactsModel::find($this->property('item'));
                $this->page['response'] = $i->emails;
                Flash::success("New email address saved");
                return;
            }else{
              Flash::error("Error: Could not save email...");
              return;   
            }
        }else{
              Flash::error("Could not find contact...");
              return; 
        }
    }
}
