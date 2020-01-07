<?php

namespace Tests\Browser;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewConcertListingTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
//    public function BasicExample()
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/')
//                    ->assertSee('Laravel');
//        });
//    }

    /** @test */
    public function user_can_view_a_concert_listing()
    {
        // Arrange
        // Create a concert
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('December 13, 2016 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555.'
        ]);

        // Act
        // View the concert listing
        $this->browse(function(Browser $browser) use ($concert) {
            $browser->visit('/concerts/' . $concert->id);

            // Assert
            // See the concert details
            $browser->assertSee('The Red Chord');
            $browser->assertSee('with Animosity and Lethargy');
            $browser->assertSee('December 13, 2016');
            $browser->assertSee('8:00pm');
            $browser->assertSee('32.50');
            $browser->assertSee('The Mosh Pit');
            $browser->assertSee('123 Example Lane');
            $browser->assertSee('Laraville, ON 17916');
            $browser->assertSee('For tickets, call (555) 555-5555.');
        });
    }
}
