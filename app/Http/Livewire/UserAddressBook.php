<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\userAddress;

class UserAddressBook extends Component
{
    public $showPopup = false;
    public $fullName = '';
    public $mobileNumber;
    public $city = '';
    public $area = '';
    public $address = '';
    public $addressType = '';
    protected $listeners = ['resetFormFields' => 'resetFormFields'];
    public $editingaddressId = null;
    public $confirmingDelete = false;
    public $addressToDelete = null;

    protected $rules = [
        'fullName' => 'required|string|max:255',
        'mobileNumber' => 'required|numeric|digits:9',
        'city' => 'required|string|max:255',
        'area' => 'required|string|max:255',
        'address' => 'required|string|max:255', 
        'addressType' => 'required|in:home,office',
    ];

    public function submitForm()
    {
        $this->validate();

        if ($this->editingaddressId !== null) {
            $this->updateAddress();
        } else {
            $this->createAddress();
        }

        $this->resetFormFields();
        $this->showPopup = false;

        session()->flash('success', 'Form submitted successfully!');
    }
    
    public function createAddress()
    {

        userAddress::create([
            'user_id' => auth()->user()->id,
            'name' => $this->fullName,
            'phone' => $this->mobileNumber,
            'city' => $this->city,
            'area' => $this->area,
            'address' => $this->address,
            'address_type' => $this->addressType,
        ]);

        $this->resetFormFields();
        $this->showPopup = true;

        session()->flash('success', 'Form submitted successfully!');
    }


    public function editAddress($addressId)
    {
        $address = userAddress::findOrFail($addressId);
        $this->editingaddressId = $address->id;
        $this->fullName = $address->name;
        $this->mobileNumber = $address->phone;
        $this->city = $address->city;
        $this->area = $address->area;
        $this->address = $address->address;
        $this->addressType = $address->address_type;

        $this->showPopup = true;
    }

    public function updateAddress()
    {
        $address = userAddress::findOrFail($this->editingaddressId);

        $address->update([
            'name' => $this->fullName,
            'phone' => $this->mobileNumber,
            'city' => $this->city,
            'area' => $this->area,
            'address' => $this->address,
            'address_type' => $this->addressType,
        ]);

        $this->resetFormFields();
        $this->editingaddressId = null;
    }

    public function confirmDelete($addressId)
    {
        $this->confirmingDelete = true;
        $this->addressToDelete = $addressId;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->addressToDelete = null;
    }

    public function deleteAddress()
    {
        if ($this->addressToDelete) {
            $address = userAddress::findOrFail($this->addressToDelete);
            $address->delete();
            $this->cancelDelete();
            session()->flash('success', 'Address deleted successfully!');
        }
    }


    public function resetFormFields()
    {
        $this->fullName = '';
        $this->mobileNumber = '';
        $this->city = '';
        $this->area = '';
        $this->address = '';
        $this->addressType = '';
        $this->resetValidation();
    }



    public function render()
    {
        $addresses = userAddress::where('user_id', Auth::user()->id)->get();
        return view('livewire.user-address-book', [
            'addresses' => $addresses,
        ]);
        }
}
