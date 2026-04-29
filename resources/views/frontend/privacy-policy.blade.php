@extends('frontend.amazy.layouts.app')

@section('title')
Privacy Policy | {{ config('app.name') }}
@endsection

@section('share_meta')
<meta name="title" content="Privacy Policy | {{ config('app.name') }}">
<meta name="description" content="Read how {{ config('app.name') }} collects, uses, stores, and protects your personal information.">
<meta property="og:title" content="Privacy Policy | {{ config('app.name') }}" />
<meta property="og:description" content="Privacy Policy covering data collection, usage, sharing, rights, storage, and security." />
<meta property="og:url" content="{{ url()->current() }}" />
@endsection

@section('content')
<section class="py-50 py-lg-100 overflow-visible">
    <div class="container">
        <div class="mx-auto" style="max-width: 980px;">
            <h1 class="secondry-font fs-55 fw-700 text-center text-black mb-15 line-height-1-2" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic">
                Privacy Policy
            </h1>
            <p class="primary-font text-center fs-18 text-black mb-30" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="80" data-aos-easing="ease-out-cubic">
                <strong>Effective Date:</strong> [___________________]
            </p>

            <div class="bg-white radius-16 p-24 p-lg-32 border-gray-light padding-class" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="140" data-aos-easing="ease-out-cubic">
                <p class="primary-font fs-16 text-black mb-14">
                    This Privacy Policy explains the privacy practices governing the types of information collected through the website [_____________] (the "Website"), operated by Two Three-Legged Dogs, LLC (the "Company"), our use of that information, and your privacy choices and rights.
                </p>
                <p class="primary-font fs-16 text-black mb-10">This Privacy Policy applies to information we collect from or about you from:</p>
                <ul class="primary-font fs-16 text-black mb-14">
                    <li><b>.</b> Your use of the Website;</li>
                    <li><b>.</b> Your purchase of products available on the Website ("Products");</li>
                    <li><b>.</b> Your interaction with free resources and/or our email list through the Website ("Email List"); and/or</li>
                    <li><b>.</b> Your creation of an account through the Website, if and when that feature is available.</li>
                </ul>
                <p class="primary-font fs-16 text-black mb-14">
                You must read this Privacy Policy carefully because when you use the Website, you are consenting to the collection, processing, and retention of your information as described in this Privacy Policy. If you have questions about the Privacy Policy, you can contact us here: [____________]
                </p>
                <p class="primary-font fs-16 text-black mb-14">
                    If you do not agree with any part of this Privacy Policy, you may not use the Website.
                </p>
                <p class="primary-font fs-16 text-black mb-24">
                If you are in the European Economic Area, and you use this Website, you consent and permit to the transfer of your data from the European Economic Area to the United States only for purposes laid out in this Privacy Policy.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">1. Information We Collect</h4>
                <p class="primary-font fs-16 text-black mb-12">
                We collect information that falls into two categories: information you voluntarily provide, and information that your computer, mobile phone, tablet, or other device (all referred to as “Device”) or browser provides automatically.
                </p>
                <p class="primary-font fs-16 text-black mb-8"><strong>A. Information You Voluntarily Provide.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">
                When you interact with our Website, we, or our service providers (acting on our behalf), collect “Personal Information” —information that relates to you as an identifiable individual -- that you intentionally and actively provide to us, such as your first and last name, address, email address, and when necessary, credit card or bank information. 
                </p>
                <p class="primary-font fs-16 text-black mb-10">We collect this information when you:</p>
                <ul class="primary-font fs-16 text-black mb-12">
                    <li>• Purchase something from our store, as part of the buying and selling process;</li>
                    <li>• Make arrangements to return a Product you have purchased;</li>
                    <li>• Inquire about a Product or our Website;</li>
                    <li>• Create an account on the Website;</li>
                    <li>• Sign up for our Email List/newsletter/marketing communications; or</li>
                    <li>• Submit a request for a legal consultation.</li>
                </ul>
                <p class="primary-font fs-16 text-black mb-8"><strong>B. Information About You That Is Provided Automatically<strong></p>
                <p class="primary-font fs-16 text-black mb-12">
                When you browse our Website, we also automatically receive your computer’s internet protocol (IP) address as well as other information that helps us learn about your browser and operating system (“Usage Information”). Usage Information includes your Device type, your unique Device identifier, your location, and the type of browser software and operating system you are using.
                </p>
                <p class="primary-font fs-16 text-black mb-8"><strong>C. Cookies and Other Data Tools.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">
                We, and/or our third party service providers, use “cookies” (data files placed on a Device when it is used to visit our Website) and other identifiers to collect Usage Information, for security purposes, to enable you to use the Website, to collect information regarding your preferences, to allow you to share content via social media when you are logged in to a particular platform, to deliver relevant advertising to you, and to generally make the Website perform better. You can opt out of cookies, but if you do, some features of the Website may not work correctly. 
                </p>
                <p class="primary-font fs-16 text-black mb-10">
                The Website and some marketing emails that we distribute also contain “web beacons” or clear GIFs, or similar technologies, which are small pieces of code placed on a web page or in an email, to monitor the behavior and collect data about the visitors viewing a web page or email. For example, web beacons may be used to count the users who visit a web page or to deliver a cookie to the browser of a visitor viewing that page. Web beacons may also be used to provide information on the effectiveness of our email campaigns (e.g., open rates, clicks, forwards, etc.).
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                The Website will also feature social buttons from networks such as Facebook, YouTube, Pinterest, and Instagram. To do so we embed code that they provide. We do not control that code ourselves. In order to function, their buttons generally know if you’re logged in. We do not have any access to that information, nor can we control how those networks use it. If you access the Website via a mobile app, we use additional identifiers, such as the advertising ID provided by Apple or Android, for similar purposes.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">2. How We Use Your Information</h4>
                <p class="primary-font fs-16 text-black mb-10">We use the Personal Information we collect about and from you:</p>
                <div class="primary-font fs-16 text-black mb-10">
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To perform our responsibilities under a contract we have with you. For example:</p>
                  
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> If you buy a Product through the Website, we will need to use your Personal Information to process your order and to enable delivery;</p>
                  
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> If we need to exercise a right or perform an obligation under the Terms of Use; and</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> If you submit a support ticket or make an inquiry through the Website, we will need to use your Personal Information in order to respond.</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> When we have a legitimate interest to do so—in other words, when it supports and achieves the aims of the Company. For example: </p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To prevent fraud and protect the security of our Website; </p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To enforce our Terms of Use; </p>
                  
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To develop and optimize our products and services;</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To help us provide and operate the Website;</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To advertise and market to you, which includes offers and content made available to you based on your interests and usage of the Website;</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To analyze the performance of the ads, offers and content on or originating from the Website, as well as your interaction with them; and</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> To comply with our legal obligations.</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> With your consent. For example: </p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> We send marketing communications to you only if you consent to receive them; and </p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> We do not share your Personal Information with third parties for their direct marketing purposes without your consent.</p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> As otherwise required by applicable law. For example: </p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> Protecting someone’s rights; </p>
                    <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> When necessary to perform a legal obligation or request from a governmental authority or similar body.</p>
                  
                </div>
                <p class="primary-font fs-16 text-black mb-20">
                While we rely on your consent as a legal basis for collecting and processing your information, if you consent to a particular use of your information and you ultimately change your mind, you may withdraw your consent at any time by contacting us here [____________] or sending us physical mail at the address below. If you no longer wish to receive email marketing communications, you may use the unsubscribe tool located at the bottom of that communication. If you withdraw your consent, we will not use your information going forward.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">3. How We May Share Your Information</h4>
                <p class="primary-font fs-16 text-black mb-8"><strong>A. Service Providers.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">
                We share your Personal Information with other service providers that we have engaged to perform business-related functions for us (“Service Providers”). This includes service providers that: 
                </p>
                <ul class="secondry-font fs-16 text-black mb-10">
                    <li><b class="text-black fs-24 fw-700">.</b> conduct research and analytics;</li>
                    <li><b class="text-black fs-24 fw-700">.</b> create content for Company;</li>
                    <li><b class="text-black fs-24 fw-700">.</b> provide customer, technical or operational support;</li>           
                    <li><b class="text-black fs-24 fw-700">.</b> conduct or support marketing (such as email marketing platforms);</li>
                    <li><b class="text-black fs-24 fw-700">.</b> host the Website;</li>
                    <li><b class="text-black fs-24 fw-700">.</b> maintain databases;</li>
                    <li><b class="text-black fs-24 fw-700">.</b> send or support online advertising;</li>
                    <li><b class="text-black fs-24 fw-700">.</b> confirm, process, or fulfill Product orders; and</li>
                    <li><b class="text-black fs-24 fw-700">.</b> otherwise support or help us provide the Website.</li>
                </ul>
                <p class="primary-font fs-16 text-black mb-10">These Service Providers may use your Personal Information to help us perform necessary actions that support those activities.</p>
                <p class="primary-font fs-16 text-black mb-10">Our online store is hosted on _______________ and, which provides us with an e-commerce platform to sell our products and services. Payments are processed via Stripe. If you choose to pay with a credit card to complete your purchase, then Stripe stores your credit card data. We do not have access to your full credit card information. You can read more about how Stripe uses your Personal Information here: <a href="https://stripe.com/privacy" target="_blank">https://stripe.com/privacy</a></p>

                <p class="primary-font fs-16 text-black mb-8"><strong>B. Business Transfers.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">
                We will share your Personal Information if we are acquired or purchased by, or merge with, another company, or if we otherwise reorganize our business. However, if that happens, any acquirer of that information will be subject to the provisions of our commitments to you in this Privacy Policy.
                </p>
                <p class="primary-font fs-16 text-black mb-8"><strong>C. Legal Disclosure.</strong></p>
                <p class="primary-font fs-16 text-black mb-20">
                We may transfer and disclose information, including your Personal Information, to third parties to comply with a legal obligation or subpoena, when we believe in good faith that the law requires it, at the request of governmental authorities conducting an investigation, to verify or enforce our Terms of Use, Privacy Policy or other applicable policies, to respond to an emergency, or otherwise to protect the rights, property, safety, or security of the Website, third parties, visitors to the Website, or the public.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">4. Your Privacy Choices, Rights, and Access</h4>
                <p class="primary-font fs-16 text-black mb-8"><strong>A. In General.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">
                You may always direct us not to share your Personal Information with third parties, not to use your Personal Information to provide you with information or offers, to delete information we have collected and maintained about you, or not to send you emails or other communications by:
                </p>
                <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> sending us an email here [_____________]; or</p>
                <p class="primary-font fs-16 text-black mb-10"><b class="text-black fs-24 fw-700">.</b> following the removal or unsubscribe instructions in the communication that you receive.</p>
                <p class="primary-font fs-16 text-black mb-12">
                If you wish to verify, correct, or update any of your Personal Information collected through the Website, or request access to all information that we have collected and maintain about you, you may contact us at the email or address included in the Contact Us section below. In accordance with our routine record keeping, we may delete certain records that contain Personal Information that you have submitted through the Website. We are under no obligation to store such Personal Information indefinitely and disclaim any liability arising out of, or related to, the destruction of such Personal Information. In addition, you should be aware that it is not always possible to completely remove or delete all of your information from our databases without some residual data because of backups or other technology-related reasons.
                </p>

                <p class="primary-font fs-16 text-black mb-8"><strong>B. For Individuals in the European Economic Area.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">If you are in the European Economic Area, you have certain rights related to the Personal Information we hold about you:
                    </p>
                <div class="primary-font fs-16 text-black mb-10">
                <p class="primary-font fs-16 text-black"><strong>• Access:</strong></p>
                <p class="primary-font fs-16 text-black mb-10">You have the right to access the Personal Information we hold about you. If you wish to obtain a copy or description of the Personal Information we hold about you, please contact us using the contact details set out below. We may ask you to verify your identity and to provide further details about your request.</p>
                <p class="primary-font fs-16 text-black"><strong>• Accuracy/Rectification.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">We will do our best to ensure the Personal Information we retain about you is accurate. We may from time to time send you an email update to remind you to tell us about any updates or changes to your Personal Information. You have the right to request that any inaccurate Personal Information is corrected and any incomplete information is completed by contacting us using the contact details set out below.</p>
                  
                <p class="primary-font fs-16 text-black"><strong>• Deletion/Erasure and Processing Restriction Requests. </strong></p>
                <p class="primary-font fs-16 text-black mb-10">You have the right to request that we delete Personal Information that we hold about you. You also have the right to ask us to stop processing your Personal Information, subject to certain exceptions. If you would like us to erase or stop processing the Personal Information that we hold about you, please contact us using the contact details set out below.</p>
                <p class="primary-font fs-16 text-black"><strong>• Portability Requests.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">You have the right to request that we provide certain parts of your Personal Information to you or transmit it directly to another company that processes Personal Information. If you would like us to transfer your Personal Information, please contact us using the contact details set out below.</p>
                <p class="primary-font fs-16 text-black"><strong>• Withdrawing Your Consent to Receive Marketing Messages. </strong></p>
                <p class="primary-font fs-16 text-black mb-10">You may ask us to stop using your Personal Information for advertising or marketing purposes at any time. If you wish to do this, please follow the removal instructions in any communication you receive or send us an email here [______________]with “UNSUBSCRIBE” in the subject line.</p>
                <p class="primary-font fs-16 text-black"><strong>• Damages </strong></p>
                <p class="primary-font fs-16 text-black mb-10">You may have the right to claim compensation for damages caused by our breach of any data protection laws. </p>
                  
                </div>
                <p class="primary-font fs-16 text-black mb-10">
                In addition, if you are in the European Economic Area and you have any complaints about how we use your Personal Information, you have the right to lodge a complaint with the data protection authority in your country. A list of data protection authorities is available at  <a href="http://ec.europa.eu/newsroom/article29/item-detail.cfm?item_id=612080" target="_blank">http://ec.europa.eu/newsroom/article29/item-detail.cfm?item_id=612080</a>. 
                </p>
                <p class="primary-font fs-16 text-black mb-10">
                For further information on each of the above-mentioned rights, including the circumstances in which they apply, see the Guidance from the UK Information Commissioner’s Office (ICO) on individual rights under the General Data Protection Regulation.
                </p>
                <p class="primary-font fs-16 text-black mb-10">
                The Website is governed by and operated in accordance with the laws of the United States. We make no representation that the Website is governed by or operated in accordance with the laws of any other nation. If you are located in the European Union, Canada or elsewhere outside of the United States, please be aware that information we collect may be transferred to and processed in the United States. The laws of the United States may not protect the privacy of your information at the same level as provided by the laws of your country. We transfer and process Personal Information only as permitted under this Privacy Policy.
                </p>

                <p class="primary-font fs-16 text-black mb-8"><strong>C. Rights of California Residents.</strong></p>
                <p class="primary-font fs-16 text-black mb-10">
                California residents are entitled once a year, free of charge, to request and obtain a list of all third parties to whom their personally identifiable information was provided for their direct marketing purposes in the preceding calendar year (e.g., requests made in 2017 will receive information about 2016 sharing activities). Company does not disclose any user information to third parties for third party marketing purposes.
                </p>
                <p class="primary-font fs-16 text-black mb-10">
                The California Consumer Protection Act (or “CCPA”) has additional protections for California residents. Though Company does not buy or sell Personal Information of any of its users, Company will honor the request of any California resident that makes any of the following requests:
                </p>
               
                <ul class="secondry-font fs-16 text-black mb-10">
                    <li><b class="text-black fs-24 fw-700">.</b> An inquiry as to what Personal Information Company has about the user and what Company does with that information;</li>
                    <li><b class="text-black fs-24 fw-700">.</b> A request to delete the user’s Personal Information; or</li>
                    <li><b class="text-black fs-24 fw-700">.</b> A request not to sell the user’s Personal Information.</li>           
                   
                </ul>
                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">5. Links to Other Websites</h4>
                <p class="primary-font fs-16 text-black mb-20">
                The Website may contain links to other websites, maintained by third parties. These links are provided only as a convenience to you. Company has no control over, and is not responsible for any content, products or services offered by or found on third party sites, or their privacy policies or practices. Links to third party sites do not constitute Company’s assumption of liability for or sponsorship, endorsement or approval of these sites or the content contained on these sites. The information practices on those websites may be different from ours and are not covered by this Privacy Policy. Please consult the privacy notices on those websites to learn more about their practices.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">6. Children</h4>
                <p class="primary-font fs-16 text-black mb-20">
                We do not knowingly collect information from children under 13 years of age. If we learn that a child under the age of 13 has provided us with any Personal Information without first receiving their parent or guardian’s verified consent, we will use that information only to respond directly to that child (or his or her parent or legal guardian) to inform the child that he or she cannot use the Website. We will then dispose of such Personal Information in accordance with this Privacy Policy. 
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">7. Storage of Your Information</h4>
                <p class="primary-font fs-16 text-black mb-10">
                We will generally store information associated with your account until it is no longer necessary to provide services to you, until you ask us to delete it, or until your account is deleted, whichever comes first; but there are some exceptions to this general rule. We will retain information from deleted accounts to comply with the law, prevent fraud, collect fees, resolve disputes, troubleshoot problems, assist with investigations, process warranty claims, distribute important product information (such as recall information), enforce our agreements, and take other actions permitted by law.
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                  
You can request deletion of your Personal Information at any time by contacting us using the contact details set out below. Note: If you request that data we maintain about you be deleted or erased, no one (neither us nor you) will be able to recover that information later.

                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">8. The Company Cannot Guarantee the Security of the Website
                </h4>
                <p class="primary-font fs-16 text-black mb-10">
                We take seriously our obligation to safeguard the confidentiality, security and integrity of personal information collected from our users. As you can see, the Website uses an SSL (or “secure sockets layer”) certificate, which provides secure, encrypted communications between a website and internet browser. We also have appropriate security measures in place to prevent Personal Information from being accidentally lost or used or accessed in an unauthorized way, such as two-way authentication and use of encryption where possible. We limit access to your Personal Information to those who have a genuine business need to know it. You should be aware, however, that no system is completely secure from hackers and network failure and error, and we cannot guarantee the confidentiality, security and integrity of information maintained on our Website for that reason.
                </p>
                <p class="primary-font fs-16 text-black mb-10">
                In other words, although we will use all reasonable efforts to safeguard the confidentiality of your Personal Information, we cannot guarantee that your information will always be secure.
                </p>
                <p class="primary-font fs-16 text-black mb-20">
                We have procedures in place to deal with any suspected data security breach. We will notify you and any applicable regulator of a suspected data security breach where we are legally required to do so.
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">9. Changes</h4>
                <p class="primary-font fs-16 text-black mb-20">
                We may update and post revisions to this Privacy Policy from time to time and will update the Effective Date when we do so. If our Privacy Policy changes in a way that significantly affects how we handle your Personal Information, we will not use the Personal Information we currently maintain without providing you notice or obtaining your consent, where appropriate. We encourage you to review this page for the latest information about our privacy practices
                </p>

                <h4 class="secondry-font fs-24 fw-700 text-black mb-10">10. Contact Us</h4>
                <p class="primary-font fs-16 text-black mb-10">
                If you have any questions or concerns about this Privacy Policy, please contact us by email here [________________] or write us at:
                </p>
                <p class="primary-font fs-16 text-black mb-0">
                    Two Three-Legged Dogs, LLC<br>
                    ATTN: PRIVACY<br>
                    ________________________<br>
                    ________________________
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
