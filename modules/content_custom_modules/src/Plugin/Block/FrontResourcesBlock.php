<?php

namespace Drupal\content_custom_modules\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use \Drupal\node\Entity\Node;
use Drupal\Core\Render\Markup;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\content_custom_modules\Controller\ContentCustomModulesController;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "front_page_resources_block",
 *   admin_label = @Translation("front_page_resources_block"),
 * )
 */
class FrontResourcesBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page resources block */
  public function build() {

    $ContentCustomControllerRef = new ContentCustomModulesController;
    global  $theme_path;
    global $base_url;
    $html ='';
    $choose_tpl="";
    $tid_array=array();
    $choose_tpl=array();
    $carousel_name_class=array();
        
    /*Query, to get textnomy list in which having vid or machine name tabs*/

    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', 'tabs')
          ->sort('weight');
    $tids = $query->execute();
    $terms = Term::loadMultiple($tids);
    $count=0;
    foreach ($terms as $term) {
         $tid_array[$count] = $term->get('tid')->getString();
         $choose_tpl[$count] = $term->get('name')->getString();
         $carousel_name_class[$count] = $term->get('field_tab_class_name')->getString();

        $count++;
    }

    /* This configuaration isPage variable is used to make diffrent html using same FrontResourcesBlock method */

        if($this->configuration['isPage']=="resources"){
            $html.='<div class="resource-main"><div class="container-fluid grey-bg">';
            $count=0;
            while($count < sizeof($tid_array)){
                $array=$this->getNodesByTaxonomyTermIds($tid_array[$count]);
                $j=0;
                $html.='<div class="container res-main m2m_scroll " id='.$choose_tpl[$count].' >
             <div class="row">
               <div class="res-tem" >
                   <!--Carousel block start   res-tem-in -->
                       <div class="'.$carousel_name_class[$count].' res-box-style clearfix ">
                           <div class=" col-sm-3  col-md-2 col-xs-12 no-padding" >
                             <div class="res-box " >
                               <h1 class="head-res-main">'.$choose_tpl[$count].'</h1>
                             </div>
                           </div>
                           <div class="tab-content col-md-10   col-sm-8 col-xs-11 pull-right">
                               <div id="templates'.$count.'" class=" tab-res tab-pane active" role="tabpanel">
                                   <div class="tabcontent-inner1 ">
                                      <div id="demo'.$count.'" >
                                       <div class="owl-carousel tab-carousel owl-theme carousel_class" id="carousel'.$count.'" style="opacity: 1; display: block;">';
                 $html.= $ContentCustomControllerRef->resouces_block_content_method($array,$tid_array,$count);//4-5-16
        $html .='</div>
                                 </div>
                               </div>
                             </div>
                         </div>
                       </div>
                       </div>
                   <!--Carousel block end-->
               </div>
               </div>';
                    $count++; 
         }

         $html .='</div></div></div>';
        }else{
        $html.='<div class="container-fluid resourcesmain-div">
            <div class="container">
            <div class="row">
            <div class="col-md-12 resource">
            <h1>Resources you can use</h1>
            <br>';
           
    
        $count=0;
        $html.='<ul class="nav nav-tabs resource-tabs" role="tablist">';
        while($count < sizeof($choose_tpl)){
                if($count==0 && $tid_array[$count] == 5){
                    $html.='<li class="'.$carousel_name_class[$count].'1 succ-tab" role="presentation">';
                    
                }else if($count==0){
                     $html.='<li class="active '.$carousel_name_class[$count].'1" role="presentation">';
                }
                else{
                
                        $html.='<li class=" '.$carousel_name_class[$count].'1" role="presentation">';
                }
                $html.='<a data-toggle="tab" role="tab" aria-controls="res'.$count.'" href="#res'.$count.'">'.$choose_tpl[$count].'</a>
                </li>';
                $count++;
        }
        $html.='</ul><div class="tab-content tabcontent-inner">';
        $count =0;
           
        while($count < sizeof($tid_array)){
                if($count==0){
                 $html.='<div role="tabpanel" class="tab-pane active" id="res'.$count.'">';   
                }
                else{
                   $html.='<div role="tabpanel" class="tab-pane " id="res'.$count.'">'; 
                }
                $html.='<div class="tabcontent-inner1 ">
                            <div id="demo'.$count.'" >
                                <div id="owl-demo'.$count.'" class="owl-carousel tab-carousel">';
                                $array=$this->getNodesByTaxonomyTermIds($tid_array[$count]);
                                $html.= $ContentCustomControllerRef->resouces_block_content_method($array,$tid_array,$count);//4-5-16
                            $html.='</div>
                                    </div>
                                </div> 
                            </div>';
            $count++;
        }   
        $html.=' <a href="'.$base_url.'/success_story"><button id="succ_view_btn" class="btn btn-danger" ">View More</button></a>
            </div></div></div></div></div>';      
        }

        return [
        '#markup' => Markup::create($html),
      ];
 
    
 }
 function getNodesByTaxonomyTermIds($termIds){
    $termIds = (array) $termIds;
    if(empty($termIds)){
      return NULL;
    }
  
    $query = \Drupal::database()->select('taxonomy_index', 'ti');
    $query->fields('ti', array('nid'));
    $query->condition('ti.tid', $termIds, 'IN');
    $query->distinct(TRUE);
    $result = $query->execute();
  
    if($nodeIds = $result->fetchCol()){
        return $nodeIds;
      //return Node::loadMultiple($nodeIds);
    }
  
    return NULL;
  }

}