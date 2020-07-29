<?php

namespace Drupal\content_custom_modules\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use \Drupal\node\Entity\Node;
use Drupal\Core\Render\Markup;
use Drupal\content_custom_modules\Controller\ContentCustomModulesController;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "front_page_award_block",
 *   admin_label = @Translation("front_page_award_block"),
 * )
 */
class FrontAwardBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page award block */
  public function build() { 
    $frontInnerControllerRef = new ContentCustomModulesController;
    global $theme_path;
    $theme_path =  drupal_get_path('theme','mobile_pundits');
    $html ='';
    $award_image=array();
    $award_content=array();
    $count=0;

    $query = \Drupal::entityQuery('node');
    $query->condition('status', 1)
          ->condition('type', 'award_image_content');
    $result = $query->execute();
    $nodes = Node::loadMultiple($result);
    if(count($nodes)>0){
      $counter =0;
      foreach ($nodes as $item) {
        if($item->hasField('field_no_of_times1') && !$item->get('field_no_of_times1')->isEmpty()){
          $field_no_of_times1= $item->field_no_of_times1->getValue();
          $award_content[$counter] = ($field_no_of_times1[0]['value']);
        }else{
          $award_content[$counter]="";  
        }
        if($item->hasField('field_award_image1') && !$item->get('field_award_image1')->isEmpty())
        {
          $award_image[$counter] = file_create_url($item->field_award_image1->entity->getFileUri());
       
         }
        else
           {
              $award_image[$counter] = "";
            }
       
        
       $counter++;
      }
      $html.='<div class="award-div container">
              <div class="row">
                  <div class="col-md-12">';
      $html.='<div class="col-md-9 pull-left col-sm-12 "><!--change-->
                          <h3 class="text-center">Awards & Recognition</h3>
                          <div class="award-sec award-sec-home">
                              <div class="row">';
      $count=0;
      while($count<sizeof($award_image)){
          $new_count=$count+1;
            $html.='<div class="col-md-4 col-sm-4 col-xs-6"><!--change-->
            <div class="circle circle'.$new_count.'"> <img  src="'.$award_image[$count].'"/> <br/>
                <span >'.$award_content[$count].'</span> 
            </div>
            </div>';
            $count++;
      }      
              $html.=' </div>
                      </div>
                  </div>';
                  //render a webform webform-client-form-264 on popup page
                   $html.='<div class="col-md-3 pull-right col-sm-12">
                <div class="getfree-form homepage-get-form text-center clearfix bottom-form">
                    <img src="'.$theme_path.'/images/user.svg" class="svg">
                    <h3>Get <span  class="yellow-color">FREE</span> Consultation from our Experts</h3>';
                    $html.= $frontInnerControllerRef->loader_success_msg("talkmsg");
                    $html.=' <span class="captchaError error" id="captchaError" style="display: none"> Please fill up the captcha</span>';
                    $html.=' <div class="get-form " >';
                    // $block = module_invoke('webform', 'block_view', 'webform-client-form-292');//1-4-16 264 66(17-5-16)
                    // $return .=render($block['content']);     //$block = module_invoke('webform', 'block_view', 'webform-components-form');
                    $html.='</div>
                </div>
                </div></div></div></div>';  
                      
    } 
    
      return [
        '#markup' => Markup::create($html),
      ];
 
    
 }

 
}