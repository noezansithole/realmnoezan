<?php namespace Realm\AddressBook\Components;

use Cms\Classes\ComponentBase;
use Realm\AddressBook\Models\Contacts as ContactsModel;

use Flash;
use Input;
Use Validator;
use Redirect;
use ValidationException;



class ContactList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'ContactList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function listcontacts(){
        return ContactsModel::all();
    }
    
    ### DELETE MAIL CONTACT ITEM ###
    public function onDelete(){
       
        $q = ContactsModel::find(Input::get('id'));
        if(!empty($q) && $q->id > 0){
            ##DELETE CHILDREN ##
            foreach ($q->emails as $key => $value) {
                 $value->delete();
            }

            foreach ($q->contactnumbers as $key => $value) {
                 $value->delete();
            }

            ### DELETE MAIN CONTACT ###
            $q->delete();
            Flash::success("Contact deleted");
            return Redirect::refresh();
        }else{
            Flash::error("Could not find contact...");
            return; 
        }
    }

    ### SAVE MAIN CONTACT NUMBER ###
    public function onSave(){
       
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
       
        $q = new ContactsModel;       
        $q->firstname = Input::get('firstname');
        $q->lastname = Input::get('lastname');
        $q->save();
      
        if($q->id > 0){
            Flash::success("New Contact saved...");
            return Redirect::refresh();   
        }else{
            Flash::error("Error: Could not add contacts...");
            return; 
        }
    }
       

}
