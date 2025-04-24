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
   public function listContact()
   {
      foreach ($this->contacts as $key => $contact) {
         echo "CONTACT " . ++$key . "<br>";
         $contact->displayContact();
      }
   }
   public function search($keyWord)
   {
      foreach ($this->contacts as $contact) {
         $contact->searchContact($keyWord);
      }
   }
   public function addContact(Contact $contact)
   {
      $this->contacts[] = $contact;
      return $this;
   }
}

interface Contact
{
   public function displayContact();
   public function searchContact($keyWord);
}

abstract class ContactModel
{
   protected $name;
   protected $email;
   public function getName()
   {
      return $this->name;
   }
   public function getEmail()
   {
      return $this->email;
   }
   public function setName(string $name)
   {
      if (empty(trim($name))) {
         die("❌ The name field can't be empty.");
      }
      $this->name = $name;
   }
   public function setEmail(string $email)
   {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         die("❌ The email field is invalid.");
      }
      $this->email = $email;
   }
   public function __construct(array $data)
   {
      if (isset($data["name"])) {
         $this->setName(trim($data["name"]));
      }
      if (isset($data["email"])) {
         $this->setEmail(trim($data["email"]));
      }
   }
   public function displayContact()
   {
      echo "Contact name: " . $this->getName() . "<br>";
      echo "Email: " . $this->getEmail() . "<br>";
   }
   public function searchContact($keyWord)
   {
      if (stripos($this->getName(), $keyWord) !== false) {
         echo $keyWord ." has an overlap with the name value <br>";
         echo $this->displayContact();
      }
      if (stripos($this->getEmail(), $keyWord) !== false) {
         echo $keyWord ." has an overlap with the email value <br>";
         echo $this->displayContact();
      }
   }
}

class PersonContact extends ContactModel implements Contact
{
   protected $phoneNumber;
   public function getPhoneNumber()
   {
      return $this->phoneNumber;
   }
   public function setPhoneNumber(string $phoneNumber)
   {
      if (!preg_match('/^06\d{7,8}$/', $phoneNumber)) {
         echo "❌ Phone number field is invalid.";
      }
      $this->phoneNumber = trim($phoneNumber);
   }
   public function __construct(array $data)
   {
      parent::__construct($data);
      if (isset($data["phoneNumber"])) {
         $this->setPhoneNumber(trim($data["phoneNumber"]));
      }
   }
   public function displayContact()
   {
      parent::displayContact();
      echo "Phone number: " . $this->getPhoneNumber() .  "<br><hr>";
   }
   public function searchContact($keyWord)
   {
      parent::searchContact($keyWord);
      if (stripos($this->getPhoneNumber(), $keyWord) !== false) {
         echo $keyWord ." has an overlap with the phone number value <br>";
         echo $this->displayContact();
      }
   }
}

class CompanyContact extends ContactModel implements Contact
{
   protected $address;
   public function setAddress(string $address){
      if (trim($address) === ""){
         die("❌ Address field can't be empty.");
      }
      $this->address = $address;
   }
   public function getAddress(){
      return $this->address;
   }
   public function __construct(array $data){
      parent::__construct($data);
      if (isset($data["address"])) {
         $this->setAddress($data["address"]);
      }
   }   
   public function displayContact()
   {
      parent::displayContact();
      echo "Address: " . $this->getAddress() .  "<br><hr>";
   }
   public function searchContact($keyWord)
   {
      parent::searchContact($keyWord);
      if (stripos($this->getAddress(), $keyWord) !== false) {
         echo $keyWord ." has an overlap with the address value <br>";
         echo $this->displayContact();
      }
   }
}

$contactList01 = new ContactList();
$contactList01->addContact(new PersonContact([
   "name" => "Petar",
   "email" => "petar@gmail.com",
   "phoneNumber" => "069123456"
]))->addContact(new PersonContact([
   "name" => "Milos",
   "email" => "milos@gmail.com",
   "phoneNumber" => "066458741"
]))->addContact(new CompanyContact([
   "name" => "Development",
   "email" => "development@gmail.com",
   "address" => "Beogradska 33"
]))->addContact(new CompanyContact([
   "name" => "Programming",
   "email" => "programming@gmail.com",
   "address" => "Pancevacka 44"
]));
$contactList01->listContact();
$contactList01->search("milos");
