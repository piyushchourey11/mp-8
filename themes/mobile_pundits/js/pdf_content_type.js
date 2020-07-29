/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function ($) {
    ver_hor_hide_show($(".form-type-checkbox input:checked").val());
    select_pdf_hide_show($('#edit-field-choose-sectionfor-tpl-und option:selected').text());
    $("input[name='field_choose_tpl_display_pattern[und]']").click(function () {
        ver_hor_hide_show($(this).val());
    });
    $("#edit-field-choose-sectionfor-tpl-und").change(function () {
        var select_value = $('#edit-field-choose-sectionfor-tpl-und option:selected').text();
        select_pdf_hide_show(select_value);
    });
    function ver_hor_hide_show(value) {
        $("#edit-field-choose-verticle-section-fo").hide();
        $("#edit-field-choose-horizontal-section-").hide();
        if (value == "Vertical") {
            $("#edit-field-select-popup-page-for-pdf").show();
            $("#edit-field-choose-verticle-section-fo").show();
        }
        if (value == "Horizontal") {
            $("#edit-field-select-popup-page-for-pdf").show();
            $("#edit-field-choose-horizontal-section-").show();
        }
    }
    function select_pdf_hide_show(select_value) {
        if (select_value != "Success Stories") {
            $(".form-item-field-select-popup-page-for-pdf-und").hide();
        }
        else {
            $(".form-item-field-select-popup-page-for-pdf-und").show();
        }
        if ($(".form-type-checkbox input:checked").val() != "") {
            $(".form-item-field-select-popup-page-for-pdf-und").show();
        }
    }
});


//  function hide_show(value) {
//        if (value == "Tab_view") {
//            $(".group-carousel-view-pdf").show();//18-4-16
//            $("#tab-view-pdf").show();
//            $(".form-item-field-select-popup-page-for-pdf-und").show();  
//        }
//        else if (value == "Carousel_view") {
//            $("#tab-view-pdf").hide();
//            $(".group-carousel-view-pdf").show();
//            $(".form-item-field-select-popup-page-for-pdf-und").hide();
//        }
//        else if(value == "Both"){
//             $("#tab-view-pdf").show();
//             $(".group-carousel-view-pdf").show();
//            // $("#edit-field-choose-sectionfor-tpl").show();
//        }
//else {
//  $(".field-group-fieldset").hide();
// }
//    }
//      $(".form-item-field-choose-template-view-und input").click(function () {
//        hide_show($(this).val());
//    });

//