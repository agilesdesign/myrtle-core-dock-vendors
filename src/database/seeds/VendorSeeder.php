<?php

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{

    protected $commodities = [
        'Athletic',
        'Auditing',
        'Construction',
        'Education',
        'Facilities',
        'Financial',
        'Food Services',
        'Furnishings',
        'Industrial',
        'Insurance',
        'Legal',
        'Marketing',
        'Media',
        'Medical',
        'Office Equipment',
        'Photography',
        'Technology',
        'Telecommunications',
        'Transportation',
        'Utilities',
        'Waste',
    ];

    protected $certificationTypeFieldTypes = [
        'text',
        'select'
    ];

    protected $certificationTypes = ['Risk Assessment'];

    protected $addressTypes = ['Mailing', 'Billing'];

    protected $phoneTypes = ['Office', 'Mobile', 'Fax'];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    public function run()
    {
        $this->createAddressTypes();
        $this->createCommodities();
        $this->createPhoneTypes();
        $this->createPointParkVendor();
        $this->createPointParkVendorContacts();
        $this->createCertificationFileTypes();
    }

    protected function createAddressTypes()
    {
        foreach ($this->addressTypes as $addressType) {
            \App\Models\AddressType::create(['name' => $addressType]);
        }
    }

    protected function createCommodities()
    {
        foreach ($this->commodities as $commodity) {
            \Myrtle\Core\Commodities\Models\Commodity::create([
                'name' => $commodity
            ]);
        }
    }

    protected function createPhoneTypes()
    {
        foreach ($this->phoneTypes as $phoneType) {
            \App\Models\PhoneType::create(['name' => $phoneType]);
        }
    }

    protected function createCertificationTypeFieldTypes()
    {
        foreach($this->certificationTypeFieldTypes as $type)
        {
            \App\Models\CertificationTypeFieldType::create([
                'type' => $type
                ]
            );
        }
    }

    protected function createPointParkVendor()
    {
        $vendor = Myrtle\Core\Vendors\Models\Vendor::create([
            'name' => 'Point Park University',
            'website' => 'https://pointpark.edu',
            'established_at' => \Carbon\Carbon::createFromDate(1944, 12, 9),
            'ein' => $this->faker->numberBetween(119280, 899218),
            'tin' => $this->faker->numberBetween(119280, 899218),
            'duns' => $this->faker->numberBetween(119280, 899218),
            'full_time_employees' => $this->faker->numberBetween(8, 30),
            'customers_in_state' => $this->faker->numberBetween(14, 85),
            'customers_domestic' => $this->faker->numberBetween(20,115),
            'customers_international' => $this->faker->numberBetween(0,100),
            'contraxx_id' => 1634798,
            'jenzabar_id' => 91273
        ]);

        $address = App\Models\Address::create([
            'type_id' => 1,
            'street' => '201 Wood St.',
            'country' => 'US',
            'zip' => '15642',
            'city' => 'Pittsburgh',
            'state' => 'Pennsylvania'
        ]);

        $vendor->addresses()->attach($address->id);

        $phone = \App\Models\Phone::create([
            'phone' => '412-392-4100',
            'type_id' => 1
        ]);

        $vendor->phones()->attach($phone->id);
    }

    protected function createPointParkVendorContacts()
    {
        $contact = \App\Models\Contact::create([
            'name' => 'Justin Seliga',
            'vendor_id' => 1,
            'email' => 'jseliga@pointpark.edu',
            'title' => 'Web Administrator'
        ]);

        $phone = \App\Models\Phone::create([
            'phone' => '412-392-3419',
            'type_id' => 1
        ]);

        $contact->phones()->attach($phone->id);

        $contact = \App\Models\Contact::create([
            'name' => 'Adam Parker',
            'vendor_id' => 1,
            'email' => 'aparker@pointpark.edu',
            'title' => 'Database Administrator'
        ]);

        $phone = \App\Models\Phone::create([
            'phone' => '412-392-6181',
            'type_id' => 1
        ]);

        $contact->phones()->attach($phone->id);

        $contact = \App\Models\Contact::create([
            'name' => 'Lisa White',
            'vendor_id' => 1,
            'email' => 'lwhite@pointpark.edu',
            'title' => 'Director of Administrative Systems'
        ]);

        $phone = \App\Models\Phone::create([
            'phone' => '412-392-3414',
            'type_id' => 1
        ]);

        $contact->phones()->attach($phone->id);
    }

    protected function createCertificationFileTypes()
    {
        foreach ($this->certificationTypes as $type) {
            \App\Models\CertificationFileType::create([
                'name' => $type,
                'score_sheet' => 'Vendor Assessment',
                'score_column' => 'E',
                'score_row' => '74',
            ]);
        }
    }
}
