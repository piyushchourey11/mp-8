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
 *   id = "inner_page_section_block",
 *   admin_label = @Translation("inner_page_section_block"),
 * )
 */
class InnerPageSectionBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  /**front page resources block */
  public function build($pageId="",$selected_scroller="") {

    $ContentCustomControllerRef = new ContentCustomModulesController;
    global  $theme_path;
    global $base_url;

    $return = '';
    $tab_index =0;
    $carousel_id=0;
    $tab_head =array();
    $tab_body_head =array();
    $body_content =array();
    $verticle_tab_view_node_array=array();
    $horizontal_tab_view_node_array=array();
    $center_image_head=array();
    $center_image_body_text=array();
    $carousel_template_head=array();
    $carousel_template_content=array();
    $tpl_link_img=array();
    $tpl_back_img=array();
    $client_images=array();
    $client_cat_title=array();
    $client_icon_class=array();
    $client_image_logo=array();
    
    //Query to get sections of a particular inner page whose id:$category_page1  from database  
    // $query = new EntityFieldQuery();
    // $entities = $query->entityCondition('entity_type', 'node')
    //         ->entityCondition('bundle', 'SectionContentType')
    //         ->fieldCondition('field_section_category_page_list', 'target_id', $pageId)
    //         ->propertyCondition('status', 1)
    //         ->propertyOrderBy('sticky');

    // $result = $query->execute();



    $query = \Drupal::entityQuery('node');
    $query->condition('status', 1)
          ->condition('type', 'SectionContentType')
          ->condition('field_section_category_page_list', $pageId);
    $result = $query->execute(); //node id array

    $nodes = Node::loadMultiple($result);  //Load all the nodes or fieldvalues  of a nodes
    // echo "<pre>"; print_r($nodes); die;
    if (count($nodes) > 0) {
        foreach ($nodes as $nodeItemData) {

          if($nodeItemData->hasField('field_section_image') && !$nodeItemData->get('field_section_image')->isEmpty())
              $path = file_create_url($nodeItemData->field_section_image->entity->getFileUri());
          else
              $path="";

          if($nodeItemData->hasField('field_section_head') && !$nodeItemData->get('field_section_head')->isEmpty())
              $section_head = $nodeItemData->field_section_head->getString();
          else
              $section_head = ""; 

          if($nodeItemData->hasField('field_section_subhead') && !$nodeItemData->get('field_section_subhead')->isEmpty())
              $section_subhead = $nodeItemData->field_section_subhead->getString();
          else
              $section_subhead = "";

          if($nodeItemData->hasField('field_body_head') && !$nodeItemData->get('field_body_head')->isEmpty())
              $body_head = $nodeItemData->field_body_head->getString();
          else
              $body_head = "";        

          if($nodeItemData->hasField('field_body_content') && !$nodeItemData->get('field_body_content')->isEmpty())
              $body = $nodeItemData->field_body_content->getString();
          else
              $body = "";

          if($nodeItemData->hasField('field_form_id') && !$nodeItemData->get('field_form_id')->isEmpty())
              $form_id = $nodeItemData->field_form_id->getString();
          else
              $form_id = "";

          if($nodeItemData->hasField('field_full_html_content') && !$nodeItemData->get('field_full_html_content')->isEmpty())
              $html_body = $nodeItemData->field_full_html_content->getString();
          else
              $html_body = "";

          //Select_template view value 
            $Select_template = $nodeItemData->field_select_template1->getString();
            //Section class 
            $section_class = $nodeItemData->field_section_class->getString();
            

            switch($Select_template){
                  case "Right_img_with_head":
                      $return .=$this->right_image_with_head($body,$body_head,$path,$section_head,$section_subhead,$selected_scroller,$section_class,$section_class);
                      break;
                  case "Right_img":
                      $return .=$this->Right_image($body,$body_head,$path,$section_head,$section_subhead,$selected_scroller,$section_class);
                      break;
                  case "Left_img":
                      $return .=$this->left_image( $path, $body_head, $body,$selected_scroller,$section_class);
                      break;
                  case "List_view":
                      $return .=$this->list_view( $body, $body_head,$path,"List_view",$selected_scroller,$section_class);
                      break;
                  case "Simple_content":
                      $return .=$this->simple_content( $section_head, $body_head, $body,$section_subhead,$selected_scroller,$section_class);
                      break;
                  case "Simple_image_only":
                      $return .=$this->list_view( $body, $body_head,$path,"Image_view",$selected_scroller,$section_class);
                      break;
                  case "Form_view":
                      $return .=$this->form_view($body,$selected_scroller,$section_class,$form_id); 
                      break;  
                  case "Design_view":
                      $return .=$this->design_view($body,$selected_scroller,$section_class); 
                      break;
                  case "Simple_form_only":
                      $return .=$this->simple_form_only($selected_scroller,$section_class,$form_id);
                      break;
                  case "Full_html_view":
                      $return .=$this->full_html($selected_scroller,$section_class,$html_body);
                      break;
                  case "Checklist_view":
                      $return .=$this->checklist_page_block1($html_body);
                      break;
                  case "Horizontal_tab_view":
                  case "Verticle_tab_view": 
                      //print_r($nodeItemData); die;
                      $return .=$this->verticle_tab_view();
                      break;
            }
          }
          $return .='</div> ';
        }
        else
        {
          $return.='<div class="section  clearfix">'.$Select_template.'</div>';
        }
      
        return [
          '#markup' => Markup::create($return),
        ];
    } 

  /*************************************************************************
     * Method Name      : right_image_with_head()  Callback function for partner Carousel
     * Local variable   : $body_head                    Body head of a section body
     * Local variable   : $path                         Path or url of an imag upload in a content type.
     * Local variable   : $section_head                 Head of a section.
     * Local variable   : $section_subhead              Section subheading
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/
public function right_image_with_head($body,$body_head,$path,$section_head,$section_subhead,$selected_scroller,$section_class){
            $return ='';
            if($selected_scroller=="Slim scroller"){
              $return .='</div>';  
            }
            $return .='<div class="'.$section_class.'" >
            <div class="container-fluid ">
              <div class="container">
                <div class="row">';
                if($selected_scroller=="Slim scroller"){
                  $return .='<div class="col-md-12  ">
                     <div class="inner-headding">';
                        if($section_head !=""){
                           $return .='<div class="heading-blue-img-slim" > '.$section_head.'</div>';
                                 if($section_subhead !=""){
                                       $return .=$section_subhead;
                                   }
                        }                   
                $return .='</div>
                     <div class="inner-section">
                       <div class="content-sec ">
                         <h2 >'.$body_head.'</h2>
                           '.$body.'  
                       </div>
                       <div class="img-sec "> <img  src="'.$path.'" class="img-responsive"> </div>
                     </div>
                   </div>';
                }
                   if($selected_scroller=="Simple scroller"){
                       $return .='<div class="  main-inner-para">
                       <div class="heading-blue-img"> <h1 class="heading-blue madhuri">'.$section_head.'</h1>'
                               ;
                       if($section_subhead !=""){
                                       $return .=$section_subhead;
                       }
                       $return .='</div>
                       <div class=" main-inner-para"><!--22-3-16 col-md-12 inner-section text-left-->
                       <div class="col-md-5 col-sm-12 col-xs-12 pull-right ">
                         <div class="inner-page-img">
                           <img src="'.$path.'" class="img-responsive"> 
                          </div> 
                       </div>
                     <div class="col-md-7  col-sm-12 col-xs-12 ">
                      <h2 >'.$body_head.'</h2>
                           '.$body.' 
                     </div>
                 </div>
               </div>';
               }
                 $return .='</div>
               </div>
             </div>';
           if($selected_scroller=="Simple scroller"){
                   $return .='</div>';
            }
        return $return;
}

 /*************************************************************************
     * Method Name      : left_image()                  Callback function for left_image
     * Local variable   : $body_head                    Body head of a section body
     * Local variable   : $path                         Path or url of an imag upload in a content type.
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/
public function left_image( $path, $body_head, $body,$selected_scroller,$section_class) {
            $return ='';
            if($selected_scroller=="Slim scroller"){
               $return .='</div>';  
            }
            $return .='<div class="'.$section_class.'">
            <div class="container-fluid ">
              <div class="container">
                <div class="row">';
                if($selected_scroller=="Slim scroller"){
                    $return .='<div class="col-md-12">
                            <div class="inner-section">
                              <div class="img-sec"> <img src="' . $path .'" > </div>
                              <div class="content-sec ">
                                <h2 >' . $body_head . '</h2>
                                  '. $body . '
                              </div>
                            </div>
                          </div>';
                  }
               if($selected_scroller=="Simple scroller"){
                   $return .='<div class="col-md-12 inner-section">
                    <div class="col-md-6 col-sm-12 col-xs-12 ">
                        <div class="inner-page-img ">
                        <img src="' . $path .'" class="img-responsive">
                        </div>
                     </div>
                      <div class="cont-in col-md-6 mid-cont-inner col-sm-12 ">';//Removed    mid-cont-inner class 
                        if($body_head !=""){
                                $return .='<h2 class="inner-page-head">'.$body_head .'</h2>';
                        }
                        $return .=$body . '
                      </div>
                  </div>';
               }
            $return .='</div>
            </div>
            </div>';
            if($selected_scroller=="Simple scroller"){
                 $return .='</div>';
            }
        return $return;
}
 /*************************************************************************
     * Method Name      : Right_image                   Callback function for Right_image
     * Local variable   : $body_head                    Body head of a section body
     * Local variable   : $path                         Path or url of an imag upload in a content type.
     * Local variable   : $section_head                 Head of a section.
     * Local variable   : $section_subhead              Section subheading
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/
public function Right_image($body,$body_head,$path,$section_head,$section_subhead,$selected_scroller,$section_class){
            $return ='';
            if($selected_scroller=="Slim scroller"){
               $return .='</div>';  
             }
            $return .='<div class="'.$section_class.'" >
            <div class="container-fluid ">
              <div class="container">
                <div class="row">';
                if($selected_scroller=="Simple scroller"){
                    $return .='<div class="col-md-12 inner-section text-left">
                         <div class="col-md-6 col-sm-12 col-xs-12 pull-right "> 
                          <div class="inner-page-img">
                           <img src="'.$path.'" class="img-responsive"> 
                          </div>
                         </div>
                         <div class=" cont-in col-md-6 mid-cont-inner col-sm-12 col-xs-12 ">';//remove mid-cont-inner class 
                           if($body_head !=""){
                                $return .='<h2 class="inner-page-head">'.$body_head.'</h2>';
                            }
                            $return .=''.$body.'
                          </div>
                        </div>';
                 }
                if($selected_scroller=="Slim scroller"){
                    $return .='<div class="col-md-12 inner-section text-left">
                    <div class="inner-section">
                      <div class=" content-sec">';
                       if($body_head !=""){
                            $return .='<h2 >'.$body_head.'</h2>';
                       }
                       $return .=''.$body.'
                      </div>
                      <div class=" img-sec m-b-res30"> <img  src="'.$path.'"> </div>
                    </div>
                    </div>'; 
                 }
                $return .='</div>
                </div>
                </div>';
                if($selected_scroller=="Simple scroller"){
                 $return .='</div>';
                }
        return $return; 
}
 /*************************************************************************
     * Method Name      : simple_content                Callback function for simple_content
     * Local variable   : $body_head                    Body head of a section body
     * Local variable   : $body                         Content inside a section.
     * Local variable   : $section_head                 Head of a section.
     * Local variable   : $section_subhead              Section subheading
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/
public function simple_content( $section_head, $body_head, $body,$section_subhead,$selected_scroller,$section_class) {
            $return ="";
            if($selected_scroller=="Slim scroller"){
               $return .='</div>';  
             }
            $return .='<div class="'.$section_class.'" >
                     
                       <div class="container ">
                         <div class="row">';
           if($selected_scroller=="Slim scroller"){
                                $return .='<div class="col-md-12">
                                            <div class="inner-headding">
                                              <div class="col-md-12 main-inner-para no-padding">

                                                <div class=" ">';
                            if($section_head !=""){
                                              $return .='<h1  class="headingmain-blue ">' . $section_head . '</h1>';
                                          
                            }     
                            if($section_subhead !=""){
                                        $return .='
                                                      <h6 class="inner-sub-head text-center ">' . $section_subhead . '</h6>
                                                   '; 
                            }
                            $return .='<h6 class="inner-sub-head text-center " >' . $body_head . '</h6>
                                                </div>
                                                <div class="content-innerres text-left">' . $body . '</div>   
                                              </div>
                                            </div>
                                          </div>';
            }     
            if($selected_scroller=="Simple scroller"){
                     $return .='<div class="col-md-12 main-inner-para"><div>';
                $return .='<h1  class="headingmain-blue ">' . $section_head . '</h1>
                              <h6 class="inner-sub-head text-center ">' . $section_subhead . '</h6>';
                $return .='</div>
                     <div class="text-left">
                      '. $body .'
                      </div>
                    </div>';          
            }
            $return .='</div></div>';
            if($selected_scroller=="Simple scroller"){
                   $return .='</div>';
             } 
        return $return;
}
/*************************************************************************
     * Method Name      : form_view                     Callback function for form_view
     * Local variable   : $body                         Content of a section.
     * Local variable   : $form_id                      Form id of form thourgh which a form will be render
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/
public function form_view($body,$selected_scroller,$section_class,$form_id){   //Text with form like application page format
  $ContentCustomControllerRef = new ContentCustomModulesController;
                $return="";
                if($selected_scroller=="Slim scroller"){
                  $return .='</div>'; 
                }
                $return .='<div  class="'.$section_class.' style="height:400px;" >
                     <div class="adard-div" style="margin-bottom:1%;">
                      <div class="container">
                       <div class="row">   
                         <div class="col-md-12 inner-section text-left">
                             <div class="content-sec m-l-70">'.$body.'</div>
                                 <div class="getfree-form margin-autolr  bottom-form text-center green-form clearfix" style="margin:20px auto; "> 
                                     <h3>Get <span class="yellow-color">FREE</span> Consultation from our Experts</h3>
                                     <!-- 21-3-16 Success msg-->'; 
                                   $return .='';
                                  $return .=$ContentCustomControllerRef->loader_success_msg("talkmsg");
                                     $return .='<div class="get-form">';//Render a webform by using form id(webform-client-form-55)
                                         //$return .=drupal_render($ContentCustomControllerRef->loadWebform('checklist_page_form'));
                            $return .='</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>';    
                if($selected_scroller=="Simple scroller"){
                      $return .='</div>';
                }
    return $return;
  }

/*************************************************************************
     * Method Name      : list_view()                   Callback function for list_view
     * Loacl variable   : $body                         Contain body of a list view section
     * Local variable   : $body_head                    Body head of a section body
     * Local variable   : $path                         Path or url of an imag upload in a content type.
     * Loacl variable   : $content_form                 Type of a content (List_view or Image_view)
     * Local variable   : $section_subhead              Section subheading
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/
public function list_view( $body, $body_head,$path,$content_form,$selected_scroller,$section_class) {
            $return ='';
            if($selected_scroller=="Slim scroller"){
            $return .='</div>'; 
            }
            $return .='<div class="'.$section_class.' " >
            <div class="container-fluid">
               <div class="container">
                <div class="row">
                 <div class=" col-md-12">
                  <div class="inner-headding">
                    <div >';// 22-3-16 class="col-md-12"
                    if($content_form == "List_view"){
                         if($body_head != ""){   
                             $return .='<h2 class=" head-sub-se  m-b-10">'.$body_head.'</h2>';//inner-sub-headlarge m-b-40 text-center changed 4-3-16
                         }
                       $return .=$body;
                        }
                        if($content_form == "Image_view"){
                             $return .='
                                <h2 class="m-b-18">'.$body_head.'</h2>
                                <div class="text-center center-img img-sec ">
                                    <img class="img-responsive" src="'.$path.'">
                                </div>';
                        }
                    $return.='</div>
                  </div>
                </div>
              </div>
            </div>
            </div>';
            if($selected_scroller=="Simple scroller"){
               $return .='</div>';
             }
        return $return;
}

public function verticle_tab_view(){

}

}