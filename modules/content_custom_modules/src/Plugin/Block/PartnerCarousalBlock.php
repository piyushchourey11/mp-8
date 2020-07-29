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
 *   id = "partner_carousel_block",
 *   admin_label = @Translation("partner_carousel_block"),
 * )
 */
class PartnerCarousalBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page partner block */
  public function build() { 

 
    global $theme_path;
    $theme_path =  drupal_get_path('theme','mobile_pundits');
    $html ='';
    $comma="'";
    
   /** Query to get partner_carousel_content_type data from database **/
    $query = \Drupal::entityQuery('node');
    $query->condition('status', 1)
          ->condition('type', 'partner_carousel_content_type');
    $result = $query->execute();
    $nodes = Node::loadMultiple($result);//Load all the nodes or fieldvalues  of a nodes


    $total_item=count($nodes);
    if($total_item >0){

      $html.='<div class="row">
              <div class="col-md-offset-2 col-md-8 text-center">
                  <h4><span class="color-red">Clients love us!</span> Don'.$comma.'t just take our words for it...</h4>
              </div>
          </div><div class="row">
                  <div class="testi-wrapper col-md-9 ">
                      <div id="quote-carousel">
                          <ol class="carousel-indicators">';
      $item_count=0;
      while($item_count < $total_item){
          if($item_count==0)
          $html.='<li class="active"></li>';
          else
            $html.='<li></li>'; 
          $item_count++;
      }   
      $html.='</ol>
      <div class="carousel-inner"><div id="partner_slider"  height="100%" class="swipe"><div class="swipe-wrap"  >';
      $count=1;
  foreach ($nodes as $serviseNodeItem) {
        
        $path = file_create_url($serviseNodeItem->field_partner_carousel_image->entity->getFileUri());
        $partner_name = $serviseNodeItem->field_partner_name->getString();
        $bodyValue = $serviseNodeItem->body->getValue();
        $body= $bodyValue[0]['value'];
        $partner_designation = $serviseNodeItem->field_partner_designation->getString();
       

        if($count == 1)
          $html.='<div class="item active" >';         
        else
          $html.='<div class="item " >';      
  
        $html.='<div class="row">
                <div class=" testi-img text-center col-sm-3 col-xs-12"> <img class="img-circle" src="'.$path.'" style="width: 100px;height:100px;"> </div>
                <div class="testi-content col-sm-9 col-xs-12" >
                    <p class="m-b-15 ">'.$body.'</p>
                        <p> <span class=" f-15 text-left ">'.$partner_name.'</span><br>
                        <small class="f-12 text-left">'.$partner_designation.'</small> 
                        </p>
                </div>
              </div>
            </div>';

    $count++;       
  }  

  $html.='</div></div></div><!--Close 2 div 10-3-16-->
  <!-- Carousel Buttons Next/Prev -->
  <a data-slide="prev"  href="#" class="left carousel-control"><i class="fa fa fa-angle-left"></i></a>
  <a data-slide="next" href="#" class="right carousel-control"><i class="fa fa fa-angle-right"></i></a>
</div>                          
</div>
</div>';
}
return [
        '#markup' => Markup::create($html),
      ];
 
    
 }

}