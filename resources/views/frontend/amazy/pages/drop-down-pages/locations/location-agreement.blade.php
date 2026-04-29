@extends('frontend.amazy.layouts.app')

@section('title')
Location Agreement | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Location Agreement | {{ config('app.name') }}">
<meta name="description" content="Location Agreement terms for partners hosting exhibits with {{ config('app.name') }}.">
<meta property="og:title" content="Location Agreement | {{ config('app.name') }}" />
<meta property="og:description" content="Review the Location Agreement including term, payment tiers, exhibits, responsibilities, liability, and legal provisions." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection
<style>
    .location-agreement-page{
        li {
            list-style: disc;
        }
    }
</style>
@section('content')
<section class="location-agreement-page py-50 py-lg-100 overflow-visible">
    <div class="container">
        <div class="mx-auto" style="max-width: 980px;">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-18 line-height-1-2" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic">
                Location Agreement
            </h1>
            <p class="primary-font text-center fs-18 text-black mb-35" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic">
                This Location Agreement (the “Agreement”) is effective as of the __ day of __________, 20__ (the “Effective Date”) by and between Two Three-Legged Docs, LLC, a Tennessee limited liability company (“23LD”), and _________________________________ (“Partner” and with 23LD, the “Parties”).
            </p>

            <div class="bg-white radius-16 p-24 p-lg-32 border-gray-light padding-class" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic">
                <p class="primary-font fs-16 text-black mb-16"><strong>WITNESSETH:</strong></p>
                <p class="primary-font fs-16 text-black mb-14">
                    WHEREAS, Partner wishes to host a temporary art exhibit containing art pieces created and owned by various artists and managed by 23LD, as more particularly described in Exhibit A attached hereto (the “Exhibit”);
                </p>
                <p class="primary-font fs-16 text-black mb-12">
                    WHEREAS, Partner wishes to host the Exhibit at the following location or locations:
                </p>
                <p class="primary-font fs-16 text-black mb-4 agreement-line">
                    ______________________________________________________________________________
                </p>
                <p class="primary-font fs-16 text-black mb-14 agreement-line">
                    _______________________________________________ (collectively, the “Location”); and
                </p>
                <p class="primary-font fs-16 text-black mb-24">
                    WHEREAS, the Parties wish to provide in greater detail their mutual understanding regarding the benefits and obligations between them regarding the Exhibit, as set forth in this Agreement.
                </p>
                <p class="primary-font fs-16 text-black mb-24">
                    NOW THEREFORE, in consideration of the promises and covenants contained herein, the sufficiency and receipt of which is hereby acknowledged, the Parties agree to the following:
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Purpose.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    The purpose of this Agreement is to articulate and set forth the rights, responsibilities, and obligations of the Parties in connection with the Exhibit.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Term.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    This Agreement shall be in full force and effect beginning on the Effective Date and ending on the later of the date of (a) ________________, 20__, or (b) the last date and time in which the Exhibit is on display in, transfer or delivery between, or on site of any Location, unless such Agreement is terminated by either Party as provided herein (the “Term”).
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Payment and Service Tier.</h3>
                <p class="primary-font fs-16 text-black mb-12">
                    Partner shall pay to 23LD a price of  _________ for the Term (the “Payment”), which may be made in monthly installments of ___________ per month for the Term. This Payment is based upon the tiered offerings, each of which includes the services and may require payment on a schedule outlined in Exhibit B. Contemporaneous with the signing of this Agreement, the Partner shall choose one of the following service tiers:
                </p>
                <ul class="primary-font fs-16 text-black mb-20 list-unstyled">
                    <li>Beagle Tier</li>
                    <li>Husky Tier</li>
                    <li>Mastiff Tier</li>
                </ul>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Responsibilities of 23LD.</h3>
                <p class="primary-font fs-16 text-black mb-12">23LD will provide the following services in relation to the Exhibit:</p>
                <ol class="primary-font fs-16 text-black mb-20">
                    <li class="mb-10">23LD shall manage the delivery and installation of the Exhibit at the Location;</li>
                    <li class="mb-10">23LD shall advertise and market the Exhibit on 23LD-affiliated websites and social media accounts;</li>
                    <li class="mb-10">23LD shall provide labels for all pieces in the Exhibit identifying relevant information which may include the title of the piece, the name of the artist, and the sale price of the piece;</li>
                    <li class="mb-10">23LD shall manage, conduct, and finalize any and all sales for the displayed pieces in the Exhibit, including the packaging, shipping, or delivery of any pieces in the Exhibit which require freight; and</li>
                    <li>23LD shall rotate and manage available inventory for the Exhibit.</li>
                </ol>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Responsibilities of Partner.</h3>
                <p class="primary-font fs-16 text-black mb-12">Partner will provide the following services in relation to the Exhibit:</p>
                <ol class="primary-font fs-16 text-black mb-20">
                    <li class="mb-10">Partner shall direct the artist to a safe and proper location to host their art for the Exhibit;</li>
                    <li class="mb-10">Partner shall be responsible for maintaining the Location in a safe condition and providing adequate security and supervision during the Exhibit; and</li>
                    <li>Partner shall cooperate with 23LD and any purchaser in the coordination of a purchaser picking up and receiving sold pieces in the Exhibit.</li>
                </ol>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Right to Inspect.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD has the right to visit the Location to confirm the safe and proper installation and display of the Exhibit. However, 23LD is under no obligation to perform such inspection, and any inspection performed by 23LD shall not constitute any shift in liability or waiver of claims in the event of damage.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Exclusivity.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Partner agrees to display in the Exhibit and in its Location only works of art provided by 23LD and no other third-party vendors or providers.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Damage to Exhibit; Injury to Patron; Indemnification.</h3>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Damage to Exhibit.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD shall not be liable for any loss, theft, or damage to the Exhibit except to the extent caused by 23LD’s gross negligence or willful misconduct. Partner shall be solely responsible for maintaining the Location in a safe condition and for providing adequate security and supervision during the Exhibit, which may include camera monitoring of public spaces, ensuring doors to the Location are locked after hours, and any measures Partner determines is sufficient to ensure the safety of the Exhibit. The artist(s) of the artwork in the Exhibit are responsible for setting up and displaying their artwork in a manner designed to be safe for the Exhibit and patrons.
                </p>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Injury to Patron.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD shall not be liable for any injury, damage, or loss suffered by any patron, guest, or third party at the Location, including any injury or damage arising out of or relating to the artwork in the Exhibit, except to the extent caused by 23LD’s gross negligence or willful misconduct. In the event Partner observes a condition with the Exhibit that appears to raise a safety concern for either the Exhibit materials or a patron, Partner shall inform 23LD of the concern.
                </p>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Indemnification.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    To the fullest extent permitted by Tennessee law, Partner shall indemnify, defend, and hold harmless 23LD and its members, managers, officers, employees, agents, and representatives from and against any and all third-party claims, demands, causes of action, damages, losses, liabilities, and expenses (including reasonable attorneys’ fees) arising out of or relating to: (i) injury to or death of any person occurring at the Location, or (ii) loss, theft, or damage to artwork while at the Location; provided, however, that Partner’s indemnity obligations shall not apply to the extent such claim is finally determined to have been caused by 23LD’s gross negligence or willful misconduct.
                </p>

                <h4 class="secondry-font fs-22 fw-700 text-black mb-10">Liability Insurance.</h4>
                <p class="primary-font fs-16 text-black mb-20">
                    Partner may, at its option, maintain insurance covering the Exhibit while in its custody at the Location in an amount not less than the full replacement value of such Exhibit and, if it makes such option, shall provide proof of such coverage to the Company upon request.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Early Termination.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    This Agreement may terminate by thirty (30) days’ prior written notice of either Party to the other in such a manner compliant with the Notices provision of this Agreement.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Data.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD shall have the right to collect, use, and retain data generated through user interactions with its website and related platforms, including but not limited to search queries, page views, click activity, navigation patterns, and other non-personally identifiable usage data (“Usage Data”). Such Usage Data may be used by Company for internal business purposes, including improving website functionality, enhancing user experience, optimizing search results, and developing and implementing marketing and promotional strategies for Company and its artists.
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
                            <p class="primary-font fs-16 text-black mb-8"><strong>If to Partner:</strong></p>
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

                <h2 class="secondry-font fs-32 fw-700 text-black text-center mb-6 mt-32">ADDITIONAL PROVISIONS APPLICABLE TO ART GALLERIES.</h2>
                <p class="primary-font fs-16 text-black mb-20">
                    In the event the Partner or its agent are engaging in the business of managing a gallery for the display of art (an “Art Gallery”), the following additional terms apply:
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Subscription Options.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    Art Gallery Partners have the option to display an Exhibit on a subscription basis as described in Exhibit C attached hereto.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Commission.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    23LD shall be entitled to commission on all Exhibit items displayed at the Art Gallery Location consistent with the subscription level selected by the Art Gallery, as more particularly described in Exhibit C.
                </p>

                <h3 class="secondry-font fs-26 fw-700 text-black mb-10">Shipping.</h3>
                <p class="primary-font fs-16 text-black mb-20">
                    The Art Gallery Partner shall manage the logistics, shipping, and freight of sold Exhibit artwork. However, is the Art Gallery Partner wishes for 23LD to manage such services for any or all portions of the Exhibit, the Art Gallery Partner shall notify 23LD in writing of its desire for 23LD to manage such services for the Exhibit. Effective as of the date of such written notice, 23LD will manage the logistics, shipping, and freight of purchased Exhibit artwork.
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
                            <p class="primary-font fs-16 text-black mb-12"><strong>PARTNER:</strong></p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">____________________________________</p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">By:______________________________</p>
                            <p class="primary-font fs-16 text-black mb-10 agreement-line">Name:______________________________</p>
                            <p class="primary-font fs-16 text-black mb-0 agreement-line">Its:______________________________</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4 border-gray-light" />

                <h2 class="secondry-font fs-32 fw-700 text-black text-center mb-6">EXHIBIT A</h2>
                <p class="primary-font fs-20 fw-700 text-black text-center mb-24">DESCRIPTION OF EXHIBITION</p>

                <h2 class="secondry-font fs-32 fw-700 text-black text-center mb-6">EXHIBIT B</h2>
                <p class="primary-font fs-16 text-black text-center text-uppercase mb-24">TIERED SERVICE OFFERINGS FOR LOCATIONS</p>

                <div class="table-responsive mb-32">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <thead>
                            <tr>
                                <th class="w-20">Tier</th>
                                <th>Beagle</th>
                                <th>Husky</th>
                                <th>Mastiff</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Price</th>
                                <td>Free</td>
                                <td>$25/painting/year</td>
                                <td>$150/painting/year</td>
                            </tr>
                            <tr>
                                <th scope="row" class="align-top">Included Services</th>
                                <td class="align-top">Access to our online platform to host ticketed events</td>
                                <td class="align-top">
                                    <ul class="mb-0 ps-3">
                                        <li>Access to our online platform to host ticketed events</li>
                                        <li>Source local art for your Location</li>
                                        <li>Art installation &amp; sales facilitation</li>
                                    </ul>
                                </td>
                                <td class="align-top">
                                    <ul class="mb-0 ps-3">
                                        <li>Access to our online platform to host ticketed events</li>
                                        <li>Source local art for your Location</li>
                                        <li>Art installation &amp; sales facilitation</li>
                                        <li>Source art from more established, premium artists with more renown</li>
                                        <li>Seasonal rotations of your art to match your desired aesthetic</li>
                                        <li>Business features on social media and marketing campaigns</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h2 class="secondry-font fs-32 fw-700 text-black text-center mb-6">EXHIBIT C</h2>
                <p class="primary-font fs-16 text-black text-center text-uppercase mb-24">ART GALLERY SUBSCRIPTION OPTIONS</p>

                <div class="table-responsive mb-0">
                    <table class="table table-bordered primary-font fs-16 text-black mb-0">
                        <tbody>
                            <tr>
                                <th class="w-25 align-top" scope="row">Monthly Price</th>
                                <td class="agreement-line">&nbsp;</td>
                            </tr>
                            <tr>
                                <th class="align-top" scope="row">One-time Setup Fee</th>
                                <td class="agreement-line">&nbsp;</td>
                            </tr>
                            <tr>
                                <th class="align-top" scope="row">Commission to Gallery</th>
                                <td class="agreement-line">&nbsp;</td>
                            </tr>
                            <tr>
                                <th class="align-top" scope="row">Included Services</th>
                                <td>
                                    <ul class="mb-0 ps-3">
                                        <li>Access to our online platform to host ticketed events</li>
                                        <li>List your full or partial gallery catalog on our online platform</li>
                                        <li>Sales facilitation</li>
                                        <li>Source art and artists from our website for your gallery</li>
                                        <li>Features on social media and marketing campaigns advertising your gallery</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
