jQuery(document).ready(function ($) {

    //Checklist popup page form open close
    $("#model").on("click", function () {
        $('#checklist_popup_form').modal('toggle');
        $("#webform-client-form-350").show();
        $("#this-cheklist").text("Email this checklist");
        $(".check-talkmsg1").hide();
    });

jQuery('.simple_scroller  #myCarousel-inner').css('padding-top',jQuery('#header').height()-20);
jQuery('.simple_scroller').css('margin-top',0);
jQuery('.inner-page-class.slim_scroller #section0').css('padding-top',jQuery('#header').height()-20);

    var insight_text, pdf_id;
    $(".insights-imgs").on("click", function () {
        $(".ekko-lightbox").addClass("cs-popup");
        pdf_id = ($(this).attr("value")).split("/").pop();
        insight_text = $(this).find("p").text();
    })
    $('form').trigger("reset"); //Reset all form on reload a page
    /**********************Custom rule for form validation START*******************/
    /*Rule for  min-max length Start here*/
    jQuery.validator.addMethod('custom_minlength', function (value, element, param) {
        var length = (($.trim(value)).length);
        return this.optional(element) || length >= param;
    }, 'Length will be ');
    jQuery.validator.addMethod('custom_maxlength', function (value, element, param) {
        var length = (($.trim(value)).length);
        return this.optional(element) || length <= param;
    }, 'Length will be ');

    /*Rule for  phone number Starts here*/
    jQuery.validator.addMethod('telephoneNumber', function (value, element) {
        return this.optional(element) || /^[0-9\.\-\+]+$/.test(value);
    }, 'Please Enter Correct Telephone Number Number');

    /*custom rule for validate phoneNumber*/
    jQuery.validator.addMethod('phoneNumber', function (value, element) {
        return this.optional(element) || /^[\(\)\.\- ]{0,}[0-9]{3}[\(\)\.\- ]{0,}[0-9]{3}[\(\)\.\- ]{0,}[0-9]{4}[\(\)\.\- ]{0,}$/.test(value);
    }, 'Please Enter Correct Phone Number');

    /*custom rule for validate country_code*/
    jQuery.validator.addMethod("country_code", function (value, element) {
        return this.optional(element) || /^\+?(\d{1,5})$/.test(value);
    }, "Please Enter Correct country code");

    /*custom rule for validate company_name*/
    jQuery.validator.addMethod('company_name', function (value, element) {
        return this.optional(element) || /^[A-Za-z0-9]+(( [A-Za-z0-9]+)|('[A-Za-z0-9]+)|( +))*$/.test(value);
    }, 'Comapany name');

    /*custom rule for validate user_name*/
    jQuery.validator.addMethod('user_name', function (value, element) {
        return this.optional(element) || /^[A-Za-z]+(( [A-Za-z]+)|('[A-Za-z]+)|( +))*$/.test(value);
    }, 'Please Enter Correct Last Name');

    //custom rule for user email 
    jQuery.validator.addMethod("check_mail_valid", function (value, element) {
        return this.optional(element) || /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(value);
    }, "Enter valid email ids");

    /*Code to add custom rule to validate multi email  Starts here*/
    jQuery.validator.addMethod('multiemail', function (value, element) {
        var valid;
        if (this.optional(element)) // return true on optional element 
            return true;
        var emails = value.split(/[,]+/); // split element by , and ;
        valid = true;
        for (var i in emails) {
            value = emails[i];
            valid = valid && jQuery.validator.methods.email.call(this, $.trim(value), element) && /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(value);
        }
        return valid;
    }, 'Invalid email format: please use a comma to separate multiple email addresses');
    /*Code to add custom rule to validate multi email  Ends here*/
    /**********************Custom rule for form validation END *********************/

    /***********************Apply validation on webforms START**********************/
    $(document).on("click", ".popup_page_from_btn", function () { //Carousel Popup contact form
        var contactForm = $(this).parents("form.contact_form_valid");
        formValidator(contactForm); //formValidator("#webform-client-form-99");
    }); //free_consultation
	function nameFieldValidation(contactForm,hasValid=false){
		var name=contactForm.find('#edit-name').val();
			contactForm.find('#edit-name').siblings('label.error').remove();
			name=name.trim();
			if(name==''){
				jQuery('<label class="error">Please enter  your name</label>').insertAfter(contactForm.find('#edit-name'));
				hasValid=false;
			}else if(/^[A-Za-z]+(( [A-Za-z]+)|('[A-Za-z]+)|( +))*$/.test(name)==false){
				jQuery('<label class="error">Alphabets only</label>').insertAfter(contactForm.find('#edit-name'));
				hasValid=false;
			}else if(name.length <2 || name.length >30){
				jQuery('<label class="error">Name must be between 2 and 30 characters long.</label>').insertAfter(contactForm.find('#edit-name'));
				hasValid=false;
			}else{
				hasValid=true;
			}
			return hasValid;
	}
	function emailFieldValidation(contactForm,hasValid=true){
		var email=contactForm.find('#edit-email').val();
			contactForm.find('#edit-email').siblings('label.error').remove();
			email=email.trim();
			if(email==''){
				jQuery('<label class="error">Please enter  your email address</label>').insertAfter(contactForm.find('#edit-email'));
				hasValid=false;
			}else if(/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i.test(email)==false){
				jQuery('<label class="error">Please enter valid mail id</label>').insertAfter(contactForm.find('#edit-email'));
				hasValid=false;
			}else{
				hasValid=hasValid;
			}
			return hasValid;
	}
	function phoneFieldValidation(contactForm,hasValid=true){
		var phone=contactForm.find('#edit-phone').val();
			contactForm.find('#edit-phone').siblings('label.error').remove();
			phone=phone.trim();
			if(phone==''){
				jQuery('<label class="error">Please enter your phone number</label>').insertAfter(contactForm.find('#edit-phone'));
				hasValid=false;
			}else if(/^[\(\)\.\- ]{0,}[0-9]{3}[\(\)\.\- ]{0,}[0-9]{3}[\(\)\.\- ]{0,}[0-9]{4}[\(\)\.\- ]{0,}$/.test(phone)==false){
				jQuery('<label class="error">Please enter valid Phone number</label>').insertAfter(contactForm.find('#edit-phone'));
				hasValid=false;
			}else if(phone.length <6){
				jQuery('<label class="error">Phone number at least 6 digits long.</label>').insertAfter(contactForm.find('#edit-phone'));
				hasValid=false;
			}else{
				hasValid=hasValid;
			}
			return hasValid;
	}
	$('#webform-submission-award-consulatation-form-node-500-add-form, #webform-submission-award-consulatation-form-node-47-add-form').find('.g-recaptcha').css('float','left');
    $(document).on("change", "#webform-submission-checklist-page-form-node-520-add-form #edit-name, #webform-submission-award-consulatation-form-node-313-add-form #edit-name, #webform-submission-award-consulatation-form-node-500-add-form #edit-name, #webform-submission-award-consulatation-form-node-47-add-form #edit-name", function () {
		var contactForm= $(this).parents("form.contact_form_valid");
		nameFieldValidation(contactForm,true);
	});
    $(document).on("change", "#webform-submission-checklist-page-form-node-520-add-form #edit-email, #webform-submission-award-consulatation-form-node-313-add-form #edit-email, #webform-submission-award-consulatation-form-node-500-add-form #edit-email, #webform-submission-award-consulatation-form-node-47-add-form #edit-email", function () {
		var contactForm= $(this).parents("form.contact_form_valid");
		emailFieldValidation(contactForm,true);
	});
    $(document).on("change", "#webform-submission-checklist-page-form-node-520-add-form #edit-phone, #webform-submission-award-consulatation-form-node-313-add-form #edit-phone, #webform-submission-award-consulatation-form-node-500-add-form #edit-phone, #webform-submission-award-consulatation-form-node-47-add-form #edit-phone", function () {
		var contactForm= $(this).parents("form.contact_form_valid");
		phoneFieldValidation(contactForm,true);
	});
    $(document).on("click", ".checklist_form_btn", function () { //Checklist page form id
        var contactForm = $(this).parents("form.contact_form_valid");
		var hasValid=false;
		hasValid= nameFieldValidation(contactForm,hasValid);
		hasValid= emailFieldValidation(contactForm,hasValid);
		hasValid= phoneFieldValidation(contactForm,hasValid);		
			if(hasValid!=true){
				return hasValid;
			}
        // formValidator(contactForm); //formValidator("#webform-client-form-292");
		
					var name = contactForm.find("#edit-name").val();
                    var email = contactForm.find("#edit-email").val();
                    var company = contactForm.find("#edit-company").val();
                    var contact = contactForm.find("#edit-phone").val();
                    var country = contactForm.find("#edit-country").val();
                    var comment = contactForm.find("#edit-comment").val();
					var contact_form_id=contactForm.attr('id');


                    // var honey_form_value = $(id_class).find("input[name=form_build_id]").val();
                    // var honey_form_id = $(id_class).find("input[name=form_token]").val();

                    var googleResponse = "";
                    console.log("testing");

                    if (contactForm.find('.g-recaptcha-response').length) {
                        googleResponse = contactForm.find('.g-recaptcha-response').val();
                    }
                    if (!googleResponse) {
                        console.log("Captcha not  "+googleResponse);
                        contactForm.parents('.get-form').prev("#captchaError").css("display", "block");
                        return false;
                    } else {
						contactForm.parents('.get-form').prev("#captchaError").hide();
					contactForm.find(".checklist_form_btn").attr({
                            disabled: true,
                            value: "Sending..."
                        });
					}
                    $.ajax({
                        type: "POST",
                        url: base_path + 'cross_site_form',
                        data: {
                            form_id: contact_form_id,
                            name: name,
                            email: email,
                            contact: contact,
                            country: country,
                            comment: comment,
                            // honey_form_value: honey_form_value,
                            // honey_form_id: honey_form_id,
                            googleResponse: googleResponse
                        },
                        success: function (result) {
                            if (result == true) { // if (result != '') {
                                $("#"+contact_form_id).trigger("reset").hide();
                                $(".success_msg_class").fadeIn().show(1000); //.delay(2000).fadeOut();
                                ga('send', 'pageview', '/contactUs/thanks.html');
                            } else {}
                        }
                    })
		return false;
    });
    // $(document).on("submit", ".checklist_form_btn", function () { //Checklist page form id
    //     var contactForm = $(this).parents("form.contact_form_valid");
    //     formValidator(contactForm); //formValidator("#webform-client-form-292");

    // });
    $(document).on("click", "#light_frm_submit_btn", function () { //Checklist page form id
        var contactForm = $(this).parents("form.contact_form_valid");
        formValidator(contactForm);
    });
    $(document).on("click", "#checklist_popup_btn", function () { //Checklist page popup form id
        var contactForm = $(this).parents("form.contact_form_valid");
        formValidator(contactForm); //formValidator("#webform-client-form-292");
    });
    $(document).on("click", ".framework_form_submit_btn", function (e) { //Framework page contact form
        big_formValidator("#webform-submission-frameworks-contact-form-node-166-add-form");
    });

    /************************Apply validation on webforms END**********************/
    /**************************Define Validation Start  "**************************/
    function formValidator(form_btn_id) {
        var contact_form_id = $(form_btn_id).attr("id");
		form_btn_id.validate({
            rules: {
                'submitted[first_name]': {
                    required: true, //alpha to restrict all except alphabate
                    user_name: true,
                    custom_minlength: 2,
                    maxlength: 30
                },
                'submitted[last_name]': {
                    required: true, //alpha to restrict all except alphabate
                    user_name: true,
                    custom_minlength: 2,
                    custom_maxlength: 30
                },
                'email': {
                    required: true,
                    email: true,
                    check_mail_valid: true
                },
                'name': {
                    required: true, //alpha to restrict all except alphabate
                    user_name: true,
                    custom_minlength: 2,
                    custom_maxlength: 30
                },
                'submitted[country_code]': {
                    required: true,
                    custom_minlength: 1,
                    country_code: true
                },
                'phone': {
                    required: true,
                    custom_maxlength: 15,
                    custom_minlength: 6,
                    telephoneNumber: true
                },
                'submitted[company]': {
                    custom_minlength: 2,
                    required: true,
                },
                'submitted[multiple_email]': {
                    multiemail: true
                }
            },
            messages: {
                'name': {
                    required: "Please enter  your name",
                    custom_minlength: 'Name must be between 2 and 30 characters long.',
                    custom_maxlength: 'Name must be between 2 and 30 characters long.',
                    user_name: "Alphabets only"
                },
                'submitted[first_name]': {
                    required: "Please enter  your First name",
                    custom_minlength: 'Name must be between 2 and 30 characters long.',
                    custom_maxlength: 'Name must be between 2 and 30 characters long.',
                    user_name: "Alphabets only"
                },
                'submitted[last_name]': {
                    required: "Please enter  your Last name",
                    custom_minlength: 'Name must be between 2 and 30 characters long.',
                    custom_maxlength: 'Name must be between 2 and 30 characters long.',
                    user_name: "Alphabets only"
                },
                'email': {
                    required: "Please enter your email address",
                    email: "Invalid email id",
                    check_mail_valid: "Please enter valid mail id"
                },
                'submitted[country_code]': {
                    required: "Please enter your country code",
                    custom_minlength: 'Country Code must be between 2 and 5 digit long.',
                },
                'phone': {
                    required: "Please enter your phone number",
                    telephoneNumber: 'Please enter valid Phone number',
                    custom_minlength: 'Phone number at least 6 digits long.'
                },
                'submitted[company]': {
                    required: 'Please enter your company name',
                    custom_minlength: 'Company Name at least 2 characters long.'
                },
                'submitted[multiple_email]': {
                    multiemail: 'Please enter valid mail'
                }
            },
            submitHandler: function (form) {
                var ar = contact_form_id.split('-');
                var form_id = ar[ar.length - 1];
                if (contact_form_id == "webform-submission-popup-contact-form-add-form") { //Inside popup form
                    $("#popup_submit_btn").attr("value", "Sending...").css({
                        color: "white",
                        background: "#f79616 none repeat scroll 0 0",
                        disabled: true
                    });
                    var name = $("#edit-name").val();
                    var email = $("#edit-email").val();
                    var company = $("#edit-company").val();
                    var contact = $("#edit-phone").val();
                    var country = $("#edit-country").val();
                    var comment = $("#edit-comment").val();
                    $.ajax({
                        type: "POST",
                        url: drupalSettings.basePath + '/cross_site_form',
                        data: {
                            form_id: contact_form_id,
                            name: name,
                            email: email,
                            company: company,
                            contact: contact,
                            country: country,
                            comment: comment
                        },
                        success: function (result) { console.log(result);
                            if (result == true) { // if (result != '') {
                                //$("#popup_submit_btn").attr("value", "Let's Talk").css({color: "white", background: "#f79616 none repeat scroll 0 0", disabled: false});
                                $("#popup_submit_btn").attr("value", "Submit").css({
                                    color: "white",
                                    background: "#f79616 none repeat scroll 0 0",
                                    disabled: false
                                });
                                $("#"+contact_form_id).hide().trigger("reset"); //reset this form on reload a page;
                                $("#pop_talkmsg").fadeIn().show(1000);
                                ga('send', 'pageview', '/contactUs/thanks.html');
                            } else {}
                        }
                    });
                }

                if (contact_form_id == "webform-submission-award-consulatation-form-node-313-add-form") { //Checklist page form
                    console.log("dsadsad");
                    var id_class;
                    if ($("#free_consultation_form_popup").css("display") == "block") {
                        id_class = "#free_consultation_form_popup";
                    } else if ($("#contact_page_form").css("display") == "block") {
                        id_class = "#contact_page_form";
                    } else {
                        id_class = ".bottom-form";
                    }
                    // $(id_class).find(".checklist_form_btn").attr({disabled: true, value: "Sending..."});
                    $(id_class).find(".check_talkmsg").hide();
                    var name = $("#edit-name").val();
                    var email = $("#edit-email").val();
                    var company = $("#edit-company").val();
                    var contact = $("#edit-phone").val();
                    var country = $("#edit-country").val();
                    var comment = $("#edit-comment").val();


                    // var honey_form_value = $(id_class).find("input[name=form_build_id]").val();
                    // var honey_form_id = $(id_class).find("input[name=form_token]").val();

                    // var googleResponse = "";
                    // console.log("testing");

                    // if ($(id_class).find('.g-recaptcha-response').length) {
                    //     googleResponse = $(id_class).find('.g-recaptcha-response').val();
                    // }
                    // if (!googleResponse) {
                    //     console.log("Captcha not  "+googleResponse);
                    //     $(id_class).find("#captchaError").css("display", "block");
                    //     return false;
                    // } else {
                    //     $(id_class).find("#captchaError").css("display", "none");
                    //     $(id_class).find(".checklist_form_btn").attr({
                    //         disabled: true,
                    //         value: "Sending..."
                    //     });
                    //     //captchaError
                    // }
                    $.ajax({
                        type: "POST",
                        url: drupalSettings.basePath + 'cross_site_form',
                        data: {
                            form_id: contact_form_id,
                            name: name,
                            email: email,
                            contact: contact,
                            country: country,
                            comment: comment,
                            // honey_form_value: honey_form_value,
                            // honey_form_id: honey_form_id,
                            // googleResponse: googleResponse
                        },
                        success: function (result) {
                            console.log(result);
                            if (result == true) { // if (result != '') {
                                $(id_class).find("#"+contact_form_id).trigger("reset").hide();
                                $(id_class).find(".success_msg_class").fadeIn().show(1000); //.delay(2000).fadeOut();
                                ga('send', 'pageview', '/contactUs/thanks.html');
                            } else {}
                        }
                    });
                }

                if (contact_form_id == "webform-client-form-55") { //light box popup form
                    $("#light_frm_submit_btn").attr({
                        disabled: true,
                        value: "Sending..."
                    });
                    var name = $("#edit-submitted-name--2").val();
                    var email = $("#edit-submitted-email--2").val();
                    var contact = $("#edit-submitted-phone--2").val();
                    var country = $("#edit-submitted-country").val();
                    var img_url = $(".ekko-lightbox-container img").attr("src");
                    $.ajax({
                        type: "POST",
                        url: Drupal.settings.basePath + 'cross_site_form',
                        data: {
                            form_id: form_id,
                            name: name,
                            email: email,
                            contact: contact,
                            country: country,
                            img_url: img_url,
                            insight_text: insight_text,
                            pdf_id: pdf_id
                        },
                        success: function (result) {
                            if (result == true) { // if (result != '') {
                                $("#light_frm_submit_btn").attr({
                                    disabled: false,
                                    value: "Let's Talk"
                                });
                                $("#webform-client-form-55").hide(); //reset this form on reload a page
                                $(".light-info").hide();
                                $("#insight-talkmsg").show();
                                ga('send', 'pageview', '/contactUs/thanks.html');
                            }
                        }
                    });
                }
                if (contact_form_id == "webform-client-form-350") { //checklist  popup form
                    $("#checklist_popup_btn").attr({
                        disabled: true,
                        value: "Sending..."
                    });

                    var name = $("#edit-submitted-first-name").val();
                    var email = $("#edit-submitted-email--2").val();
                    var last_name = $("#edit-submitted-last-name").val();
                    var multiemail = $("#edit-submitted-multiple-email").val();
                    $.ajax({
                        type: "POST",
                        url: Drupal.settings.basePath + 'cross_site_form',
                        data: {
                            form_id: form_id,
                            name: name,
                            email: email,
                            last_name: last_name,
                            allemail: multiemail
                        },
                        success: function (result) { // if (result != '') {
                            if (result == true) {
                                $("#checklist_popup_btn").attr({
                                    disabled: false,
                                    value: "Send Checklist"
                                });
                                $(".check-talkmsg1").show();
                                $("#webform-client-form-350").hide().trigger("reset"); //reset this form on reload a page
                                $("#this-cheklist").text("Checklist sent");
                                ga('send', 'pageview', '/contactUs/thanks.html');
                            } else {}
                        }
                    });
                }
                return false;
            }
        });
    }
    /*Framework inner page webform validation START id-177*/
    function big_formValidator(form_btn_id) {
        $(form_btn_id).validate({
            rules: {
                'first_name': {
                    required: true,
                    user_name: true, //alpha to restrict all except alphabate
                    custom_minlength: 2,
                    custom_maxlength: 30
                },
                'last_name': {
                    required: true,
                    user_name: true,
                    custom_minlength: 2,
                    custom_maxlength: 30
                },
                'company_name': {
                    required: true,
                    custom_minlength: 2
                },
                'email': {
                    required: true,
                    check_mail_valid: true,
                    email: true
                },
                'telephone_1': {
                    custom_minlength: 6,
                    telephoneNumber: true
                },
                'submitted[telephone_2]': {
                    custom_minlength: 6,
                    telephoneNumber: true
                },
                'which_ecommerce_platform_are_you_using': {
                    minlength: 5
                },
                'zip_code': {
                    required: true,
                    custom_minlength: 4,
                    zip_code: true
                },
            },
            messages: {
                'first_name': {
                    required: 'Please enter your name',
                    user_name: 'Alphabets only', //alpha to restrict all except alphabate
                    custom_minlength: 'First name must be between 2 and 30 characters long.',
                    custom_maxlength: 'First name must be between 2 and 30 characters long.'
                },
                'last_name': {
                    required: 'Please enter your last name',
                    user_name: 'Alphabets only', //alpha to restrict all except alphabate
                    custom_minlength: 'Last name must be between 2 and 30 characters long.',
                    custom_maxlength: 'Last name must be between 2 and 30 characters long.'
                },
                'telephone_1': {
                    telephoneNumber: 'Please enter valid Phone number',
                    custom_minlength: 'Phone number at least 6 digits long.',
                },
                'submitted[telephone_2]': {
                    telephoneNumber: 'Please enter valid Phone number',
                    custom_minlength: 'Phone number at least 6 digits long.',
                },
                'email': {
                    required: "Please enter your email address",
                    email: "Invalid email id",
                    check_mail_valid: "Please enter valid mail id"
                },
                'company_name': {
                    required: 'Please enter your company name',
                    custom_minlength: 'Company Name at least 2 characters long.',
                }
            },
            submitHandler: function (form) {
                // var ar = form_btn_id.split('-');
                // var form_id = ar[ar.length - 1];
                var form_id = jQuery('input[name=form_id]').val();
                var first_name, company_name, url, email, tel1, e_platform, country;
                // if (form_id == "171") { //Framework page form
                    $("#webform-submission-frameworks-contact-form-node-166-add-form").find(".framework_form_submit_btn").attr({
                        value: "Sending...",
                        disabled: true,
                    });
                    first_name = $("#edit-first-name").val();
                    company_name = $("#edit-company-name-").val();
                    url = $("#edit-ecommerce-store-url").val();
                    email = $("#edit-email").val();
                    tel1 = $("#edit-telephone-1").val();
                    e_platform = $("#edit-which-ecommerce-platform-are-you-using-").val();
                    country = $("#edit-country").val();
                    jQuery.ajax({
                        type: "POST",
                        url:  base_path+'cross_site_form',
                        data: {
                            form_id: form_id,
                            first_name: first_name,
                            company_name: company_name,
                            ecommerce_store_url: url,
                            email: email,
                            tel1: tel1,
                            e_platform: e_platform,
                            country: country
                        },
                        success: function (result) {
                            if (result == true) { // if (result != '') {
                                $("#webform-submission-frameworks-contact-form-node-166-add-form").find(".framework_form_submit_btn").attr({
                                    value: "Submit",
                                    disabled: false
                                });
                                $("#webform-submission-frameworks-contact-form-node-166-add-form").hide();
                                $("#talkmsg_framework_page").css("display", "block !important").fadeIn().show(1000); //21-3-16
                                ga('send', 'pageview', '/contactUs/thanks.html');
                                // $("#webform-client-form-171").delay(3000).fadeIn().trigger("reset");//reset this form on reload a page;
                            } else {}
                        }
                    });
					
                // }
			return false;
            }
        });
    }
    /*Framework inner page webform validation END*/
    /*******************Get selected state name START******************************/
    $("#contact_list").change(function () {
        var state = $(this).val();
        $("#contact_no").text(state);
    });
    /*******************Get selected state name code END****************************/
    /*******************Checklist page score Code START****************************/
    var countChecked = function () {
        var n = $('input:checked').length;
        var score_count = ($('#score').text()).split("/");
        $('#score').text(n + '/' + score_count[1]);
    };
    countChecked();
    $('input[type=checkbox]').on('click', countChecked);
    /*******************Checklist page score Code END****************************/
});