<?php include_once 'header.php'; ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Modal Examples</h4>

    <div class="row mb-4">
        <!--  Pricing -->
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-bar-chart-alt-2"></i>
                    <h5>Pricing</h5>
                    <p>Elegant pricing options modal popup example, easy to use in any page.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pricingModal">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Pricing -->

        <!--  Add New Credit Card -->
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-credit-card"></i>
                    <h5>Add New Credit Card</h5>
                    <p>Quickly collect the credit card details, built in input mask and form validation support.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewCCModal">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Add New Credit Card -->

        <!--  Add New Address -->
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-buildings"></i>
                    <h5>Add New Address</h5>
                    <p>Ready to use form to collect user address data with validation and custom input support.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewAddress">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Add New Address -->

        <!--  Refer & Earn -->
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-gift"></i>
                    <h5>Refer & Earn</h5>
                    <p>Use Refer & Earn modal to encourage your exiting customers refer their friends & colleague.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#referAndEarn">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Refer & Earn -->

        <!--  Edit User -->
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-user"></i>
                    <h5>Edit User</h5>
                    <p>Easily update the user data on the go, built in form validation and custom controls.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Edit User -->

        <!--  Enable OTP -->
        <div class="col-12 col-sm-6 col-lg-4 mb-md-0 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-mobile-alt"></i>
                    <h5>Enable OTP</h5>
                    <p>Use this modal to enhance your application security by enabling authentication with OTP.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enableOTP">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Enable OTP -->

        <!--  Share Project -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-file"></i>
                    <h5>Share Project</h5>
                    <p>Elegant Share Project options modal popup example, easy to use in any page.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shareProject">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Share Project -->

        <!--  Create App -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-md bx-cube"></i>
                    <h5>Create App</h5>
                    <p>Provide application data with this form to create your app, easy to use in page.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createApp">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Create App -->

        <!--  Two Factor Auth -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mb-3 bx bx-lock bx-md"></i>
                    <h5>Two Factor Auth</h5>
                    <p>Enhance your application security by enabling two factor authentication.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#twoFactorAuth">
                        Show
                    </button>
                </div>
            </div>
        </div>
        <!--/  Two Factor Auth -->
    </div>

    <!-- All Modals -->
    <!-- pricingModal -->

    <!-- /pricingModal -->

    <!-- Add New Credit Card Modal -->
    <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Add New Card</h3>
                        <p>Add new card to complete payment</p>
                    </div>
                    <form id="addNewCCForm" class="row g-3" onsubmit="return false">
                        <div class="col-12">
                            <label class="form-label w-100" for="modalAddCard">Card Number</label>
                            <div class="input-group input-group-merge">
                                <input id="modalAddCard" name="modalAddCard" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898" aria-describedby="modalAddCard2" />
                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddCardName">Name</label>
                            <input type="text" id="modalAddCardName" class="form-control" placeholder="John Doe" />
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="modalAddCardExpiryDate">Exp. Date</label>
                            <input type="text" id="modalAddCardExpiryDate" class="form-control expiry-date-mask" placeholder="MM/YY" />
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label" for="modalAddCardCvv">CVV Code</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="modalAddCardCvv" class="form-control cvv-code-mask" maxlength="3" placeholder="654" />
                                <span class="input-group-text cursor-pointer" id="modalAddCardCvv2"><i class="bx bx-help-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Card Verification Value"></i></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="switch">
                                <input type="checkbox" class="switch-input" />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Save card for future billing?</span>
                            </label>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3">Submit</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add New Credit Card Modal -->

    <!-- Add New Address Modal -->
    <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="address-title">Add New Address</h3>
                        <p class="address-subtitle">Add new address for express delivery</p>
                    </div>
                    <form id="addNewAddressForm" class="row g-3" onsubmit="return false">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md mb-md-0 mb-3">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="customRadioHome">
                                            <span class="custom-option-body">
                                                <i class="bx bx-home"></i>
                                                <span class="custom-option-title">Home</span>
                                                <small> Delivery time (9am – 9pm) </small>
                                            </span>
                                            <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioHome" checked />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md mb-md-0 mb-3">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="customRadioOffice">
                                            <span class="custom-option-body">
                                                <i class="bx bx-briefcase"></i>
                                                <span class="custom-option-title"> Office </span>
                                                <small> Delivery time (9am – 5pm) </small>
                                            </span>
                                            <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioOffice" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddressFirstName">First Name</label>
                            <input type="text" id="modalAddressFirstName" name="modalAddressFirstName" class="form-control" placeholder="John" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddressLastName">Last Name</label>
                            <input type="text" id="modalAddressLastName" name="modalAddressLastName" class="form-control" placeholder="Doe" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalAddressCountry">Country</label>
                            <select id="modalAddressCountry" name="modalAddressCountry" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalAddressAddress1">Address Line 1</label>
                            <input type="text" id="modalAddressAddress1" name="modalAddressAddress1" class="form-control" placeholder="12, Business Park" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalAddressAddress2">Address Line 2</label>
                            <input type="text" id="modalAddressAddress2" name="modalAddressAddress2" class="form-control" placeholder="Mall Road" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddressLandmark">Landmark</label>
                            <input type="text" id="modalAddressLandmark" name="modalAddressLandmark" class="form-control" placeholder="Nr. Hard Rock Cafe" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddressCity">City</label>
                            <input type="text" id="modalAddressCity" name="modalAddressCity" class="form-control" placeholder="Los Angeles" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddressLandmark">State</label>
                            <input type="text" id="modalAddressState" name="modalAddressState" class="form-control" placeholder="California" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddressZipCode">Zip Code</label>
                            <input type="text" id="modalAddressZipCode" name="modalAddressZipCode" class="form-control" placeholder="99950" />
                        </div>
                        <div class="col-12">
                            <label class="switch">
                                <input type="checkbox" class="switch-input" />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Use as a billing address?</span>
                            </label>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add New Address Modal -->

    <!-- Refer & Earn Modal -->
    <div class="modal fade" id="referAndEarn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Refer & Earn</h3>
                        <p class="text-center mb-5 w-75 m-auto">
                            Invite your friend to Sneat, if they sign up, you and your friend will get 30 days free trial.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4 px-4">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="modal-refer-and-earn-step bg-label-primary">
                                    <i class="bx bx-message-square-dots"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5>Send Invitation 🤟🏻</h5>
                                <p class="mb-lg-0">Send your referral link to your friend</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 px-4">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="modal-refer-and-earn-step bg-label-primary">
                                    <i class="bx bx-detail"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5>Registration 👩🏻‍💻</h5>
                                <p class="mb-lg-0">Let them register to our services</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 px-4">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="modal-refer-and-earn-step bg-label-primary">
                                    <i class="bx bx-gift"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5>Free Trial 🎉</h5>
                                <p class="mb-0">Your friend will get 30 days free trial</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <h5>Invite your friends</h5>
                    <form class="row g-3" onsubmit="return false">
                        <div class="col-lg-10">
                            <label class="form-label" for="modalRnFEmail">Enter your friend’s email address and invite them to join Sneat 😍</label>
                            <input type="text" id="modalRnFEmail" class="form-control" placeholder="example@domain.com" aria-label="example@domain.com" />
                        </div>
                        <div class="col-lg-2 d-flex align-items-end">
                            <button type="button" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                    <h5 class="mt-4">Share the referral link</h5>
                    <form class="row g-3" onsubmit="return false">
                        <div class="col-lg-9">
                            <label class="form-label" for="modalRnFLink">You can also copy and send it or share it on your social media. 🥳</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="modalRnFLink" class="form-control" value="https://themeselection.com" />
                                <span class="input-group-text text-primary cursor-pointer" id="basic-addon33">Copy link</span>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex align-items-end">
                            <div class="btn-social">
                                <button type="button" class="btn btn-icon btn-facebook mr-2">
                                    <i class="tf-icons bx bxl-facebook"></i>
                                </button>
                                <button type="button" class="btn btn-icon btn-twitter mr-2">
                                    <i class="tf-icons bx bxl-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-icon btn-linkedin">
                                    <i class="tf-icons bx bxl-linkedin"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Refer & Earn Modal -->

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Edit User Information</h3>
                        <p>Updating user details will receive a privacy audit.</p>
                    </div>
                    <form id="editUserForm" class="row g-3" onsubmit="return false">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">First Name</label>
                            <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserLastName">Last Name</label>
                            <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalEditUserName">Username</label>
                            <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" placeholder="john.doe.007" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserEmail">Email</label>
                            <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" placeholder="example@domain.com" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserStatus">Status</label>
                            <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select" aria-label="Default select example">
                                <option selected>Status</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                                <option value="3">Suspended</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditTaxID">Tax ID</label>
                            <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="123 456 7890" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+1</span>
                                <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserLanguage">Language</label>
                            <select id="modalEditUserLanguage" name="modalEditUserLanguage" class="select2 form-select" multiple>
                                <option value="">Select</option>
                                <option value="english" selected>English</option>
                                <option value="spanish">Spanish</option>
                                <option value="french">French</option>
                                <option value="german">German</option>
                                <option value="dutch">Dutch</option>
                                <option value="hebrew">Hebrew</option>
                                <option value="sanskrit">Sanskrit</option>
                                <option value="hindi">Hindi</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserCountry">Country</label>
                            <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="switch">
                                <input type="checkbox" class="switch-input" />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Use as a billing address?</span>
                            </label>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit User Modal -->

    <!-- Enable OTP Modal -->
    <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-5">Enable One Time Password</h3>
                    </div>
                    <h6>Verify Your Mobile Number for SMS</h6>
                    <p>Enter your mobile phone number with country code and we will send you a verification code.</p>
                    <form id="enableOTPForm" class="row g-3" onsubmit="return false">
                        <div class="col-12">
                            <label class="form-label" for="modalEnableOTPPhone">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+1</span>
                                <input type="text" id="modalEnableOTPPhone" name="modalEnableOTPPhone" class="form-control phone-number-otp-mask" placeholder="202 555 0111" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Enable OTP Modal -->

    <!-- Share Project Modal -->
    <div class="modal fade" id="shareProject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <h3 class="mb-2">Share Project</h3>
                        <p>Share project with a team member</p>
                    </div>
                </div>
                <div class="col-12 mb-4 pb-2">
                    <label for="select2Basic" class="form-label">Add Members</label>
                    <select id="select2Basic" class="form-select form-select-lg share-project-select" data-allow-clear="true">
                        <option data-name="Adelaide Nichols" data-image="img/avatars/20.png" selected>
                            Adelaide Nichols
                        </option>
                        <option data-name="Julian Murphy" data-image="img/avatars/9.png">Julian Murphy</option>
                        <option data-name="Sophie Gilbert" data-image="img/avatars/10.png">Sophie Gilbert</option>
                        <option data-name="Marvin Wheeler" data-image="img/avatars/17.png">Marvin Wheeler</option>
                    </select>
                </div>
                <h4 class="mb-4 pb-2">8 Members</h4>
                <ul class="p-0 m-0">
                    <li class="d-flex mb-3">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/1.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Lester Palmer</p>
                                <p class="mb-0 text-muted">pe@vogeiz.net</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Can Edit</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/2.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Mattie Blair</p>
                                <p class="mb-0 text-muted">peromak@zukedohik.gov</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Owner</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/3.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Marvin Wheeler</p>
                                <p class="mb-0 text-muted">rumet@jujpejah.net</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Can Edit</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/4.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Nannie Ford</p>
                                <p class="mb-0 text-muted">negza@nuv.io</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Can Comment</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/5.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Julian Murphy</p>
                                <p class="mb-0 text-muted">lunebame@umdomgu.net</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Can View</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/6.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Sophie Gilbert</p>
                                <p class="mb-0 text-muted">ha@sugit.gov</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Can View</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/7.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Chris Watkins</p>
                                <p class="mb-0 text-muted">zokap@mak.org</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Can Comment</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex">
                        <div class="avatar me-3">
                            <img src="../../assets/img/avatars/8.png" alt="avatar" class="rounded-circle" />
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div class="me-2">
                                <p class="mb-0">Adelaide Nichols</p>
                                <p class="mb-0 text-muted">ujinomu@jigo.com</p>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-muted fw-normal me-2">Can Edit</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Owner</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can Comment</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">Can View</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="d-flex align-items-center mt-4">
                    <i class="bx bx-user me-2"></i>
                    <div class="d-flex justify-content-between flex-grow-1 align-items-center">
                        <h6 class="mb-0">Public to Sneat - ThemeSelection</h6>
                        <button class="btn btn-primary">Copy Project Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Share Project Modal -->

    <!-- Create App Modal -->
    <div class="modal fade" id="createApp" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <h3 class="mb-2">Create App</h3>
                        <p>Provide data with this form to create your app.</p>
                    </div>
                    <!-- App Wizard -->
                    <div id="wizard-create-app" class="bs-stepper vertical mt-2 shadow-none border-0">
                        <div class="bs-stepper-header border-0 p-1">
                            <div class="step" data-target="#details">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="bx bx-file fs-5"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title text-uppercase">Details</span>
                                        <span class="bs-stepper-subtitle">Enter Details</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#frameworks">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="bx bx-box fs-5"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title text-uppercase">Frameworks</span>
                                        <span class="bs-stepper-subtitle">Select Framework</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#database">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="bx bx-data fs-5"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title text-uppercase">Database</span>
                                        <span class="bs-stepper-subtitle">Select Database</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#billing">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="bx bx-credit-card fs-5"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title text-uppercase">Billing</span>
                                        <span class="bs-stepper-subtitle">Payment Details</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#submit">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="bx bx-check fs-5"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title text-uppercase">Submit</span>
                                        <span class="bs-stepper-subtitle">Submit</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content p-1">
                            <form onSubmit="return false">
                                <!-- Details -->
                                <div id="details" class="content pt-3 pt-lg-0">
                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Application Name" />
                                    </div>
                                    <h5>Category</h5>
                                    <ul class="p-0 m-0">
                                        <li class="d-flex align-items-start mb-3">
                                            <div class="badge bg-label-info p-2 me-3 rounded">
                                                <i class="bx bx-file bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">CRM Application</h6>
                                                    <small class="text-muted">Scales with any business</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="details-radio" class="form-check-input" type="radio" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start mb-3">
                                            <div class="badge bg-label-success p-2 me-3 rounded">
                                                <i class="bx bx-cart bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">eCommerce Platforms</h6>
                                                    <small class="text-muted">Grow Your Business With App</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="details-radio" class="form-check-input" type="radio" value="" checked />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <div class="badge bg-label-danger p-2 me-3 rounded">
                                                <i class="bx bx-laptop bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Online Learning platform</h6>
                                                    <small class="text-muted">Start learning today</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="details-radio" class="form-check-input" type="radio" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="col-12 d-flex justify-content-between mt-4">
                                        <button class="btn btn-label-secondary btn-prev" disabled>
                                            <i class="bx bx-left-arrow-alt bx-xs me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                            <i class="bx bx-right-arrow-alt bx-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Frameworks -->
                                <div id="frameworks" class="content pt-3 pt-lg-0">
                                    <h5>Category</h5>
                                    <ul class="p-0 m-0">
                                        <li class="d-flex align-items-start mb-3">
                                            <div class="badge bg-label-info p-2 me-3 rounded">
                                                <i class="bx bxl-react bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">React Native</h6>
                                                    <small class="text-muted">Create truly native apps</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="frameworks-radio" class="form-check-input" type="radio" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start mb-3">
                                            <div class="badge bg-label-danger p-2 me-3 rounded">
                                                <i class="bx bxl-angular bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Angular</h6>
                                                    <small class="text-muted">Most suited for your application</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="frameworks-radio" class="form-check-input" type="radio" value="" checked="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start mb-3">
                                            <div class="badge bg-label-warning p-2 me-3 rounded">
                                                <i class="bx bxl-html5 bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">HTML</h6>
                                                    <small class="text-muted">Progressive Framework</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="frameworks-radio" class="form-check-input" type="radio" value="" checked />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <div class="badge bg-label-success p-2 me-3 rounded">
                                                <i class="bx bxl-vuejs bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">VueJs</h6>
                                                    <small class="text-muted">JS web frameworks</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="frameworks-radio" class="form-check-input" type="radio" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="col-12 d-flex justify-content-between mt-4">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="bx bx-left-arrow-alt bx-xs me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                            <i class="bx bx-right-arrow-alt bx-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Database -->
                                <div id="database" class="content pt-3 pt-lg-0">
                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail2" placeholder="Database Name" />
                                    </div>
                                    <h5>Select Database Engine</h5>
                                    <ul class="p-0 m-0">
                                        <li class="d-flex align-items-start mb-3">
                                            <div class="badge bg-label-danger p-2 me-3 rounded">
                                                <i class="bx bxl-firebase bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Firebase</h6>
                                                    <small class="text-muted">Cloud Firestone</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="database-radio" class="form-check-input" type="radio" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start mb-3">
                                            <div class="badge bg-label-warning p-2 me-3 rounded">
                                                <i class="bx bxl-amazon bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">AWS</h6>
                                                    <small class="text-muted">Amazon Fast NoSQL Database</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="database-radio" class="form-check-input" type="radio" value="" checked />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <div class="badge bg-label-info p-2 me-3 rounded">
                                                <i class="bx bx-data bx-sm"></i>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">MySQL</h6>
                                                    <small class="text-muted">Basic MySQL database</small>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input name="database-radio" class="form-check-input" type="radio" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="col-12 d-flex justify-content-between mt-4">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="bx bx-left-arrow-alt bx-xs me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                            <i class="bx bx-right-arrow-alt bx-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- billing -->
                                <div id="billing" class="content">
                                    <div id="AppNewCCForm" class="row g-3 pt-3 pt-lg-0 mb-5" onsubmit="return false">
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <input class="form-control app-credit-card-mask" type="text" placeholder="1356 3215 6548 7898" aria-describedby="modalAppAddCard" />
                                                <span class="input-group-text cursor-pointer p-1" id="modalAppAddCard"><span class="app-card-type"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" placeholder="John Doe" />
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <input type="text" class="form-control app-expiry-date-mask" placeholder="MM/YY" />
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="modalAppAddCardCvv" class="form-control app-cvv-code-mask" maxlength="3" placeholder="654" />
                                                <span class="input-group-text cursor-pointer" id="modalAppAddCardCvv2"><i class="text-muted bx bx-help-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Card Verification Value"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" checked />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Save card for future billing?</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between mt-4">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="bx bx-left-arrow-alt bx-xs me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                            <i class="bx bx-right-arrow-alt bx-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- submit -->
                                <div id="submit" class="content text-center pt-3 pt-lg-0">
                                    <h5 class="mb-2 mt-3">Submit</h5>
                                    <p>Submit to kick start your project.</p>
                                    <!-- image -->
                                    <img src="../../assets/img/illustrations/man-with-laptop-light.png" alt="Create App img" width="200" class="img-fluid" data-app-light-img="illustrations/man-with-laptop-light.png" data-app-dark-img="illustrations/man-with-laptop-dark.png" />
                                    <div class="col-12 d-flex justify-content-between mt-4 pt-2">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="bx bx-left-arrow-alt bx-xs me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-success btn-next btn-submit">
                                            <span class="align-middle d-sm-inline-block d-none">Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/ App Wizard -->
            </div>
        </div>
    </div>
    <!--/ Create App Modal -->

    <!-- Two Factor Auth Modal -->

    <div class="modal fade" id="twoFactorAuth" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Select Authentication Method</h3>
                        <p class="text-muted">
                            You also need to select a method by which the proxy authenticates to the directory serve.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content ps-3" for="customRadioTemp1" data-bs-target="#twoFactorAuthOne" data-bs-toggle="modal">
                                    <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1" />
                                    <span class="d-flex align-items-start">
                                        <i class="bx bx-cog bx-md me-3"></i>
                                        <span>
                                            <span class="custom-option-header">
                                                <span class="h4 mb-2">Authenticator Apps</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <span class="mb-0">Get code from an app like Google Authenticator or Microsoft Authenticator.</span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content ps-3" for="customRadioTemp2" data-bs-target="#twoFactorAuthTwo" data-bs-toggle="modal">
                                    <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp2" />
                                    <span class="d-flex align-items-start">
                                        <i class="bx bx-message bx-md me-3"></i>
                                        <span>
                                            <span class="custom-option-header">
                                                <span class="h4 mb-2">SMS</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <span class="mb-0">We will send a code via SMS if you need to use your backup login method.</span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Authentication App -->
    <div class="modal fade" id="twoFactorAuthOne" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-2">
                        <h3 class="mb-0">Add Authenticator App</h3>
                    </div>
                    <h5 class="mb-2 pt-1 text-break">Authenticator Apps</h5>
                    <p class="mb-4">
                        Using an authenticator app like Google Authenticator, Microsoft Authenticator, Authy, or
                        1Password, scan the QR code. It will generate a 6-digit code for you to enter below.
                    </p>
                    <div class="text-center">
                        <img src="../../assets/img/icons/misc/authentication-QR.png" alt="QR Code" width="140" />
                    </div>
                    <div class="alert alert-warning alert-dismissible my-3" role="alert">
                        <h5 class="alert-heading mb-2">ASDLKNASDA9AHS678dGhASD78AB</h5>
                        <p class="mb-0">If you're having trouble using the QR code, select manual entry on your app</p>
                    </div>
                    <div class="mb-4">
                        <input type="email" class="form-control" id="twoFactorAuthInput" placeholder="Enter Authentication Code" />
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-label-secondary me-sm-3 me-1" data-bs-toggle="modal" data-bs-target="#twoFactorAuth">
                            <i class="bx bx-left-arrow-alt bx-xs me-1 scaleX-n1-rtl"></i><span class="align-middle">Back</span>
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <span class="align-middle">Continue</span><i class="bx bx-right-arrow-alt bx-xs ms-1 scaleX-n1-rtl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Authentication via SMS -->
    <div class="modal fade" id="twoFactorAuthTwo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="mb-2 pt-1">Verify Your Mobile Number for SMS</h5>
                    <p class="mb-4">
                        Enter your mobile phone number with country code, and we will send you a verification code.
                    </p>
                    <div class="mb-4">
                        <input type="text" class="form-control" id="twoFactorAuthInputSms" placeholder="747 875 3459" />
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-label-secondary me-sm-3 me-1" data-bs-toggle="modal" data-bs-target="#twoFactorAuth">
                            <i class="bx bx-left-arrow-alt bx-xs me-1 scaleX-n1-rtl"></i><span class="align-middle">Back</span>
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <span class="align-middle">Continue</span><i class="bx bx-right-arrow-alt bx-xs ms-1 scaleX-n1-rtl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Two Factor Auth Modal -->
    <script>
        // Check selected custom option
        window.Helpers.initCustomOptionCheck();
    </script>

    <!-- Pricing Modal -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-pricing">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- Pricing Plans -->
                    <div class="rounded-top">
                        <h2 class="text-center mb-2 mt-0 mt-md-4">Find the right plan for your site</h2>
                        <p class="text-center pb-3">
                            Get started with us - it's perfect for individuals and teams. Choose a subscription plan that
                            meets your needs.
                        </p>
                        <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 py-5 mb-0 mb-md-4">
                            <label class="switch switch-primary ms-sm-5 ps-sm-5 me-0">
                                <span class="switch-label">Monthly</span>
                                <input type="checkbox" class="switch-input price-duration-toggler" checked />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Annual</span>
                            </label>
                            <div class="mt-n5 ms-n5 ml-2 mb-2 d-none d-sm-inline-flex align-items-start">
                                <img src="../../assets/img/pages/pricing-arrow-light.png" alt="arrow img" class="scaleX-n1-rtl" data-app-dark-img="pages/pricing-arrow-dark.png" data-app-light-img="pages/pricing-arrow-light.png" />
                                <span class="badge badge-sm bg-label-primary">Save upto 10%</span>
                            </div>
                        </div>

                        <div class="row mx-0 gy-3">
                            <!-- Basic -->
                            <div class="col-lg mb-md-0 mb-4">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body position-relative">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="../../assets/img/icons/unicons/bookmark.png" alt="Starter Image" height="80" />
                                        </div>
                                        <h3 class="card-title fw-semibold text-center text-capitalize mb-1">Basic</h3>
                                        <p class="text-center">A simple start for everyone</p>
                                        <div class="text-center mb-5">
                                            <div class="d-flex justify-content-center mb-1">
                                                <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                                                <h1 class="fw-bold h1 mb-0 text-primary">0</h1>
                                                <sub class="h5 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                                            </div>
                                            <small class="position-absolute start-0 end-0 m-auto price-yearly price-yearly-toggle text-muted">Free</small>
                                        </div>

                                        <ul class="ps-3 my-4 list-unstyled">
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                100 responses a month
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Unlimited forms and surveys
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Unlimited fields
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Basic form creation tools
                                            </li>
                                            <li class="mb-0">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Up to 2 subdomains
                                            </li>
                                        </ul>

                                        <a href="auth-register-basic.html" class="btn btn-label-success d-grid w-100">Your Current Plan</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Pro -->
                            <div class="col-lg mb-md-0 mb-4">
                                <div class="card border-primary border shadow-none">
                                    <div class="card-body position-relative">
                                        <div class="position-absolute end-0 me-4 top-0 mt-4">
                                            <span class="badge bg-label-primary">Popular</span>
                                        </div>
                                        <div class="my-3 pt-2 text-center">
                                            <img src="../../assets/img/icons/unicons/wallet-round.png" alt="Pro Image" height="80" />
                                        </div>
                                        <h3 class="card-title fw-semibold text-center text-capitalize mb-1">Pro</h3>
                                        <p class="text-center">For small to medium businesses</p>
                                        <div class="text-center mb-5">
                                            <div class="mb-1 d-flex justify-content-center">
                                                <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                                                <h1 class="price-toggle price-yearly fw-bold h1 mb-0 text-primary">42</h1>
                                                <h1 class="price-toggle price-monthly fw-bold h1 mb-0 d-none text-primary">49</h1>
                                                <sub class="h5 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                                            </div>
                                            <small class="position-absolute start-0 end-0 m-auto price-yearly price-yearly-toggle text-muted">$ 499 / year</small>
                                        </div>

                                        <ul class="ps-3 my-4 list-unstyled">
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Up to 5 users
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                120+ components
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Basic support on Github
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Monthly updates
                                            </li>
                                            <li class="mb-0">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Integrations
                                            </li>
                                        </ul>

                                        <a href="auth-register-basic.html" class="btn btn-primary d-grid w-100">Upgrade</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Enterprise -->
                            <div class="col-lg">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="../../assets/img/icons/unicons/briefcase-round.png" alt="Pro Image" height="80" />
                                        </div>
                                        <h3 class="card-title text-center text-capitalize fw-semibold mb-1">Enterprise</h3>
                                        <p class="text-center">Solution for big organizations</p>

                                        <div class="text-center mb-5">
                                            <div class="mb-1 d-flex justify-content-center">
                                                <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                                                <h1 class="price-toggle price-yearly fw-bold h1 mb-0 text-primary">84</h1>
                                                <h1 class="price-toggle price-monthly fw-bold h1 mb-0 d-none text-primary">99</h1>
                                                <sub class="h5 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                                            </div>
                                            <small class="position-absolute start-0 end-0 m-auto price-yearly price-yearly-toggle text-muted">$ 999 / year</small>
                                        </div>

                                        <ul class="ps-3 my-4 list-unstyled">
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Up to 10 users
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                150+ components
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Basic support on Github
                                            </li>
                                            <li class="mb-2">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Monthly updates
                                            </li>
                                            <li class="mb-0">
                                                <span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span>
                                                Speedy build tooling
                                            </li>
                                        </ul>

                                        <a href="auth-register-basic.html" class="btn btn-label-primary d-grid w-100">Upgrade</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Pricing Plans -->
            </div>
        </div>
    </div>
    <!--/ Pricing Modal -->

    <script src="../../assets//js/pages-pricing.js"></script>
</div>
<!-- / Content -->

<?php include_once 'footer.php'; ?>