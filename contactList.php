<?php
/**
 TASK
 Contact List
    listContact()
    searchContact()
    addContact()
 Every contact must has name and email
 Person Contact
    plus phone number
 Company Contact
    plus address
 */
 /**
  * List of person and company contact
  */
 class ContactList
 {
   protected array $contacts = [];
   public function listContact(){
      foreach ($this->contacts as $key=>$contact) {
         echo "Contact number ". $key. " ". $contact->displayContact();
      }
   }
   public function search($keyWord){
      foreach ($this->contacts as $contact) {
         $contact->searchContact($keyWord);
      }
   }
   public function addContact(Contact $contact){
      $this->contacts[] = $contact;
      return $this;
   }
 }

interface Contact
{
   public function displayContact();
   public function search();
}














?>