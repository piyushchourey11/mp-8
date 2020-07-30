<?php

namespace Drupal\content_custom_modules\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Render\Markup;
use Drupal\content_custom_modules\Controller\ContentCustomModulesController;

/**
 * Provides a block with a carousal.
 *
 * @Block(
 *   id = "carousel_block",
 *   admin_label = @Translation("carousel_block"),
 * )
 */
class CarousalBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page carousal block */
  public function build() { 
    $frontPage =  \Drupal::service('path.matcher')->isFrontPage(); //To Checking wheather path is a front page or not
    $html='';
 
  if($frontPage || true) {
      
              $frontNode =\Drupal::routeMatch()->getParameter('node');
              $frontPageNodeId = $frontNode->id();
              $nodesCarouselData = Node::load($frontPageNodeId);
              $carousels = array();
              if($frontPage) 
                  $CarouselFieldID = 'field_add_carousels';
              else
                  $CarouselFieldID = 'field_add_carousel_';

            if($nodesCarouselData->hasField($CarouselFieldID) && !$nodesCarouselData->get($CarouselFieldID)->isEmpty()){
                $counter = 0;
                while ($counter < count($nodesCarouselData->$CarouselFieldID)) {
                    $carousels[$counter] = $nodesCarouselData->$CarouselFieldID[$counter]->target_id;
                    $counter++;
                }
            }

            $nodes = Node::loadMultiple($carousels);
              $total_item=count($nodes);
              if($total_item >0) 
              {

                if($frontPage) {
                    $html.='<div id="myCarousel" class="head-car carousel slide home-page-carousel" style="width:100%; height:100%;" >';
                    $html.='<div class="rs-stick">
                    <h1>Resources<br>
                    you can use</h1>
                    <ul>
                        <li> <a href="resources#Templates">Templates</a></li>
                        <li> <a href="resources#Checklists">Checklists</a></li>
                        <li> <a href="resources#Insights">Insights</a></li>
                    </ul>
                  </div>';
                }else{
                   $html .='<div id="myCarousel-inner" class="head-car carousel slide  inner-page-carousel  " style="width:100%; ">'; 
                }

              $html.='<ol class="carousel-indicators">';
              $item_count=0;//set data-slide-to for carousel
              while($item_count < $total_item){
                  if($frontPage){ //Passing id of Front page Carousel
                        if($item_count==0)
                          $html.='<li data-target="#myCarousel" class="active" data-slide-to="'.$item_count.'">';  
                      else
                          $html.='<li data-target="#myCarousel" data-slide-to="'.$item_count.'">';
                  }
                  else{ //Passing id of Inner page Carousel
                      if($item_count==0){
                          $html .='<li data-target="#myCarousel-inner" class="active" data-slide-to="'.$item_count.'"';
                      }else
                    $html .='<li data-target="#myCarousel-inner" data-slide-to="'.$item_count.'"';
                  }
                $html.='</li>';
                $item_count++;
              } 
          
              $html.='</ol><div class="carousel-inner" ><div id="slider"  height="100%" class="swipe"><div class="swipe-wrap"  >';
              $count=1;
              foreach($nodes as $nodeItem)
              {
                    $carousel_id = str_replace(' ', '_',$nodeItem->field_select_pdf_popup_page->target_id);
                  
                    //desktop image
                    $path = file_create_url($nodeItem->field_carousel_image->entity->getFileUri());
                    //small device image
                    $touch_img_path=file_create_url($nodeItem->field_carousel_image_for_touch_d->entity->getFileUri());
                    
                    //homepage banner img
                    if($nodeItem->hasField('field_home_page_banner_image') && !$nodeItem->get('field_home_page_banner_image')->isEmpty())
                      $home_banner_img = file_create_url($nodeItem->field_home_page_banner_image->entity->getFileUri());
                    else
                      $home_banner_img="";
                    
                          
                    $caroHeadBody = $nodeItem->field_carousel_body_head->getValue();
                    $field_carousel_body_head= $caroHeadBody[0]['value'];
                    
                      if($nodeItem->hasField('body') && !$nodeItem->get('body')->isEmpty()){
                        $getBody= $nodeItem->body->getValue();
                        $body = ($getBody[0]['value']);
                      }
                    if($count == 1)
                      $html.='<div class="item active " >'; 
                    else
                      $html.='<div class="item " >';      
                    
                    $html.='<div class="fill" >';
                    if($frontPage)
                      $html.='<img src="'.$home_banner_img.'" class="img-responsive desktop-img">';
                    else
                        $html .='<img src="'.$path.'" class="img-responsive desktop-img">';
                                
                    $html.='<img src="'.$touch_img_path.'" class="img-responsive touch-device-img">';
                        $html.='</div>
                        <div class="carousel-caption">
                            <div class="slider-content clearfix">
                                <h3> '.$field_carousel_body_head.'</h3>';
                                if($frontPage){
                                    $html .='<p>'.$body.'</p>';
                                }
                                
                                $html.='<div class="readmor-btn pull-right"> <a id="carosel_'.$carousel_id.'"  class="carousel_link" data-toggle="modal" data-target="#read_more_modal" value="'.$carousel_id.'" href="#test_demo">Read More</a>
                                </div>
                              </div>
                          </div>
                  </div>';
                 $count++;
              }
              $html.='</div></div></div><!--add div 8-3-16-->  <!--<a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="icon-prev"></span> </a> <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="icon-next"></span> </a>--> </div>';
        } 
  }else{
    $html.='</h1>dsds</h1>';
  }
 return [
      '#markup' => Markup::create($html),
    ];
}
 
}