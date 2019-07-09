<?php

namespace Tests\Feature;

use App\Medicine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicineTest extends TestCase
{

    use RefreshDatabase;

    /**
     * This test case will test if the medicine can be added or not
     * nehalk
     */
    public function test_a_medicine_can_be_added()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/medicine', [
            'title'           => 'Paracetamol',
            'expiration_date' => '2019-07-08 15:18:54'
        ]);

        $response->assertOk();

        $this->assertCount(1, Medicine::all());
    }

    /**
     * This test case will test if validation of title is working properly
     * nehalk
     */
    public function test_a_title_is_required()
    {
        $response = $this->post('/medicine', [
            'title'           => '',
            'expiration_date' => '2019-07-08 15:18:54'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /**
     * This test case will test if validation of expiration_date is working properly
     * nehalk
     */
    public function test_an_expiration_date_is_required()
    {
        $response = $this->post('/medicine', [
            'title'           => '',
            'expiration_date' => ''
        ]);

        $response->assertSessionHasErrors('title');
    }

    /**
     * This test case will test if medicine can be updated
     * nehalk
     */
    public function test_a_medicine_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/medicine', [
            'title'           => 'Paracetamol',
            'expiration_date' => '2019-07-08 15:18:54'
        ]);

        $medicine = Medicine::all()->first()[ 'id' ];

        $response = $this->patch('/medicine/' . $medicine, [
            'title'           => 'Vix Action 500',
            'expiration_date' => '2019-07-09 15:18:54'
        ]);

        $response->assertOk();

        $this->assertEquals('Vix Action 500', Medicine::all()->first()[ 'title' ]);
    }
}
