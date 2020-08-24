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
    //print_r($result); die;
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
            
            //echo $Select_template;  die;
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
                  case "Client_view":
                      $nodeId = $nodeItemData->get('nid')->value;
                      $return .=$this->client_view($nodeId,$selected_scroller);
                      break;
                  case "Horizontal_tab_view":
                  case "Verticle_tab_view": 
                        $nodeId = $nodeItemData->get('nid')->value;
                      $return .=$this->verticle_tab_view($nodeId,$Select_template,$selected_scroller,$section_class,$section_subhead);
                      break;
                  case "Differentiators_view":
                      $nodeId = $nodeItemData->get('nid')->value;
                      $return .=$this->differentiators_view($nodeId,$selected_scroller);
                      break; 
                  case "Contact_us_view":
                      $nodeId = $nodeItemData->get('nid')->value;
                      $return .=$this->contact_us_view($nodeId,$section_head,$section_subhead,$body);
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
                           '.str_replace(array(', full_html',', filtered_html'),'',$body).'  
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
                           '.str_replace(array(', full_html',', filtered_html'),'',$body).' 
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
     * Method Name      : simple_form_only()  Callback function for partner Carousel
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * Local variable          :  $form_id              Form id parameter
     ************************************************************************/
public function simple_form_only($selected_scroller,$section_class,$form_id){
  $ContentCustomControllerRef = new ContentCustomModulesController;
        $return ='';
         // if($selected_scroller=="Slim scroller"){
         //   $return .='</div>';  
         // } 
        $return .='<div  class="'.$section_class.'" style=" padding: 120px 0px 0px;" id="contact-form">
        <div class="container-fluid">
        <div class="container framework_form ">
          
              <h2 class="head-insta-main color-bla">Contact Us</h2>';
                $return .=$ContentCustomControllerRef->loader_success_msg("talkmsg_framework_page");// <!-- 21-3-16 Success msg-->
               $return .='<div class="row">
              <div class="form-frame">';
              //Render a framework page webform by using form id(webform-client-form-171)
                $return .=drupal_render($ContentCustomControllerRef->loadWebform($form_id));
                $return .='</div></div>';
        $return .='</div></div>';
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
                                  '. str_replace(array(', full_html',', filtered_html'),'',$body) . '
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
                        $return .=str_replace(', full_html','',$body) . '
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
                            $return .=''.str_replace(', full_html','',$body).'
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
                       $return .=''.str_replace(array(', full_html',', filtered_html'),'',$body).'
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
                                                <div class="content-innerres text-left">' . str_replace(array(', full_html',', filtered_html'),'',$body) . '</div>   
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
                      '. str_replace(', full_html','',$body) .'
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
                             <div class="content-sec m-l-70">'.str_replace(', full_html','',$body).'</div>
                                 <div class="getfree-form margin-autolr  bottom-form text-center green-form clearfix" style="margin:20px auto; "> 
                                     <h3>Get <span class="yellow-color">FREE</span> Consultation from our Experts</h3>
                                     <!-- 21-3-16 Success msg-->'; 
                                   $return .='';
                                  $return .=$ContentCustomControllerRef->loader_success_msg("talkmsg");
                                     $return .='<div class="get-form">';//Render a webform by using form id(webform-client-form-55)
                                         $return .=drupal_render($ContentCustomControllerRef->loadWebform('award_consulatation_form'));
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
                       $return .=str_replace(', full_html','',$body);
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

public function verticle_tab_view($nodeId,$Select_template,$selected_scroller,$section_class,$section_subhead){
  $nodeData = Node::load($nodeId);
  //get multiple paragraph data of tab view of IOT & wearable page...
  if ($paragraph_field_items = $nodeData->get('field_tab_view')->getValue()) {
    // Get storage. It very useful for loading a small number of objects.
    $paragraph_storage = \Drupal::entityTypeManager()->getStorage('paragraph');
    // Collect paragraph field's ids.
    $ids = array_column($paragraph_field_items, 'target_id');
    // Load all paragraph objects.
    $paragraphs_objects = $paragraph_storage->loadMultiple($ids);
    /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
    $i =0;
    foreach ($paragraphs_objects as $paragraph) {
      // Get field from the paragraph.
      if($paragraph->get('field_tab_head')->getValue())
        $tab_head[$i] = $paragraph->get('field_tab_head')->getValue()[0]['value'];
      else
        $tab_head[$i] = "";
      
      if($paragraph->get('field_tab_body_head')->getValue())
        $tab_body_head[$i] = $paragraph->get('field_tab_body_head')->getValue()[0]['value'];
      else
      $tab_body_head[$i] = "";

      if($paragraph->get('field_tab_body_contents')->getValue())
        $body_content[$i] = $paragraph->get('field_tab_body_contents')->getValue()[0]['value'];
      else
      $body_content[$i] = "";

      if($paragraph->hasField('field_tab_body_image') && !$paragraph->get('field_tab_body_image')->isEmpty())
        $h_body_image[$i] = file_create_url($paragraph->get('field_tab_body_image')->entity->getFileUri());
      else
        $h_body_image[$i] = "";
      $i++;
    }

    if(sizeof($tab_head)>0 || sizeof($tab_body_head)>0 || sizeof($body_content)>0){
        if($Select_template=="Horizontal_tab_view"){
            $return .=$this->horizontal_tab_view_structure($tab_head,$h_body_image,$body_content,$selected_scroller,$section_class,$tab_id);
        }
        if($Select_template=="Verticle_tab_view"){
            $return .=$this->verticle_tab_view_structure($tab_head,$tab_body_head,$body_content,$section_subhead,$selected_scroller,$section_class);  
        }
        if($Select_template=="contact-us"){ 
          $return .=$this->contact_us_address_section_view_structure($tab_head,$h_body_image,$tab_body_head,$body_content,$section_subhead,$selected_scroller,$section_class); 
        }
         unset($tab_head);
         unset($tab_body_head);
         unset($body_content);
    }
  }
  return $return;
}

 /*************************************************************************
     * Method Name      : horizontal_tab_view_structure          Callback function for horizontal_tab_view1
     * Local variable   : $tab_head                     Tab head of a section body
     * Local variable   : $tab_body_content             Content inside particular tab.
     * Local variable   : $tab_id                       id on a tab.
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/
public function horizontal_tab_view_structure($tab_head,$path,$tab_body_content,$selected_scroller,$section_class,$tab_id){
            $tab_index =0;
            $return="";
            if($selected_scroller=="Slim scroller"){
               $return .='</div>';  
             } 
            $return .='<div  class="'.$section_class.'  grey-bg">
             <div class="container-fluid ">
               <div class="container ">
                 <div class="col-md-12 col-xs-12 text-left horizontal_content mtbres">
                    <ul class="nav nav-tabs tabsdev responsive" id="myTab'.$tab_id.'">';
             foreach ($tab_head as $tab_node)//Create tab link or tab view
                {//Section body head
                 if($tab_index==0){
                         $return .='<li class="test-class first_tab  ">';       
                 }
                 else{
                  $return .='<li class="test-class   ">';  
                 }
                    $return .='<a class="deco-none misc-class " href="#lot'.$tab_index.'">'.$tab_head[$tab_index].'</a></li>';
                     $tab_index++;
                }
                $return .='</ul>'; 
                $tab_index1 = 0;
                $return .='<div class="tab-content responsive tabdev-opsinner clearfix  ">';
                while($tab_index1 < $tab_index)//Craete div to render
                {
                    if($tab_index1==0){
                        $return .='<div class="tab-pane    " id="lot'.$tab_index1.'">';
                    }
                    else{
                        $return .='<div class="tab-pane  " id="lot'.$tab_index1.'">';
                    }
                    $return .='<div class="col-md-6"> 
                                <ul class="inner-list tabindev tabsdev">
                                     '.$tab_body_content[$tab_index1].'
                                </ul>
                               </div>
                                <div class="col-md-6  pad-t-btab">
                                     <img src="'.$path[$tab_index1].'" class="img-responsive">
                                </div>
                               </div>'; 
                    $tab_index1++; 
                }
                $return .='</div>';  
                $counter=0;
  $return .='</div></div></div>';
                  if($selected_scroller=="Simple scroller"){
                       $return .='</div>';
                  }
       return $return;
  }
/*************************************************************************
     * Method Name      : verticle_tab_view_structure           Callback function for verticle_tab_view1
     * Local variable   : $tab_head                     Tab head of a section body
     * Local variable   : $tab_body_content             Content inside particular tab.
     * Local variable   : $tab_id                       id on a tab.
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $section_class                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/ 
public function verticle_tab_view_structure($tab_head,$tab_body_head,$tab_body_content,$section_sub_head,$selected_scroller,$section_class){
            $return ='';
            $tab_index =0;
            if($selected_scroller=="Slim scroller"){
               $return .='</div>';
             }
            $return .='<div class="'.$section_class.'">
           <div class="container ">
              <div class="row ">
              <div class=" "> <!--tabs-innerres-->
                <div class="col-md-12">
                  <div class="inner-section">
                   <h2 class=" head-sub-se m-b-30" >'.$section_sub_head.'</h2>
                  <!-- tabs left -->
                  <div class="tabbable1 content-tab clearfix tabs-left">
                    <ul class="nav nav-tabs responsive tabs-horizantical ">';
                    foreach ($tab_head as $tab_node)//Create tab link or tab view
                    {//Section body head
                        if($tab_index == 0){
                            $return .='<li class="first_tab">';
                        }
                        else{
                            $return .='<li>';
                        }
                            $return .='<a href="#tab'.$tab_index.'" data-toggle="tab">'.$tab_head[$tab_index].'</a></li>';
                            $tab_index++;
                    }
                    $return .='</ul>';
                    $tab_index1 = 0;
                    $return .='<div class="tab-content mob-stra-tab col-md-7 col-sm-6 col-lg-8 col-xs-12" >';//col-xs-12 20-4-16
                    while($tab_index1<$tab_index)//Craete div to render
                   {
                       $return .='<div class="tab-pane  tab-panel-inner  font-size-p" id="tab'.$tab_index1.'">';  
                       if($tab_body_head[$tab_index1]!= ""){
                          $return .='<h3 >'.$tab_body_head[$tab_index1].'</h3>';
                       }
                              $return .='  '.$tab_body_content[$tab_index1].'</div>';
                         $tab_index1++;
                    }  
                    $return .='</div>
                        <!-- /tabs --> 
                        </div>
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
     * Method Name      : design_view           Callback function for verticle_tab_view1
************************************************************************/ 
public function design_view(  $body,$selected_scroller ,$section_class) {
        $return ="";
        if($selected_scroller=="Slim scroller"){
           $return .='</div>';  
         }
        $return .='<div class=" '.$section_class.'">
            <div class="cont-sec">
            '.$body.'
            </div>
          </div>';
        if($selected_scroller=="Simple scroller"){
               $return .='</div>';
         }
    return $return;
}
/*************************************************************************
     * Method Name      : client_view           This function is used to collect the data for HTML structure
************************************************************************/ 
public function client_view($nodeId,$selected_scroller)
{
   $nodeData = Node::load($nodeId);
  //get multiple paragraph data of tab view of IOT & wearable page...
  if ($paragraph_field_items = $nodeData->get('field_client_title_and_img')->getValue()) {
    // Get storage. It very useful for loading a small number of objects.
    $paragraph_storage = \Drupal::entityTypeManager()->getStorage('paragraph');
    // Collect paragraph field's ids.
    $ids = array_column($paragraph_field_items, 'target_id');
    // Load all paragraph objects.
    $paragraphs_objects = $paragraph_storage->loadMultiple($ids);
    /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
    $i =0;
    foreach ($paragraphs_objects as $paragraph) {
      // Get field from the paragraph.
      if($paragraph->get('field_client_icon_class')->getValue())
        $client_icon_class[$i] = $paragraph->get('field_client_icon_class')->getValue()[0]['value'];
      else
        $client_icon_class[$i] = "";
      
      if($paragraph->get('field_client_cat_title')->getValue())
        $client_cat_title[$i] = $paragraph->get('field_client_cat_title')->getValue()[0]['value'];
      else
      $client_cat_title[$i] = "";

      if($paragraph->hasField('field_client_images') && !$paragraph->get('field_client_images')->isEmpty()){
           $j=0;
          foreach ($paragraph->get('field_client_images') as $entityImages) {
              $client_images[] = file_create_url($entityImages->entity->getFileUri());
          }
          $client_image_logo[$i]=$client_images;
          unset($client_images);
      }
      else
        $client_images[0][$i]="";

      $i++;
    }
    if(sizeof($client_icon_class) >0 || sizeof($client_cat_title) > 0){
         $return .=$this->client_view_structure($selected_scroller,$client_icon_class,$client_cat_title,$client_image_logo);
     }
  }
  return $return;
}
/*************************************************************************
     * Method Name      : client_view_structure           Callback function for  client_view
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $client_icon_class                Class apply on a particular section.
     * Local variable   : $client_cat_title                Class apply on a particular section.
     * Local variable   : $client_image_logo                Class apply on a particular section.
     * @return          :  $return                      Return string
     ************************************************************************/ 
  public function client_view_structure($selected_scroller,$client_icon_class,$client_cat_title,$client_image_logo){
        $return ='';
            if($selected_scroller=="Slim scroller"){
              $return .='</div>';  
            } 
            $return .='<div class="container-fluid ">
                <div class="">
                    <div class="row">
                        <div class="col-md-12 main-inner-para">
                            <h1 class="headingmain-blue text-center">Our Clients</h1>
                            <h6 class="inner-sub-in text-center ">Trusted development partner of Startups to Fortune 500 companies</h6>
                            <div class="clien-main-sec">
                                <ul class="clearfix">';
            $counter =0;
            while (sizeof($client_icon_class)>$counter || sizeof($client_cat_title)>$counter){
                    $return .='<li class="client-li">
                        <div class="left-clent"> 
                          <span class="'.$client_icon_class[$counter].'"></span>'.$client_cat_title[$counter].'
                        </div>
                        <div class="right-client">
                            <div class="client-logos">
                                <ul >';
                                    if($counter < sizeof($client_image_logo)){
                                        $count=0;
                                        while($count< sizeof($client_image_logo[$counter])){
                                                $return .='<li><img src="'.$client_image_logo[$counter][$count].'"></li>';
                                            $count++;
                                        }
                                    }
                     $return .='</ul>
                            </div>
                            </div>
                    </li>';
            $counter++;
            }
            $return.='</ul>
                           </div>
                           <div class="our-client-tab">
                                <div id="accordion" class="panel-group client-tab " aria-multiselectable="true" role="tablist">';
                                $counter=0;
                        while (sizeof($client_icon_class)>$counter || sizeof($client_cat_title)>$counter){
                                $return .='<div class="panel panel-default">
                                    <div id="heading'.$counter.'" role="tab" class="panel-heading">
                                      <h4 class="panel-title clie-head">';
                                    if($counter ==0){
                                           $return .='<a aria-controls="collapseOne" aria-expanded="true" href="#client'.$counter.'" data-parent="#accordion" data-toggle="collapse" role="button">';
                                    }
                                    else{
                                           $return .='<a aria-controls="collapseOne " aria-expanded="false" href="#client'.$counter.'" data-parent="#accordion" data-toggle="collapse" role="button">';
                                    }
                                    $return .='<span class="'.$client_icon_class[$counter].' clearfix"></span> '.$client_cat_title[$counter].' 
                                        </a>
                                      </h4>
                                    </div>
                                    <div aria-labelledby="headingOne " role="tabpanel" class="panel-collapse collapse" id="client'.$counter.'">
                                      <div class="panel-body">
                                            <div class="right-client"> <div class="client-logos"><ul>';//26-2-16
                                     if($counter < sizeof($client_image_logo)){
                                            $count=0;
                                            while($count< sizeof($client_image_logo[$counter])){
                                                    $return .='<li><img src="'.$client_image_logo[$counter][$count].'"></li>';
                                                $count++;
                                            }
                                        }
                                      $return .='</ul></div></div>
                                      </div>
                                    </div>
                                  </div>';
                                $counter++;
                        }                                
                        $return .='</div>
                             </div>
                         </div>
                    </div>
                </div>';
            if($selected_scroller=="Simple scroller"){
                   $return .='</div>';
            }
        return $return;
  }
  /*Full html block Start*/
  public function full_html($selected_scroller,$section_class,$html_body){
      $return ='';
     if($selected_scroller=="Slim scroller"){
                $return .='</div>';  
              } 
              $return.='<div class=" container">';
               $return.=$html_body;
              
                if($selected_scroller=="Simple scroller"){
                     $return .='</div>';
              }
          return $return;
  }
  /*************************************************************************
     * Method Name      : differentiators_view           Callback function for  client_view
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * @return          :  $return                      Return string
     ************************************************************************/ 
  public function differentiators_view($nodeId,$selected_scroller)
  {
    $nodeData = Node::load($nodeId);
      //get multiple paragraph data of tab view of IOT & wearable page...
      if ($paragraph_field_items = $nodeData->get('field_differentiator_view')->getValue()) {
        // Get storage. It very useful for loading a small number of objects.
        $paragraph_storage = \Drupal::entityTypeManager()->getStorage('paragraph');
        // Collect paragraph field's ids.
        $ids = array_column($paragraph_field_items, 'target_id');
        // Load all paragraph objects.
        $paragraphs_objects = $paragraph_storage->loadMultiple($ids);
        /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
        $i =0;
        foreach ($paragraphs_objects as $paragraph) {
          // Get field from the paragraph.
          if($paragraph->get('field_differentiator_heading')->getValue())
            $differentiator_heading[$i] = $paragraph->get('field_differentiator_heading')->getValue()[0]['value'];
          else
            $differentiator_heading[$i] = "";
          
          if($paragraph->get('field_differentiator_content')->getValue())
            $differentiator_content[$i] = $paragraph->get('field_differentiator_content')->getValue()[0]['value'];
          else
          $differentiator_content[$i] = "";

          if($paragraph->hasField('field_differentiator_image') && !$paragraph->get('field_differentiator_image')->isEmpty())
            $differentiator_image[$i] = file_create_url($paragraph->get('field_differentiator_image')->entity->getFileUri());
          else
          $differentiator_image[$i] = "";
          
         if($paragraph->hasField('field_diff_class') && !$paragraph->get('field_diff_class')->isEmpty())
            $diff_class[$i] = $paragraph->get('field_diff_class')->getValue()[0]['value'];
          else
            $diff_class[$i] = "";
          
          $i++;
        }

        if(sizeof($differentiator_content) >0){
             $return .=$this->differentiator_view_structure($selected_scroller,$differentiator_heading,$differentiator_content,$differentiator_image,$diff_class);
        }
      }
      return $return;
  }
  /*************************************************************************
     * Method Name      : differentiator_view_structure           Callback function for  client_view
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $differentiator_heading                Class apply on a particular section.
     * Local variable   : $differentiator_content                Class apply on a particular section.
     * Local variable   : $differentiator_image                Class apply on a particular section.
     * Local variable   : $diff_class                   Class apply on a particular section.
     * @return          : $return                      Return string
     ************************************************************************/ 
  public function differentiator_view_structure($selected_scroller,$differentiator_heading,$differentiator_content,$differentiator_image,$diff_class)
  {
       $return ='';
       $count=0;
        if($selected_scroller=="Slim scroller"){
                  $return .='</div>';  
        } 
        $return.='<div class=" container">
                   <div class="row">
                      <div class="comp-poli clearfix">';
        while($count<sizeof($differentiator_content)){
                            $return.='<div class="col-md-4 col-sm-6  ">
              <h3 class="'.$diff_class[$count].'">'.$differentiator_heading[$count].'</h3>
              <div class="cont-diff main-inner-para">
                <div class="box-white"> <img src="'.$differentiator_image[$count].'"> </div>
                '.$differentiator_content[$count].'
              </div>
            </div>';
            $count++;
        }
        $return.='    </div>'
                . ' </div>';
       if($selected_scroller=="Simple scroller"){
                       $return .='</div>';
        }
      return $return;
  }
  public function contact_us_view($nodeId,$section_head,$section_subhead,$body)
  {
      $ContentCustomControllerRef = new ContentCustomModulesController;
      $html.='<div class="full_width_Cntact_Page" id="contact_page_form">
        <div class="container">
          <h1 class="headingmain-blue text-center ">'.$section_head.'</h1>
          <div class="form-main pull-left col-md-7 col-sm-6 col-xs-12 nopadding"> 
                <span id="contact_page_talkmsg" class="success_msg_class" style="display: none"> Thanks for contacting us, someone from our team will be in touch with you soon.</span> 
                '.drupal_render($ContentCustomControllerRef->loadWebform('checklist_page_form')).'
            </div>
            <div class="pull-right  col-md-5 col-sm-6 col-xs-12 ">
                <div class="email_us">
                    <h3 class="popup_head_2 email-ic"><span class=""></span>'.$section_subhead.'</h3>'.str_replace(', full_html','',$body).'</div>
            </div>
        </div>
    </div>';

    $html.='<div class="section address" id="section5">
      <div class="container">
        <div class="row">
          <div class="col-md-12 Contactez Contactez_cc">
            <h1 class="text-center">Our Offices Address</h1>
            <div class="contact-list">';
            //Get paragraph entity data via predefine function..... #contact-us section 2
            $html.=$this->verticle_tab_view($nodeId,'contact-us',$selected_scroller="",$section_class="",$section_subhead="");
    
    $html.='</div></div></div></div></div></div>';

  return $html;
  }

   /*************************************************************************
     * Method Name      : contact_us_address_section_view_structure           Callback function for 
     * Local variable   : $selected_scroller            Scroller value (Simple scroller or Slim scroller)
     * Local variable   : $tab_head                Class apply on a particular section.
     * Local variable   : $tab_body_head                Class apply on a particular section.
     * Local variable   : $body_content                Class apply on a particular section.
     * Local variable   : $section_subhead                   Class apply on a particular section.
     * Local variable   : $section_class                   Class apply on a particular section.
     * @return          : $return                      Return string
     ************************************************************************/ 
  public function contact_us_address_section_view_structure($tab_head,$h_body_image,$tab_body_head,$body_content,$section_subhead,$selected_scroller,$section_class)
  {
      $html=""; $i=0;
      foreach ($tab_head as $tab_sec) {
          $html.='<div class="col-md-4 col-sm-6">
                    <div class="bg-'.str_replace(' ','-',str_replace(array( '(', ')' ), '', strtolower($tab_head[$i]))).'">
                      <div class="location-img">
                        <img src="'.$h_body_image[$i].'" alt="'.$tab_head[$i].'">
                      </div>
                      <div class="address">
                        <h3>'.$tab_head[$i].'</h3>
                        '.$body_content[$i].'
                        <h5 class="content-number">'.$tab_body_head[$i].'</h5>
                      </div>
                    </div></div>';  
        $i++;
      }
      return $html;
  }
}