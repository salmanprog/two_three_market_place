@extends('frontend.amazy.layouts.app')

@section('title')
Terms of Use | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Terms of Use | {{ config('app.name') }}">
<meta name="description" content="Review the Terms of Use for {{ config('app.name') }} website services.">
<meta property="og:title" content="Terms of Use | {{ config('app.name') }}" />
<meta property="og:description" content="Website terms covering acceptable use, user content, liability, privacy, and legal provisions." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<section class="py-50 py-lg-100 overflow-visible">
    <div class="container">
        <div class="mx-auto" style="max-width: 980px;">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-15 line-height-1-2" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic">
                Terms of Use
            </h1>
            <p class="primary-font text-center fs-18 text-black mb-30" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic">
                <strong>Effective Date:</strong> [___________________]
            </p>

            <div class="bg-white radius-16 p-24 p-lg-32 border-gray-light padding-class" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic">
                <p class="primary-font fs-16 text-black mb-14">
                    These <strong>Terms of Use</strong> govern the use of the website [_____________] (the "Website"), operated by Two Three-Legged Dogs, LLC (the "Company"), any links to other websites contained on the Website, and other online resources accessible via the Website.
                </p>
                <p class="primary-font fs-16 text-black mb-14">
                    By browsing, accessing, or using the Website in any way, you agree to these Terms of Use. If you use the Website on behalf of another person, you represent that you are authorized to accept these Terms on that person's behalf.
                </p>
                <p class="primary-font fs-16 text-black mb-24">
                Company reserves the right, at any time, to modify, alter, or update these Terms of Use. Modifications become effective immediately upon being posted on the Website.  Your continued use of the Website after amendments are posted constitutes an acknowledgement and acceptance of the modified Terms of Use. Except as provided in this paragraph, these Terms of Use may not be amended.
                </p>

                <h3 class="secondry-font fs-30 fw-700 text-black mb-16">Terms Applicable to All Web Users</h3>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">1. Disclaimer of Warranties</h4>
                <p class="primary-font fs-16 text-black mb-20">
                Use of the Website and its contents is at your sole risk. The Website is provided on an “as is” and “as available” basis, meaning Company makes no guarantees that it will meet any particular standards or requirements or be available at all times. To the fullest extent permitted by applicable law, Company makes no representations or warranties of any kind, express or implied, regarding your use or the results of the Website in terms of correctness, accuracy, reliability, or otherwise. Company will have no liability to you or anyone else for any interruptions, errors, computer viruses or other harmful components in the use of this Website. COMPANY DISCLAIMS ALL EXPRESS OR IMPLIED WARRANTIES WITH REGARD TO THE WEBSITE AND THE INFORMATION PROVIDED ON THE WEBSITE INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, NON-INFRINGEMENT, AND LOSS OF DATA OR PROFIT ARISING OUT OF THE USE OR INABILITY TO USE THE CONTENT OF THE WEBSITE. COMPANY DOES NOT WARRANT THAT ANY CONTENT OR INFORMATION ACCESSED THROUGH THE WEBSITE WILL BE UNINTERRUPTED, ERROR FREE, OR SECURE, THAT DEFECTS WILL BE CORRECTED, OR THAT THE WEBSITE OR THE SERVER THAT MAKES IT AVAILABLE IS FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">2. Limitations of Liability and Disclaimer</h4>
                <p class="primary-font fs-16 text-black mb-20">
                UNDER NO CIRCUMSTANCES WILL COMPANY OR ANY OF ITS SUBSIDIARIES, AFFILIATES, MEMBERS, OFFICERS, AGENTS OR REPRESENTATIVES BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY UNFORESEEABLE OR CONSEQUENTIAL DAMAGES, OR DAMAGES FOR MONETARY LOSS RELATED TO YOUR USE OF THE WEBSITE OR THE INFORMATION CONTAINED IN IT, OR THE INABILITY TO USE THE WEBSITE, REGARDLESS OF THE TYPE OF LAW UNDER WHICH THOSE DAMAGES ARISE, EVEN IF COMPANY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. If, despite the previous sentence, liability is imposed upon Company, Company’s total liability to you or any third party will not exceed one hundred dollars ($100). Some jurisdictions do not allow for the limitation or exclusion of liability for incidental or consequential damages. In those jurisdictions, Company’s liability is limited to the greatest extent permitted by law.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">3. Accounts</h4>
                <p class="primary-font fs-16 text-black mb-20">
                You may have the option to create an account to participate in certain features of the Website. If you are under the age of 13, you are not permitted to register as a user or otherwise submit personal information to Company. If you create an account, you agree to provide and maintain true, accurate, current, and complete information about yourself in the registration process. You are prohibited from impersonating any person or entity or misrepresenting your identity and from using another person’s username, password, or other account information. You must promptly notify Company with any questions of any unauthorized use of your username, password, other account information, or any other breach of security that you become aware of involving or relating to the Website.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">4. Your Warranties</h4>
                <p class="primary-font fs-16 text-black mb-20">
                You warrant and represent that all content added to the Website by you or at the instruction of you or your agents or representatives -- including, without limitation, messages, comments, text, illustrations, files, images, graphics, photographs, comments, sounds, music, videos, information, and/or any other content (“User Content”) is free of third-party claims and does not infringe the rights of any third party. By adding or uploading User Content, you warrant and represent that you own or otherwise maintain all necessary rights in order to add or upload such User Content.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">5. Indemnification</h4>
                <p class="primary-font fs-16 text-black mb-20">
                You will indemnify and hold Company and its parents, subsidiaries, affiliates, members, officers, directors, employees, agents, representatives, sponsors, and service providers harmless from any claim, demand, liability, loss, damages, or cause of action, including reasonable attorneys’ fees and costs, made by any third party due to or arising out of your breach of these Terms of Use or your use of the Website. This indemnification and hold harmless provision extends to any dispute between persons accessing the Website or between persons accessing the Website and any third party linked to or from the Website. You will cooperate as fully as reasonably required in the defense of any claim. Company reserves the right, at its own expense, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, and you will not in any event settle any such matter without Company’s written consent.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">6. User Content</h4>
                <p class="primary-font fs-16 text-black mb-12">
                To the extent forums, communities, or comments are present as part of the Website, you may create or come into contact with User Content. You -- and not Company -- are solely responsible for any User Content you post or upload to the Website. Company is not responsible or liable for the contents of any User Content on the Website. User Content does not express the views of Company. Company has the right, but not the obligation, to monitor User Content, and Company does not guarantee that it will edit or delete User Content. Company reserves the right to reveal your identity (or whatever information Company knows about you) if a complaint or legal action arises from your behavior on or through the Website. Company does not claim ownership of the User Content on the Website. 
                </p>
                <p class="primary-font fs-16 text-black mb-12">
                You acknowledge that public forums or comment blocks available on the Website, if any, are for public and not private communications. You are and will remain solely responsible for the content you post on these forums and the Website and for the consequences of submitting and posting content. You should be skeptical about information provided by others, and you acknowledge that the use of any content posted on the Website is at your own risk.
                </p>
                <p class="primary-font fs-16 text-black mb-12">
                By posting or uploading User Content to this Website, you are granting Company permission to use the User Content in connection with the Website and/or Company’s promotional purposes. By submitting User Content, you also grant Company the right, but not the obligation, to use your biographical information, including, without limitation, your name and geographical location in connection with broadcast, print, online, or other use or publication of your User Content in connection with the Website or with Company. You waive any and all claims you may now or later have in any jurisdiction to so-called “moral rights” with respect to the User Content.
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                Company may discontinue operation of the Website, or your use of the Website, in either case entirely or partially, in its sole discretion. You have no right to maintain or access your User Content on the Website, and Company has no obligation to return your User Content or otherwise make it available to you.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">7. Compliance with Laws and Prohibited Uses</h4>
                <p class="primary-font fs-16 text-black mb-12">
                You assume all knowledge of applicable law and are responsible for compliance with all such laws. You may not use the Website in any way that violates applicable state, federal, or international laws, regulations, or other government requirements.
                </p>
                <p class="primary-font fs-16 text-black mb-10">You are prohibited from posting or transmitting through the Website:</p>
                <ul class="primary-font fs-16 text-black mb-12">
                    <li><b>a.</b> material that violates or infringes on the rights of others, including, but not limited to, any copyright, trademark, patent, trade secret, moral right, or other intellectual property, personal, contractual, proprietary, or other right of Company or of any other person or entity; </li>
                    <li><b>b.</b> material that impersonates another or is unlawful, threatening, abusive, defamatory, invasive of privacy or publicity rights, vulgar, obscene, profane, pornographic, lewd, filthy, excessively violent, harassing or otherwise objectionable (in Company’s determination); </li>
                    <li><b>c.</b> material that encourages conduct that would constitute a criminal offense, give rise to civil liability, or otherwise violate any applicable local, state, national or international law or regulation;  </li>
                    <li><b>d.</b> material that is an overt, unwelcome, or harassment-level advertisement for goods or services or a solicitation of funds (in Company’s determination);  </li>
                    <li><b>e.</b> material that includes personal information such as phone numbers, social security numbers, account numbers, addresses, or employer references;  </li>
                    <li><b>f.</b> material that contains a formula, instruction, or advice that could cause harm or injury;  </li>
                    <li><b>g.</b> material that, if used by Company, would cause Company to be liable or have legal obligation to a person or business; </li>
                    <li><b>h.</b> material that could facilitate mail abuse or unsolicited email of any type (spam); or </li>
                    <li><b>i.</b> material that could facilitate scraping, or systematic retrieval of data or other Website Content from this Website to create or compile a collection, compilation, directory, database, or data set for artificial intelligence training without Company’s express prior written permission.</li>
                </ul>
                <p class="primary-font fs-16 text-black mb-20">
                Company reserves the right to refuse service to you for violation of this Section or any of these Terms of Use.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">8. Intellectual Property</h4>
                <p class="primary-font fs-16 text-black mb-20">
                Unless otherwise noted, all content on the Website is subject to Company’s intellectual-property rights—including copyrights and trademarks—or the rights of Company’s licensors. Subject to these Terms of Use, Company grants you a personal, non-exclusive, non-transferable, limited right to access, use and view this Website and the information on the Website, including, without limitation, all text, files, designs, graphics, drawings, illustrations, images, photographs, video, music and sounds, and/or other content and all trademarks, service marks and trade names used at this Website (all together referred to as the “Website Content”), solely for your own individual use. You may not, nor may you allow others to, directly or indirectly sell, license, rent, reproduce, modify or attempt to modify or create derivative works from the Website Content in any way or reproduce or publicly display, perform, transmit or distribute or otherwise use the Website Content for any public or commercial purpose, including, but not limited to: use of the Website Content on any other website or platform, or use or incorporation of the Website Content into a product for sale or commercial gain. Except as specifically provided in these Terms, Company does not grant you the right to use or reproduce the Website Content, and all intellectual-property rights in the Website Content not granted to you or mentioned specifically in these Terms are expressly reserved by Company. YOU MAY NOT USE THE WEBSITE CONTENT FOR ANY COMMERCIAL PURPOSE UNLESS SPECIFICALLY STATED.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">9. Submission of Information</h4>
                <p class="primary-font fs-16 text-black mb-20">
                Although Company may provide some security in an effort to protect the electronic transmission of certain information that you submit to Company through this Website, Company does not guarantee the security of any information transmitted to or from this Website, including to or from any third-party websites linked to this Website. Submission of any private or financial (e.g., credit card) or other information to this Website or to any third-party websites linked to this Website is entirely at your own risk and responsibility and is subject to Company’s Privacy Policy.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">10. Privacy</h4>
                <p class="primary-font fs-16 text-black mb-20">
                Registration data, if any, and other personal information about you is subject to our Privacy Policy (available here: _________________). By using the Website, you consent to the collection and use of this information in accordance with the Privacy Policy.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">11. Restrictions on Use by Minors</h4>
                <p class="primary-font fs-16 text-black mb-12">
                If you are under 18, you may use this Website only under the supervision of a parent or legal guardian. This Website is not intended or designed to attract children under the age of 18. Company does not collect personally identifiable information from any person Company actually knows is under the age of 18. 
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                This Website contains images of artwork. Therefore, some content on this Website may contain nudity, sensitive information, and other artistic expression which may not be appropriate for children or anyone under the age of 18, and therefore may be “locked,” requiring age verification to view. All customers wishing to view this locked portion of the Website may contact us here _____________________ and provide verification of their age as demonstrated in a valid ID. 
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">12. Denial of Access</h4>
                <p class="primary-font fs-16 text-black mb-20">
                Company, for any reason and at its sole discretion, may decide to deny anyone access to any part of the Website. By agreeing to these Terms of Use, you agree to immediately cease and desist from any attempt to access the Website after such a denial.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">13. Interruption to Service</h4>
                <p class="primary-font fs-16 text-black mb-20">
                Company will make its best efforts to provide uninterrupted service to the Website, but you acknowledge and accept that Company does not guarantee continuous, uninterrupted, or secure access to the Website, and operation of the Website may be interfered with or adversely affected by numerous factors or circumstances outside of Company’s control.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">14. Third Parties and Third-Party Sites</h4>
                <p class="primary-font fs-16 text-black mb-20">
                The Website may include links to advertisements or other sites on the Internet that are owned, operated, and/or maintained by online merchants or other third parties.  You acknowledge that Company is not responsible for the availability of, or the content located on or through, any third-party site. Company is not responsible for the content, operation, or privacy practices of these other websites, nor does it operate, control, or endorse the content found on these third-party websites. Your use of these third-party sites is at your own risk, and it is your responsibility to take all protective measures to guard against viruses and other destructive elements.  You should contact the site administrator or webmaster for those third-party sites if you have any concerns regarding such links or the content located on such sites.  Your use of those third-party sites is subject to the terms of use and privacy policies of each site. If a third-party links to the Website, it is not necessarily an indication of Company’s endorsement, adoption, authorization, sponsorship, affiliation, joint venture, or partnership with that third party. Company makes no warranties or representations whatsoever with regard to any product provided or offered by any vendor or other third party, and your reliance on representations and warranties provided by any vendor or other third party is at your own risk. You assume sole responsibility for your use of third-party links. Company is not liable to you for any loss or damage of any sort incurred as a result of your dealings with any third-party or their website.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">15. Venue and Governing Jurisdiction</h4>
                <p class="primary-font fs-16 text-black mb-20">
                The Website is operated and provided in the State of Tennessee. As such, Company is subject to the laws of the State of Tennessee. Any legal issues arising from or related to your use of the Website will be construed in accordance with, and all questions with respect to such issues will be determined by, the laws of the State of Tennessee applicable to contracts entered into and performed within Tennessee, without regard to conflict-of-laws provisions. Any dispute arising out of or relating to these Terms of Use or your use of or visit to the Website must be brought in the state or federal court located in Nashville, Davidson County, Tennessee, as applicable (or, if no court is located there, as close to that venue as possible). By using the Website, and therefore agreeing to these Terms of Use, you consent to personal jurisdiction and venue in the state and federal courts in Nashville, Davidson County, Tennessee with respect to all such disputes. Company makes no representation that the Website is appropriate, legal, or available for use in other locations. Accordingly, if you choose to use the Website, you agree to do so subject to the internal laws of the State of Tennessee.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">16. Other Terms</h4>
                <p class="primary-font fs-16 text-black mb-12">
                If any provision of these Terms of Use is deemed by an appropriate court to be unlawful, void, or unenforceable for any reason, the other provisions (and any partially enforceable provision) will not be affected by that determination and will remain valid, binding, and enforceable to the maximum possible extent. Company’s failure to insist on or enforce strict performance of any provision of these Terms of Use do not constitute a waiver of any provision or right in the future. The Privacy Policy (available here: _________________) is a binding part of these Terms of Use, and together with these Terms of Use constitute the entire agreement between Company and you with respect to your use of this Website. Any cause of action you may have with respect to your use of this Website or that is the subject of these Terms of Use must be commenced within one (1) year after the claim or cause of action arises. The headings and summaries in these Terms of Use are for reference and convenience only and do not affect the interpretation of these Terms of Use.
                </p>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10 mt-30">TERMS APPLICABLE TO CUSTOMERS OF THE WEBSITE:</h4>
                <p class="primary-font fs-16 text-black mb-20">
                The following additional terms apply to any individual or entity engaging with the Website for the purpose of purchasing artwork or any other material, item, service (the “Artwork”) from the Website. Any such individual or entity engaging with the Website with such purpose is known as a “Customer.”
                </p>
              
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">17.	Role of Company; Not Direct Outreach to Artists</h4>
                <p class="primary-font fs-16 text-black mb-20">
                The Company operates the Website on behalf of individual artists and other third-party sellers who have authorized the Company to market, display, and sell the Artwork. Unless expressly stated otherwise, the Company is not the creator or owner of the Artwork and acts solely in a capacity as an intermediary for the sale of such Artwork. 
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                All Artwork listed on the Website may be purchased exclusively through the Website and the Company. Outreach to the artist directly to purchase the piece in a manner other than through the Company is not permitted. 
                </p>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">18.	Sales and Acceptance of Orders</h4>
                <p class="primary-font fs-16 text-black mb-20">
                All orders are subject to acceptance by the Company. We reserve the right to refuse, cancel, or limit any order for any reason, including pricing errors, availability issues, or suspected fraud.
                </p>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">19.	Pricing and Payment</h4>
                <p class="primary-font fs-16 text-black mb-20">
                Prices are listed in U.S. dollars and are subject to change without notice. Payment is due at the time of purchase. Applicable taxes, shipping, insurance, and handling charges will be added at checkout.
                </p>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">20.	Condition of Artwork</h4>
                <p class="primary-font fs-16 text-black mb-20">
                All Artwork is sold “as is” and “as available.” To the fullest extent permitted by Tennessee law, the Company disclaims all warranties, express or implied, including warranties of merchantability, fitness for a particular purpose, authenticity (unless expressly guaranteed), and non-infringement
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                Descriptions, images, and dimensions are provided for convenience only and may not be exact. Minor variations, including in color or condition, do not constitute defects.
                </p>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">21.	Returns and Refunds</h4>
                <p class="primary-font fs-16 text-black mb-20">
                A Customer may request a refund of purchased Artwork within ten (10) days following the delivery of the Artwork. Customers may submit such refund requests here: _____________. 
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                Artwork must be in original condition, properly packaged, and with all certificates to be approved for return. If such return is approved, a Customer will receive their money back for the purchase within ten (10) days of Company’s receipt of the Artwork and final confirmation that the Artwork is in its original condition. 
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                If a return is approved in the Company’s sole discretion, the Customer must comply with all return instructions, and the Customer shall bear all associated costs unless otherwise agreed.
                </p>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">22.	Damage to Artwork; Shipping</h4>
                <p class="primary-font fs-16 text-black mb-20">
                <strong>a. General Disclaimer of Liability.</strong> Company shall not be liable for any loss, theft, or damage to the Artwork while in storage, on display, or otherwise in the possession or control of third-parties, except to the extent caused by Company’s gross negligence or willful misconduct. 
                </p>
                <p class="primary-font fs-16 text-black mb-20">
               <strong> b. Third-Party Handling and Exhibition.</strong> Customer acknowledges that Artwork may be handled, installed, transported, or displayed by third-party venues, contractors, or service providers. Company shall not be responsible for the acts or omissions of such third-parties, except to the extent required by applicable law.
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                <strong>c. Shipping Through Approved Third-Parties.</strong> Notwithstanding the foregoing, when Artwork is shipped through Company’s designated shipping and packaging partners, Company shall use commercially reasonable efforts to ensure that such shipments are handled with appropriate care and coverage. Company shall provide or cause to be provided shipping-related liability coverage (which may include carrier-provided insurance or third-party shipping insurance) for loss or damage occurring in transit, subject to the terms, conditions, and limitations of such coverage.

                </p>
                <p class="primary-font fs-16 text-black mb-20">
                Risk of loss and title shall pass to the Customer upon delivery to the carrier, to the fullest extent permitted by applicable law. The Company is not responsible for delays, losses, or damage in transit, except to the extent covered by insurance coverage. 
                </p>
              
                <p class="primary-font fs-16 text-black mb-20">
             <strong>d. Claims Cooperation.</strong> Customer agrees to reasonably cooperate in the submission and processing of any shipping-related claim, including providing documentation of value and condition of the Artwork. Recovery under any such claim shall be Customer’s sole and exclusive remedy for damage or loss occurring during transit arranged by the Company.
                </p>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10 ">23. TERMS APPLICABLE TO INTERIOR DESIGNER CUSTOMERS:</h4>

           
                <p class="primary-font fs-16 text-black mb-20">
                Customers offering interior design services qualify for discounts based upon the amount of artwork purchased from the Company. These discounts are described below: </p>

                <div class="table-responsive mb-20">
                    <table class="table table-bordered mb-0 primary-font fs-16 text-black">
                        <thead>
                            <tr>
                                <th>Tier</th>
                                <th>YTD Purchases</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Beagle</td>
                                <td>x &gt; $50,000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>Husky</td>
                                <td>$50,000 &gt; x &gt; $100,000</td>
                                <td>15%</td>
                            </tr>
                            <tr>
                                <td>Mastif</td>
                                <td>$100,000 +</td>
                                <td>20%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
