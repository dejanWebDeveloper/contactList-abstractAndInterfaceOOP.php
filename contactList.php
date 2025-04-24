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

abstract class ContactModel
{
   protected $name;
   protected $email;
   public function getName(){
      return $this->name;
   }
   public function getEmail(){
      return $this->email;
   }
   public function setName(string $name){
      if (empty(trim($name))){
         die("The name field can't be empty.");
      }
      $this->name = $name;
   }
   public function setEmail(string $email){
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
         die("The email field is invalid.");
      }
      $this->email = $email;
   }
   public function __construct(array $data){
      if (isset($data["name"])){
         $this->setName(trim($data["name"]));
      }
      if (isset($data["email"])){
         $this->setEmail(trim($data["email"]));
      }
   }
}

/*
Person Contact
plus phone number
Company Contact
plus address
*/












?>