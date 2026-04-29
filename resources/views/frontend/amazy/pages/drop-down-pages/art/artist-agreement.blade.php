@extends('frontend.amazy.layouts.app')

@section('title')
Artist Agreement | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Artist Agreement | {{ config('app.name') }}">
<meta name="description" content="Artist Agreement terms for working with {{ config('app.name') }}.">
<meta property="og:title" content="Artist Agreement | {{ config('app.name') }}" />
<meta property="og:description" content="Review the Artist Agreement including term, pricing, responsibilities, payment, exhibits, and legal provisions." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

<style>
    .artist-agreement-page{
        li {
            list-style: disc;
        }
    }
</style>

@section('content')
<section class="artist-agreement-page py-50 py-lg-100 overflow-visible">
    <div class="container">
        <div class="mx-auto" style="max-width: 980px;">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-18 line-height-1-2" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic">
                Artist Agreement
            </h1>
            <p class="primary-font text-center fs-18 text-black mb-35" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic">
                This Artist Agreement (the “Agreement”) is effective as of the __ day of __________, 20__ (the “Effective Date”) by and between Two Three-Legged Docs, LLC, a Tennessee limited liability company (“23LD”), and _________________________________ (“Artist” and with 23LD, the “Parties”).
            </p>

            <div class="bg-white radius-16 p-24 p-lg-32 border-gray-light padding-class" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic">
                <p class="primary-font fs-16 text-black mb-16"><strong>WITNESSETH:</strong></p>
                <p class="primary-font fs-16 text-black mb-14">
                    WHEREAS, Artist wishes for 23LD to manage the advertising, marketing, distribution, display, and sale of certain artwork produced by Artist, which as of the date of this Agreement is more particularly described in Exhibit A attached hereto, though may be supplemented by new artwork from time to time (the “Artwork”);
                </p>
                <p class="primary-font fs-16 text-black mb-24">
                    WHEREAS, the Parties wish to provide in greater detail their mutual understanding regarding the benefits and obligations between them regarding the Artwork, as set forth in this Agreement.
                </p>
                <p class="primary-font fs-16 text-black mb-24">
                    NOW THEREFORE, in consideration of the promises and covenants contained herein, the sufficiency and receipt of which is hereby acknowledged, the Parties agree to the following:
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Purpose.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    The purpose of this Agreement is to articulate and set forth the rights, responsibilities, and obligations of the Parties in connection with the Artwork.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Subscription and Term.</h3>
                <p class="primary-font fs-16 text-black mb-12">
                    Contemporaneous with the signing of this Agreement, Artist shall choose between the following subscription levels, each of which includes the services and commission structure outlined in Exhibit B:
                </p>
                <ul class="primary-font fs-16 text-black mb-16 list-unstyled">
                    <li>Beagle Subscription</li>
                    <li>Husky Subscription</li>
                </ul>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Initial Term.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    The initial term of this Agreement shall begin on the Effective Date and end on after a period of one (1) year. (the “Initial Term”), unless earlier terminated pursuant to this Agreement.
                </p>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Automatic Renewal.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    Upon expiration of the Initial Term, this Agreement shall automatically renew for successive one (1) year periods (each, a “Renewal Term,” and together with the Initial Term, the “Term”). The Renewal Term shall be at the same subscription level selected by Artist, unless Artist elects to change subscription level for the Renewal Term, which change shall take effect for all successive terms unless Artist makes another future change to their desired subscription level. 23LD will provide Artist prior notice of the forthcoming automatic Renewal Term. In the event Artist does not wish to continue for a Renewal Term, Artist may notify 23LD at least thirty (30) days prior to the expiration of the Initial Term or the end of each Renewal Term of its desire to terminate this Agreement.
                </p>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Changes to Subscription Level.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    Artist may request to change its subscription level upon written notice to 23LD. Any such change shall take effect at the start of the next Renewal Term unless otherwise agreed in writing by the Parties. 23LD may approve or deny any such subscription level change request made during a Term.
                </p>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Subscription Rates and Commission Adjustments.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    Subscription fees, rates, and earning structure applicable to each subscription level may be modified by 23LD upon at least thirty (30) days’ prior written notice to Artist, provided that any such changes shall not take effect until the next Renewal Term unless otherwise agreed between the Parties.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Termination for Non-Renewal or Non-Payment.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD may suspend services or terminate this Agreement upon notice to Artist if Artist fails to timely pay any applicable subscription fees or otherwise abide by the terms of this Agreement.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Unsold Artwork.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Any unsold Artwork at the end of the Term will be returned to Artist within thirty (30) days.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Pricing of Artwork.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Artwork is priced by the Artist with guidance by 23LD. Upon the setting of the price for the Artwork, 23LD shall not raise or lower prices of Artwork without the prior consent from the Artist.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Shipping Costs.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Artwork uploaded onto any 23LD-affiliated site may have the shipping information automatically provided, which may increase or decrease the shown price of the Artwork. Extra-large pieces within the Artwork may require shipping at a custom price quoted to the customer. A schedule of present Shipping and Handling costs can be provided upon request, and may be updated from time to time. [OR you can create an Exhibit for the schedule of costs if you think the Artist will want to know this on the front end – but if you are specific about these in the Agreement, you should then give them notice of changes, or mention that they may change from time to time]
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Earning Breakdown.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    In exchange for providing the services described herein, 23LD shall be entitled to earn a commission on Artwork sold while under management of 23LD. The earning breakdown and commission structure is more particularly described in Exhibit B attached hereto.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Responsibilities of 23LD.</h3>
                <p class="primary-font fs-16 text-black mb-12">23LD will provide the following services in relation to the Artwork:</p>
                <ol class="primary-font fs-16 text-black mb-20">
                    <li class="mb-10">23LD will facilitate the marketing, promotion and sales of the Artwork on 23LD-affiliated websites, social media accounts, and to vendors;</li>
                    <li class="mb-10">23LD shall consult the Artist on the pricing of their Artwork and services;</li>
                    <li class="mb-10">23LD shall manage the payment of the purchase price for all sold Artwork and shall be responsible for distributing the amount due to the Artist pursuant to Exhibit B;</li>
                    <li class="mb-10">23LD shall provide labels for the Artwork identifying relevant information which may include the title of the piece, the name of the artist, and the sale price of the piece; and</li>
                    <li>23LD shall manage, conduct, and finalize any and all sales for the Artwork, including the packaging, shipping, or delivery of any pieces in the Exhibit which require freight.</li>
                </ol>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Responsibilities of Artist.</h3>
                <p class="primary-font fs-16 text-black mb-12">Artist will provide the following services in relation to the Artwork:</p>
                <ol class="primary-font fs-16 text-black mb-20">
                    <li class="mb-10">Artist shall provide a picture, title, and a description of the medium of the Artwork to 23LD, and shall upload an image of the artwork that is of sufficient clarity and quality to be posted on the 23LD website;</li>
                    <li class="mb-10">Artist shall submit the Artwork to 23LD for approval before display;</li>
                    <li class="mb-10">For sales made through the Website, Artist is responsible for packaging the Artwork in a safe and responsible manger for shipping and delivering the packaged Artwork for shipping; and</li>
                    <li>Artist shall ensure that the Artwork is available in a format able to be mounted and displayed for any exhibit; Artist shall be responsible for the safe and proper installation and display of the Exhibit at the Location.</li>
                </ol>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Artwork Containing Nudity or Sensitive Imagery.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Artwork containing nudity or other such imagery which may not be suitable for viewing or by children and those under the age of 18 may require age verification by the consumer to view on the 23LD website. This determination is at the discretion of 23LD for the purpose of protecting minors. If Artist believes such determination is made in error, Artist may raise such issue with 23LD for consideration, or, upon notice that such Artwork may require age verification, may withdraw the piece from inclusion in the Artwork.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Payment Upon Sale of Art.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Upon the purchase of any Artwork, 23LD shall release to Artist their portion from the sale of the Artwork within thirty (30) days.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Ownership of the Artwork.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Artist is the exclusive and sole owner of the Artwork until such time at the Artwork is sold.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Exclusivity.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Artist grants 23LD exclusivity on the marketing, showcasing, and sale of the Artwork, and during the term of this Agreement shall engage no other third-party vendors or providers for such services in relation to the Artwork. Further, Artist shall not directly market the Artwork or make any arrangement, offer, or promise to sell the Artwork outside of the 23LD-affiliated site without the written consent of 23LD.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Consignment.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Artwork may be consigned in a gallery or location for display and sale for a duration as negotiated between 23LD and various gallery owner or locations. By executing this Agreement, Artist agrees to the consignment of the Artwork for a period of up to eighteen (18) months. In the event Artist wishes to remove any portion of the Artwork from a consignment, Artist must provide such notice to 23LD in writing at least four (4) months in advance.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Damage to Artwork; Shipping.</h3>
                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">General Disclaimer of Liability.</h4>
                <p class="primary-font fs-16 text-black mb-16">
                    23LD shall not be liable for any loss, theft, or damage to the Artist’s artwork while on display or otherwise in the possession or control of third-parties, except to the extent caused by 23LD’s gross negligence or willful misconduct.
                </p>
                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Third-Party Handling and Exhibition.</h4>
                <p class="primary-font fs-16 text-black mb-16">
                    Artist acknowledges that Artwork may be handled, installed, transported, or displayed by third-party venues, contractors, or service providers. 23LD shall not be responsible for the acts or omissions of such third parties, except to the extent required by applicable law.
                </p>
                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Shipping Through Approved Third-Parties.</h4>
                <p class="primary-font fs-16 text-black mb-16">
                    Notwithstanding the foregoing, when Artwork is shipped through 23LD’s designated shipping and packaging partners, 23LD shall use commercially reasonable efforts to ensure that such shipments are handled with appropriate care and coverage. 23LD shall provide or cause to be provided shipping-related liability coverage (which may include carrier-provided insurance or third-party shipping insurance) for loss or damage occurring in transit, subject to the terms, conditions, and limitations of such coverage.
                </p>
                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Claims Cooperation.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    Artist agrees to reasonably cooperate in the submission and processing of any shipping-related claim, including providing documentation of value and condition of the Artwork. Recovery under any such claim shall be the Artist’s sole and exclusive remedy for damage or loss occurring during transit arranged by 23LD.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Early Termination.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    This Agreement may terminate by sixty (60) days’ prior written notice of either Party to the other in such a manner compliant with the Notices provision of this Agreement.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">No Employment Relationship.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    This Agreement is solely for the purposes described herein and does not create any employment, partnership, agency, joint venture, or independent contractor relationship between the Parties. Artist is solely responsible for its own operations, expenses, and taxes.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Data.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD shall have the right to collect, use, and retain data generated through user interactions with its website and related platforms, including but not limited to search queries, page views, click activity, navigation patterns, and other non-personally identifiable usage data (“Usage Data”). Such Usage Data may be used by Company for internal business purposes, including improving website functionality, enhancing user experience, optimizing search results, and developing and implementing marketing and promotional strategies for Company and its artists.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Image of Artwork.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Artist agrees that 23LD may utilize the image of the artwork for the purpose of marketing the artwork and promoting the activities of 23LD. Images of the Artwork shall not be used by 23LD to generate a profit through merchandising without further written agreement between the Parties for the use and replication of the Artwork.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Notices.</h3>
                <p class="primary-font fs-16 text-black mb-12">
                    Required notices under this Agreement shall be made in the manner and to the named persons listed below:
                </p>
                <div class="row g-3 mb-20">
                    <div class="col-12 col-md-6">
                        <div class="p-16 border-gray-light radius-12 padding-class">
                            <p class="primary-font fs-16 text-black mb-8"><strong>If to 23LD:</strong></p>
                            <p class="primary-font fs-16 text-black mb-4 agreement-line">Name: _____________________________</p>
                            <p class="primary-font fs-16 text-black mb-0 agreement-line">[provide mailing address/email address, etc.]</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-16 border-gray-light radius-12 padding-class">
                            <p class="primary-font fs-16 text-black mb-8"><strong>If to Artist:</strong></p>
                            <p class="primary-font fs-16 text-black mb-4 agreement-line">Name: ______________________________</p>
                            <p class="primary-font fs-16 text-black mb-0 agreement-line">[provide mailing address/email address, etc.]</p>
                        </div>
                    </div>
                </div>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Amendments.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    This Agreement may not be amended or modified unless in writing by both Parties.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Complete Agreement.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    This Agreement supersedes all other prior and contemporaneous communications, discussions, or agreements between the Parties with respect to this Exhibit, Location, and other matters contained herein, and this Agreement contains the sole and entire understanding between the Parties.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Default and Enforcement; Attorney’s Fees.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    In the event either Party defaults under this Agreement, the non-defaulting Party may exercise any and all rights and remedies under the laws of the State of Tennessee, including the recovery of attorney’s fees.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Governing Law; Venue.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    The validity and interpretation of this Agreement shall be governed and enforced in accordance with the laws of the State of Tennessee. Any dispute arising from this Agreement requiring court intervention shall be before the appropriate court sitting in Davidson County, Tennessee.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Severability.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    If any provision of this Agreement is found to be invalid or unenforceable, the remainder of the terms herein shall be unaffected and shall be enforced to the fullest extent permitted by law.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Captions.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    The captions, headings, and titles in this Agreement are for convenience only and shall not affect its interpretation.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Counterparts.</h3>
                <p class="primary-font fs-16 text-black mb-24">
                    This Agreement may be signed in any number of counterparts, each of which shall be an original for all purposes, but all of which taken together shall constitute only one Agreement.
                </p>

                <p class="primary-font fs-16 text-black mb-20 fst-italic">[Signature Page Follows]</p>

                <p class="primary-font fs-16 text-black mb-20"><strong>IN WITNESS WHEREOF</strong> the Parties hereby execute this Agreement as of the Effective Date.</p>

                <div class="row g-4 mt-1">
                    <div class="col-12 col-md-6">
                        <div class="p-16 border-gray-light radius-12 h-100 padding-class">
                            <p class="primary-font fs-16 text-black mb-12"><strong>TWO-THREE LEGGED DOGS, LLC:</strong></p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">By: ________________________________</p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">Name:______________________________</p>
                            <p class="primary-font fs-16 text-black mb-0 agreement-line">Its: ______________________________</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-16 border-gray-light radius-12 h-100 padding-class">
                            <p class="primary-font fs-16 text-black mb-12"><strong>ARTIST:</strong></p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">____________________________________</p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">By:______________________________</p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">Name:______________________________</p>
                            <p class="primary-font fs-16 text-black mb-0 agreement-line">Its:______________________________</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4 border-gray-light" />

                <h2 class="secondry-font fs-32 fw-700 text-black text-center mb-6 mt-32">EXHIBIT A</h2>
                <p class="primary-font fs-20 fw-700 text-black text-center mb-20">DESCRIPTION OF ARTWORK</p>

                <h2 class="secondry-font fs-32 fw-700 text-black text-center mb-6">EXHIBIT B</h2>
                <p class="primary-font fs-16 text-black text-center mb-6">EARNING BREAKDOWN AND COMMISSION STRUCTURE</p>
                <p class="primary-font fs-16 text-black text-center mb-24">BY SUBSCRIPTION LEVEL</p>

                <div class="table-responsive mb-24">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <thead>
                            <tr>
                                <th class="w-25">Subscription Level</th>
                                <th>BEAGLE</th>
                                <th>HUSKY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Monthly Cost</th>
                                <td>$0</td>
                                <td>$35</td>
                            </tr>
                            <tr>
                                <th scope="row">Commission due to Artist on art and service sales</th>
                                <td>60%</td>
                                <td>75%</td>
                            </tr>
                            <tr>
                                <th scope="row">Commission due to 23LD on art and service sales</th>
                                <td>40%</td>
                                <td>25%</td>
                            </tr>
                            <tr>
                                <th scope="row">Included Services</th>
                                <td>
                                    <ul class="mb-0 ps-3">
                                        <li>Unlimited art &amp; service listing space</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="mb-0 ps-3">
                                        <li>Unlimited art &amp; service listing space</li>
                                        <li>Priority connections to physical gallery spaces</li>
                                        <li>Profile features on social media and marketing campaigns</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="primary-font fs-16 text-black mb-24">
                    Unlimited art &amp; service listing space, included in both tiers, includes the following, as more further described below:
                </p>
                <ul class="primary-font fs-16 text-black mb-32">
                    <li>Art sales on the 23LD website or through a 23LD representative</li>
                    <li>Art commissions referred to the Artist by 23LD</li>
                    <li>Art murals commissioned through 23LD</li>
                    <li>Art workshops, classes, live paintings, and other events commissioned through 23LD</li>
                </ul>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">1. Art Sales on the 23LD website or through a 23LD representative.</h4>
                <p class="primary-font fs-16 text-black mb-12">
                    When a referral generated by 23LD results in the Artist selling a listed painting, the Artist will be paid commission on the retail value of the art.
                </p>
                <p class="primary-font fs-16 text-black mb-8"><strong>EXAMPLE:</strong></p>
                <div class="table-responsive mb-24">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <thead>
                            <tr>
                                <th>Retail Value of Art</th>
                                <th>Artist Earnings (Beagle)</th>
                                <th>Artist Earning (Husky)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$1,000</td>
                                <td>$600</td>
                                <td>$750</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">2. Art Commissions Referred to the Artist by 23LD</h4>
                <p class="primary-font fs-16 text-black mb-12">
                    When a referral generated by 23LD results in a patron commissioning a piece from the Artist, the Artist will be paid commission on the agreed-upon commissioning price. All sales will be conducted &amp; finalized by 23LD.
                </p>
                <p class="primary-font fs-16 text-black mb-8">*23LD will consult the Artist first to determine an appropriate price for the commission before accepting the client’s bid</p>
                <p class="primary-font fs-16 text-black mb-12">**23LD will reimburse the Artist for the cost of materials/supplies needed for the commissioned piece.</p>
                <p class="primary-font fs-16 text-black mb-8"><strong>EXAMPLE:</strong></p>
                <div class="table-responsive mb-24">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <thead>
                            <tr>
                                <th>Price of Commission</th>
                                <th>Artist Earnings (Beagle)</th>
                                <th>Artist Earning (Husky)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$1,200</td>
                                <td>$720</td>
                                <td>$950</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">3. Art Murals commissioned through 23LD</h4>
                <p class="primary-font fs-16 text-black mb-12">
                    When a referral generated by 23LD results in an Artist being commissioned to paint a mural, the Artist will be paid commission on the agreed-up commission price.
                </p>
                <p class="primary-font fs-16 text-black mb-8">*23LD will consult the Artist first to determine an appropriate price for the commission before accepting the client’s bid.</p>
                <p class="primary-font fs-16 text-black mb-12">**23LD agrees to reimburse the Artist for supplies needed to complete the mural.</p>
                <p class="primary-font fs-16 text-black mb-8"><strong>EXAMPLE:</strong></p>
                <div class="table-responsive mb-24">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <thead>
                            <tr>
                                <th>Agreed-upon price of Mural Commission</th>
                                <th>Artist Earnings (Beagle)</th>
                                <th>Artist Earning (Husky)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$8,000</td>
                                <td>$4,800</td>
                                <td>$6,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">4. Art Workshops, Classes, Live-Paintings, and other live events.</h4>
                <p class="primary-font fs-16 text-black mb-12">
                    When a referral generated by 23LD results in an Artist hosting an art workshop, class, or other live event, the Artist will be paid commission on the agreed-upon fee by the client.
                </p>
                <p class="primary-font fs-16 text-black mb-8">*23LD will consult the Artist first to determine an appropriate price for the commission before accepting the client’s bid. Artist will provide all necessary supplies required for such events. 23LD will not provide, pay for, or reimburse for supplies for live events.</p>
                <p class="primary-font fs-16 text-black mb-8"><strong>EXAMPLE:</strong></p>
                <div class="table-responsive mb-24">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <thead>
                            <tr>
                                <th>Agreed-upon Price for Live Event</th>
                                <th>Artist Earnings (Beagle)</th>
                                <th>Artist Earning (Husky)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$1,500</td>
                                <td>$900</td>
                                <td>$1,125</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="primary-font fs-16 text-black mb-20">
                    IN ADDITION TO THE SERVICES enumerated above, 23LD hosts art shows for artists affiliated with 23LD to showcase artwork. All artists participating in 23LD hosted art shows will receive 75% commission on sold artwork, regardless of subscription tier.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">Art Shows hosted by 23LD</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD will not charge an affiliated artist a booth fee to attend an art show held at one of the 23LD partnered locations. 23LD agrees to pay the Artist a commission of 75% of the retail value of art sold while attending the event regardless of subscription tier. All sales will be completed &amp; finalized by 23LD.
                </p>
                <p class="primary-font fs-16 text-black mb-8"><strong>EXAMPLE:</strong></p>
                <div class="table-responsive mb-0">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <thead>
                            <tr>
                                <th>Price of Commission</th>
                                <th>Artist Earnings (Beagle)</th>
                                <th>Artist Earning (Husky)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$1,000</td>
                                <td>$750</td>
                                <td>$750</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
