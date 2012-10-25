Tutorial 5 - Virtual Live Ticket
========================================

This tutorial shows a practical example on how to monetize a live video broadcasting. Typicaly it is used for concerts, theatre shows and conferences.


Click to see a working demo: [Example 5 - Virtual ticket](http://demos.cleeng.com/virtualticket).


**Step 1: Identify page URL where you want to host it.**

General suggestions:

- Leave page empty from main navigation disturbance
- Keep social link for the page promotion
- Have an appealing background
- To make it simple, the site must support php. For large events on sites not using php, please contact us.

**Step 2: You need to decide the service provider you want to use for Live streaming service**

There are multiple services, but we have positive experiences with these:

- [Livestream.com](http://livestream.com)
- [Brightcove](http://brightcove.com)

Please check with your supplier the exact conditions for Live streaming of events. Cleeng doesn't provide such services.

**Step 3: Define your offering**

These are the important elements to have upfront:

- When do you want to start doing pre-booking. At minimum, offer pre-booking 1 to 2 weeks before the show. This way, you can generate more buzz, without impacting your full price ticket sales. Note, we hardly see any cannibalization between real and virtual ticket users. 
- When is the event itself, on which timezones.
- What price for the live show. As a guideline, we recommend that the price of the show is around 1/10th of the event price. Though, it may vary if the event is for very engaged audience. For example, Blizzard Entertainment, producers of World of Warcraft, did in 2011 their live conference in Las Vegas, with a ticket price of $175. They also sold virtual tickets for $39.95 and sold 1000's 
- What is the agenda of the live footage: what people will be able to see, participate, etc.

**Step 4: Design your page**

The page must contain very visibly:

- What are the dates and time for the show (careful with time zones!)
- What are they missing by not joining
- If you offer HD connection (recommended!) mention it, both for the video and sound
- Emphasize the fact the connection works from their home computer, or mobile or tablet.

You can find some examples of creations done on http://cleeng.com.

Or check http://demos.cleeng.com/virtualticket for some essential elements.

**Step 5: Integration**

The protection and access methodologies used for live streaming are very similar to [tutorial 1](../Tutorials/01_Getting_started_with_Cleeng) and [tutorial 2](../Tutorials/02_Loading_content_async). Make sure you are familiar with those. 
In those examples only text is protected and revealed, but now we enhance that by revealing the player.
Most providers provide an easy embed that can be used; please ensure you set-up the right embed to ensure you support both Flash and HTML5 streams.
 
To make the set-up secure; your video service should have domain restrictions enabled for only your domain.

[Download](https://github.com/Cleeng/cleeng-api-tutorials/zipball/master) the full example from Github and place it on your server.

- Use [create_item_offer.php](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/05_Virtual_live_ticket/faq.html) to define your sales offer (see tutorial 1, or the file itself for instructions). You receive an `offerItemId` to be used. 
- Open config.php and fill in your `offerItemId`, and define the exact content that is protected

- Integrate your design with the template package.


**Step6: Customer support needs**

What is important to estimate your traffic and actual ticket sales. For Live Events instant VIP customer support is very important, to be able to react within 30 minutes. 

ALWAYS indicate your sales estimates to Cleeng. Please [contact](http://cleeng.com/company/contact) Cleeng for the options on VIP support.

**Step7: Set-up an FAQ**

To make it easy for you, we prepared a standard FAQ that you only need to customize. They are also in the example package under [faq.html](https://github.com/Cleeng/cleeng-api-tutorials/blob/master/P01_Virtual_live_ticket/faq.html)

**Step8 Tests**

Make a few final tests:

- Purchase the ticket &DoubleRightArrow; you should have instant access
- Close the browser, open it, and go back to the page &DoubleRightArrow; you should have instant access
- Go to cleeng.com, and see if your page is listed in your personal library. Click on the link &DoubleRightArrow; you should have instant access
- Go to a mobile device, log in with Cleeng &DoubleRightArrow; you should have instant access


You are ready to go to start promoting your page!


