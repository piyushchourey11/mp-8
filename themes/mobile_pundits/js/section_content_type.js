/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ($) {
    /*Section content type form js START*/
    var value = $('select#edit-field-select-template1-und:selected').val();
   
    $(".field-group-fieldset").hide();
    $("#content-view-group").show();
    if($("select").has("edit-field-select-template1-und")){
   var selected_value =$('select#edit-field-select-template1-und option:selected').val();
       show_hide(selected_value);
        $("#edit-field-select-template1-und").on('change', function () {
            show_hide(this.value);
        });
    }
   
  function show_hide(selected_value){
   
       if (selected_value == "Horizontal_tab_view" || selected_value == "Verticle_tab_view") {
            $("#tab-view-group").show();
            $("#carousel-view-group").hide();
            $("#client-view-group").hide();
            $("#field-full-html-content").hide();
           $("#client-view-group").to
        }
        else if (selected_value == "Client_view") {
            $(".field-group-fieldset").show();
            $("#content-view-group").hide();
            $("#tab-view-group").hide();
            $("#carousel-view-group").hide();
            $("#client-view-group").hide();
            $("#client-view-group").show();
             
        }
        else if (selected_value == "Full_html_view") {
            $("#content-view-group").hide();
            $("#tab-view-group").hide();
            $("#carousel-view-group").hide();
            $("#client-view-group").hide();
            $("#field-full-html-content").show();
        }
//        else if (selected_value == "Carousel_view" || selected_value == "Carousel_tpl_image_view") {
//            $("#carousel-view-group").show();
//            $("#client-view-group").hide();
//            $("#tab-view-group").hide();
//             $("#field-full-html-content").hide();
//        }
        else {
            $(".field-group-fieldset").hide();
            $("#content-view-group").show();
        }
  }
});



