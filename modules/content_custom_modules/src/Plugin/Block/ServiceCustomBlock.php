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
 *   id = "service_block",
 *   admin_label = @Translation("service_block"),
 * )
 */
class ServiceCustomBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page service block */
  public function build() { 
    $frontInnerControllerRef = new ContentCustomModulesController;
    global $theme_path;
    $theme_path =  drupal_get_path('theme','mobile_pundits');
    $html ='';
    
   /** Query to get services_content_type data from database **/
    $query = \Drupal::entityQuery('node');
    $query->condition('status', 1)
          ->condition('type', 'services_content_type');
    $result = $query->execute();
    $nodes = Node::loadMultiple($result);
    if(count($nodes)>0){
      $html.= '<div class="row">
             <div class="col-md-12 service-sec">
                <div class="ourservice-div">
                  <div class="overservice-headding">
                    <h1>Our Services</h1>
                    <h3> Using Enterprise Mobility to Business Advantage</h3>
                  </div>
                  <div class="clearfix">
                  </div>
                   <div class="services-main row ">';
     
      foreach ($nodes as $serviseNodeItem) {
        
        $path = file_create_url($serviseNodeItem->field_services_image->entity->getFileUri());
        $getTitle = $serviseNodeItem->field_services_image->getValue();
        $img_title= $getTitle[0]['title'];
        $img_class = $serviseNodeItem->get('field_services_image_class')->getString();

        $serviceTitleHoverValue = $serviseNodeItem->field_services_image_title_hover->getValue();
        $image_hover_title= $serviceTitleHoverValue[0]['value'];

        $headingServiceValue = $serviseNodeItem->field_headding_service_class->getValue();
        $headding_service_class= $headingServiceValue[0]['value'];
                    
        $html.='<div class="col-md-3 '.$img_class.' ">
                    <a href="#">
                    <div class="mobility-img clearfix"> 
                        <img src="'.$path.'"> 
                    </div>
                    <div class="headding-service '.$headding_service_class.' col-md-12">
                         <h4>'.$image_hover_title.'</h4>
                    </div>
                    </a>
                </div>';       
  }  
  $html.='</div></div></div></div>';
}
    
  return [
        '#markup' => Markup::create($html),
      ];
 
    
 }

}