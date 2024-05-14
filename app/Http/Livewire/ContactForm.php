<?php

namespace App\Http\Livewire;

use App\Mail\Contact;
use Livewire\Component;


class ContactForm extends Component
{
    public $email;
    public $name;

    protected $rules =[
        'email'=> 'required|email',
        'name'=>'required|min:6'
    ];

    public function submit(){
        $this->validate();

        // Execution doesn't reach here if validation fails.
//        Contact::create([
//            'name' => $this->name,
//            'email' => $this->email,
//        ]);
}
    public function render()
    {
        return view('livewire.contact-form');
    }
}
