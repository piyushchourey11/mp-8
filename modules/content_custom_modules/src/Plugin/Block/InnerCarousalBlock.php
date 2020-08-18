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
 *   id = "inner_carousel_block",
 *   admin_label = @Translation("inner_carousel_block"),
 * )
 */
class InnerCarousalBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page inner carousal block */
  public function build() { 
        $ContentCustomControllerRef = new ContentCustomModulesController;  //create controller reference object..
        $count = 0;

        $NodeObj =\Drupal::routeMatch()->getParameter('node');
        $NodeId = $NodeObj->id();
        $nodesInnerCarouselData = Node::load($NodeId);
        if($nodesInnerCarouselData->hasField('field_select_scroller') && !$nodesInnerCarouselData->get('field_select_scroller')->isEmpty()){
                $selected_scroller = $nodesInnerCarouselData->field_select_scroller->getString();
        }
        if($nodesInnerCarouselData->hasField('field_header_carousel_active') && !$nodesInnerCarouselData->get('field_header_carousel_active')->isEmpty()){
                $Carousel_active = $nodesInnerCarouselData->field_header_carousel_active->getString();
        }
        if($nodesInnerCarouselData->hasField('field_section_select') && !$nodesInnerCarouselData->get('field_section_select')->isEmpty()){
                $category_page1 = $nodesInnerCarouselData->field_section_select->getString();
        }

        if($nodesInnerCarouselData->hasField('field_side_popup') && !$nodesInnerCarouselData->get('field_side_popup')->isEmpty()) {
                $side_popup = $nodesInnerCarouselData->field_side_popup->getString();
        }
        if($nodesInnerCarouselData->hasField('field_add_carousel_') && !$nodesInnerCarouselData->get('field_add_carousel_')->isEmpty()){
                $total_carousel_size = sizeof($nodesInnerCarouselData->field_add_carousel_);
        }
        if($nodesInnerCarouselData->hasField('field_add_partner_carousel') && !$nodesInnerCarouselData->get('field_add_partner_carousel')->isEmpty()){
                $partner_car = $nodesInnerCarouselData->field_add_partner_carousel->getString();
        }

        if($nodesInnerCarouselData->hasField('field_success_stories_on_page') && !$nodesInnerCarouselData->get('field_success_stories_on_page')->isEmpty()){
                $add_success_stories_section = $nodesInnerCarouselData->field_success_stories_on_page->getString();
        }

        if($nodesInnerCarouselData->hasField('field_banner_text') && !$nodesInnerCarouselData->get('field_banner_text')->isEmpty()){
                $banner_title = $nodesInnerCarouselData->field_banner_text->getString();
        }
        if($nodesInnerCarouselData->hasField('field_banner_subtext') && !$nodesInnerCarouselData->get('field_banner_subtext')->isEmpty()){
                $banner_sub_title = $nodesInnerCarouselData->field_banner_subtext->getString();
        }
        
      if($nodesInnerCarouselData->hasField('field_banner_image') && !$nodesInnerCarouselData->get('field_banner_image')->isEmpty())
            $banner_image = file_create_url($nodesInnerCarouselData->field_banner_image->entity->getFileUri());
      else
            $banner_image="";

      if($nodesInnerCarouselData->hasField('field_banner_img_for_touchdevice') && !$nodesInnerCarouselData->get('field_banner_img_for_touchdevice')->isEmpty())
        $banner_image_for_touch = file_create_url($nodesInnerCarouselData->field_banner_img_for_touchdevice->entity->getFileUri());
      else
        $banner_image_for_touch="";

      if($nodesInnerCarouselData->hasField('field_banner_class') && !$nodesInnerCarouselData->get('field_banner_class')->isEmpty())
        $banner_class = $nodesInnerCarouselData->field_banner_class->getString();
      else
        $banner_class="";

    if($nodesInnerCarouselData->hasField('field_sub_footer_section') && !$nodesInnerCarouselData->get('field_sub_footer_section')->isEmpty())
        $sub_foot_active = $nodesInnerCarouselData->field_sub_footer_section->getString();
      else
        $sub_foot_active="";

    /*Related success stories slider..."Related with #section-3 below" */
    while ($count < $total_carousel_size) { //get total success story on a page
        if($nodesInnerCarouselData->hasField('field_add_carousel_') && !$nodesInnerCarouselData->get('field_add_carousel_')->isEmpty()){
           
                $carousels[$count] = $nodesInnerCarouselData->field_add_carousel_[$count]->target_id;
                if($count<5){//get array of banners display on a page
                    $caousels_id[$count]= $nodesInnerCarouselData->field_add_carousel_[$count]->target_id;
                }
                $count++;
            }
    }
    

        //Create html for banner image...
        if($selected_scroller=="Simple scroller"){
            $html .='<div class=" inner-page-class fullpage-wrapper simple_scroller '.$banner_class.'">';
        }else {
            $html .='<div id="fullpage" class=" inner-page-class  slim_scroller">'; //fullpage-wrapper
        }

        if ($Carousel_active == 'Yes') {
            if ($selected_scroller == "Simple scroller") {
                $html .=' <div class="section  clearfix"  >';
            } else {
                $html .=' <div class="section  clearfix" id="section0" >';
            }
            $html .=$this->InheritOtherBlockMethod("carousel_block");   
            //Render partner carousel by using partner region
            if ($partner_car == "Yes") {
                $html .= '<div class="container  clients-div " >';
                $html .=$this->InheritOtherBlockMethod("partner_carousel_block");
                $html .= '</div>';
            }
        }
        if($Carousel_active =="No"){
            if($banner_image!=""){
                $html .='<div><div class=" banner '.$banner_class.' "> '
                         . '<img  src="' . $banner_image . '" class="img-responsive  desktop-img">
                        <img  src="' . $banner_image_for_touch . '" class="img-responsive touch-device-img">'
                        . '<h1>'.$banner_title.'<br><span>'.$banner_sub_title.'</span></h1> </div></div>';
            }
            $html .="<div>";
        }
                    
        if($selected_scroller=="Simple scroller"){
            $html .= '</div>';  
        }

        //$html .="</div>";
        $html .=$this->InheritOtherBlockMethod("inner_page_section_block",$category_page1,$selected_scroller);
        
        /* Side poup implement for particular condition */
        if ($selected_scroller == "Simple scroller" && $side_popup == "Yes") {
             $html .=$ContentCustomControllerRef->side_popup_html();
        }
        /* Related resources section structure for based on following condition  */
        if ($selected_scroller == "Simple scroller" && $sub_foot_active == "Yes") {
             $html .=$ContentCustomControllerRef->getHtmlSection();
        }
        /* Secton-3 this function is used to add Related Success Stories in ( Content custom module controller) */
        if ($total_carousel_size > 3 && $add_success_stories_section=='Yes') {
            $html .=$ContentCustomControllerRef->relatedResoureSlider($carousels);
        }  
        

    return [
      '#markup' => Markup::create($html),
    ];
}


public function InheritOtherBlockMethod($blockId,$pageId="",$selected_scroller=""){ 
    $block_manager = \Drupal::service('plugin.manager.block');
    $block_config = [];
    $block_plugin = $block_manager->createInstance($blockId, $block_config);
    $block_build = $block_plugin->build($pageId,$selected_scroller);
    $block_content = render($block_build);
    return $block_content;
}
 
}