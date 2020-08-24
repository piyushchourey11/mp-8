<?php

namespace Drupal\content_custom_modules\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Render\Markup;
use Drupal\content_custom_modules\Controller\ContentCustomModulesController;

/**
 * Provides a block with a checklist.
 *
 * @Block(
 *   id = "checklist_page_section_block",
 *   admin_label = @Translation("checklist_page_section_block"),
 * )
 */
class ChecklistPageSectionBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page inner carousal block */
  public function build() { 
        $frontInnerControllerRef = new ContentCustomModulesController;
        $NodeObj =\Drupal::routeMatch()->getParameter('node');
        $NodeId = $NodeObj->id();
        $nodesInnerCarouselData = Node::load($NodeId);
        if($nodesInnerCarouselData->hasField('field_banner_image') && !$nodesInnerCarouselData->get('field_banner_image')->isEmpty())
            $banner_image = file_create_url($nodesInnerCarouselData->field_banner_image->entity->getFileUri());
        else
            $banner_image="";

        if($nodesInnerCarouselData->hasField('body') && !$nodesInnerCarouselData->get('body')->isEmpty()){
                $content = $nodesInnerCarouselData->body->getString();
        }else
            $content="";

        if($nodesInnerCarouselData->hasField('field_no_ofchecklist_points') && !$nodesInnerCarouselData->get('field_no_ofchecklist_points')->isEmpty()){
                $score_count = $nodesInnerCarouselData->field_no_ofchecklist_points->getString();
        }else
            $score_count="";

        $html='<div class="inner-page-class fullpage-wrapper simple_scroller"><div class="banner bg-green-slide"> <div class="container"><img src="'.$banner_image.'" class="img-responsive  desktop-img">
                   <img src="" class="img-responsive touch-device-img"></div></div></div><div></div>';
         
        $html.='<div class="container">
<div class="checklist-main clearfix">
                               <!--Left colum of a checklist page END-->
                               
                               <!-- Checklist page right colum start-->';
    
    //
    $html .=str_replace(', filtered_html','',$content).'<div class=""></div>';
    
    
    $html .='<div  class="right-chcklist " style="position: static; top: 120px; left: 885.5px;">
<div id="theFixed" class="change">                                   
<div class="scrore-main">
                                            <div style="background-color:#ef6c00;" class="score-headding">
                                                <h2>Your Score</h2>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="score-num ">
                                                <h1 id="score">0/'.$score_count.'</h1>
                                            </div>
                                            <div class="clear"></div>
                                    </div>
                                    <div class="checklist-form clearfix bottom-form">
                                        <h3>Get <span class="yello-col">FREE</span> Consultation
                                            From our Experts</h3>';
                                        //$return .=loader_success_msg("check_loader" ,"check_talkmsg");
                                        $html .='<span style="display: none" id="check_talkmsg" class="check_talkmsg success_msg_class">Thanks for contacting us, someone from our team will be in touch with you soon.</span>
                                        <span style="display: none" id="urlerrormsg">Your request has not been processed, please try again later</span>';
                                        //$block = module_invoke('webform', 'block_view', 'webform-client-form-292');
                                //$return .=render($block['content']); 
                                        $html .=drupal_render($frontInnerControllerRef->loadWebform('award_consulatation_form'));
                                    $html .='</div>
                                </div></div>
                                </div> 
                                <!--end checklist-formend-->
                               <!--Checklist page right column END--->
</div>';                                
/*CHECKLIST PAGE POPUP FORM***************/
            $html .='<div class="modal" id="checklist_popup_form" role="dialog">
            <div class="model_dialog_popup">
                <div class="modal-dialog "> 
                    <!-- Modal content-->
                    <div class="modal-content">
                     <div class="modal-header">
                       <div id="close_button_div">
                            <button id="check_dismiss_btn"type="button" class="close-btn btn btn-default btn-danger" data-dismiss="modal">X</button>
                        </div>
                        <h1 id="this-cheklist">Email this checklist</h1>
                    </div>
                        <div class="checklist-email margin-autolr text-center  clearfix ">                                
                                <span class="deliverymsg  check-talkmsg1 " style="display: none"><i class="fa fa-check-circle"></i> The checklist has been sent to the email ids provided.</span>
                                <div class="get-form ">';
                                    //$block = module_invoke('webform', 'block_view', 'webform-client-form-350');
                                    //$return .=$block['content']; 
                                $html .=drupal_render($frontInnerControllerRef->loadWebform('award_consulatation_form'));
                                    $html .='</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

         return [
          '#markup' => Markup::create($html),
        ];
}
 
}