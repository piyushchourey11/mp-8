<?php
namespace Drupal\content_custom_modules\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Render\Markup;
use Drupal\node\Entity\Node;
// use Drupal\Core\Entity\EntityInterface;
// use Drupal\Core\Entity\EntityViewBuilder;
use Drupal\webform\Entity\Webform;
use Drupal\webform\WebformSubmissionForm;
use Drupal\paragraphs\Entity\Paragraph;

 class ContentCustomModulesController extends ControllerBase {

      public function loader_success_msg($success_id){//Success msg view Function

          $return='<div id="'.$success_id.'" class="success_msg_class" style="display: none"> Thanks for contacting us, someone from our team will be in touch with you soon.</div>';
          return  $return;
      }

      public function resouces_block_content_method($array,$tid_array,$count){
           $j = 0;
          global $theme_path, $baseUrl;
          $carousel_tpl_head = array();
          $carousel_tpl_content = array();
          $tpl_back_img = array();
          $popup_page_node_id = array();
          $field_enter_path = array();
          
          $light_box_large_image_path = array();
          $pdf_file = $carousel_tpl_head = $carousel_tpl_content = $tpl_back_img = $popup_page_node_id = $field_enter_path = $light_box_large_image_path =  array();
          $return="";
          while ($j < sizeof($array) && $j < 10) {
              $nodesData = Node::load($array[$j]);
              //$node = node_load($array[$j]);
              //print_r($nodesData); die;
              $i = 0; 
              //while ($i < count($nodesData)) {
                  
                  if($nodesData->hasField('field_pdf_head') && !$nodesData->get('field_pdf_head')->isEmpty())
                  {
                    $body = $nodesData->get('field_pdf_head')->getValue();
                    $carousel_tpl_head[$i] = $body[0]['value'];
                  }

                  if($nodesData->hasField('field_pdf_sub_content') && !$nodesData->get('field_pdf_sub_content')->isEmpty())
                  {
                    $body = $nodesData->get('field_pdf_sub_content')->getValue();
                    $carousel_tpl_content[$i] = $body[0]['value'];
                  }

                  if($nodesData->hasField('field_tpl_back_image') && !$nodesData->get('field_tpl_back_image')->isEmpty())
                    $tpl_back_img[$i] = file_create_url($nodesData->field_tpl_back_image->entity->getFileUri());
                  
                  if($nodesData->hasField('field_select_popup_page_for_pdf') && !$nodesData->get('field_select_popup_page_for_pdf')->isEmpty())
                  {
                    $body = $nodesData->get('field_select_popup_page_for_pdf')->getValue();
                    $popup_page_node_id[$i] = $body[0]['target_id'];
                  }
                  
                  if($nodesData->hasField('field_enter_path') && !$nodesData->get('field_enter_path')->isEmpty())
                  {
                    $body = $nodesData->get('field_enter_path')->getValue();
                    $field_enter_path[$i] = $body[0]['value'];
                  }

                  if($nodesData->hasField('field_light_box_large_image') && !$nodesData->get('field_light_box_large_image')->isEmpty())
                    $light_box_large_image_path[$i] = file_create_url($nodesData->field_light_box_large_image->entity->getFileUri());

                  if($nodesData->hasField('field_pdf_download_file') && !$nodesData->get('field_pdf_download_file')->isEmpty())
                    $pdf_file[$i] = file_create_url($nodesData->field_pdf_download_file->entity->getFileUri());
                  
                  if($nodesData->hasField('field_light_box_large_image') && !$nodesData->get('field_light_box_large_image')->isEmpty())
                    $fid[$i] = file_create_url($nodesData->field_light_box_large_image->entity->getFileUri());
                  
                  $i++;
                  
                  if (sizeof($carousel_tpl_content) > 0 || sizeof($carousel_tpl_head) > 0) {
                      $counter = 0;
                      while ($counter < sizeof($tpl_back_img) || $counter < sizeof($carousel_tpl_head)) {
                          if ($tpl_back_img[$counter] != "") {
                              $return .='<div class="item ">
                                          <div class="tabscontet-border m-r-10">';
                              $return .='<div class="chek-img-sec">';
                              if ($tid_array[$count] == 5) {//Successs story
                                  $return .=' <a href="#" class="success-story" value="' . $popup_page_node_id[$counter] . '">
                                              <div class="curo-img-in" > <img src="' . $tpl_back_img[$counter] . '"> </div>
                                              <div class="text-check">
                                                <p> ' . $carousel_tpl_head[$counter] . ' </p>
                                              </div>
                                              <div class="tab-pdf-in">
                                                  <img src="' . \Drupal::theme()->getActiveTheme()->getPath() . '/images/req/download_pdf_icon.png">
                                              </div>
                                              <div class="  tab-pdf-out">
                                                  <img src="' . \Drupal::theme()->getActiveTheme()->getPath() . '/images/req/download_pdf_icon_white.png">
                                              </div>
                                              </a>';
                              }
      
                              if ($tid_array[$count] == 2) {//Checklist
                                  $return .=' <a href="' . $field_enter_path[$counter] . ' " class="checklist_img">
                                             <div class="curo-img-in"   > <img src="' . $tpl_back_img[$counter] . '" > </div>
                                             <div class="text-check">
                                               <p> ' . $carousel_tpl_head[$counter] . ' </p>  
                                             </div>
                                            </a>';
                              }
                              if ($tid_array[$count] == 3) {//Insights  
                                  
                                  $return .='<a href="' . $light_box_large_image_path[$counter] . '"   class="insights-imgs" data-toggle="lightbox" value="'.$fid[$counter].'">
                                           <div class="curo-img-in"   > <img src="' . $tpl_back_img[$counter] . '" > </div>
                                           <div class="text-check">
                                             <p> ' . $carousel_tpl_head[$counter] . ' </p>
                                                 <span class="pull-right cloud_icon"></span>
                                           </div>
                                          </a>';
                              }
                              $return .='</div>
                                       </div>';
                              $return .=' </div>';
                          } else {//templates
                              $return .='<a href="' . $pdf_file[$counter] . '" class="templates" ><div class="item orange">
                                                      <div class="tabscontet-border m-r-10">
                                                       <div class="tab-box1 nopadding  ">
                                                           <h6>' . $carousel_tpl_head[$counter] . '</h6>
                                                           <p>' . $carousel_tpl_content[$counter] . '</p>
                                                           <span class="pull-right cloud_icon"></span>
                                                       </div>
                                                     </div>
                                                   </div></a>';
                          }
                          $counter++;
                      }
                  }
                  $i++;
              //}
              $j++;
          }
          return $return;
      }

      public function sliderPopup(Request $request){
       global $base_url;
        if($request->getMethod()=='POST')
        {
          $logo_image = file_url_transform_relative(file_create_url(theme_get_setting('logo.url')));
          $logo_image = \Drupal::request()->getSchemeAndHttpHost().$logo_image;
          //$formContent = $this->loadWebform('popup_contact_form');
           //print_r($formContent); die;
           //$my_form = \Drupal\webform\Entity\Webform::load('popup_contact_form');
          //$formContent = \Drupal::entityManager()
            //->getViewBuilder('webform')
            //->view($my_form);
            //print_r($formContent); die;
          if($request->get(id)){ 
            $nodeId = $request->get(id);
            $nodesData = Node::load($nodeId);
            
            //Variable_declaration
            $section2_content=""; $return="";
            $image_array =array();//popup section3 images array inserted into Popup_Page_ContentType
            $right_sec2 = $pdf_file = $right_sec2 = $left_sec2 = $field_company_name = $field_client_name = $color_class = $sidebar1_image = $sidebar2_image=$node_id = $carousel_node_id = $carousel_image= $sidebar1_text =$sidebar2_text="";
            $popup_body_head=array();//section 2 body text like BACKGROUND 
            $popup_body_inner_contents=array();//section 2 body content

            //get multiple paragraph data...
            if ($paragraph_field_items = $nodesData->get('field_popup_body_content')->getValue()) {
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
                if($paragraph->get('field_popup_body_head')->getValue())
                  $popup_body_head[$i] = $paragraph->get('field_popup_body_head')->getValue()[0]['value'];
                else
                $popup_body_head[$i] = "";
                
                if($paragraph->get('field_popup_body_inner_contents')->getValue())
                  $popup_body_inner_contents[$i] = $paragraph->get('field_popup_body_inner_contents')->getValue()[0]['value'];
                else
                $popup_body_inner_contents[$i] = "";
                $i++;
              }
            }
            
            
            if($nodesData->hasField('field_banner_image_popup') && !$nodesData->get('field_banner_image_popup')->isEmpty())
              $carousel_image = file_create_url($nodesData->field_banner_image_popup->entity->getFileUri());
            
            if($nodesData->hasField('field_sidebar_content2_image') && !$nodesData->get('field_sidebar_content2_image')->isEmpty())  
                $sidebar2_image=file_create_url($nodesData->field_sidebar_content2_image->entity->getFileUri());
            
            //get sidebar-text-2..
            if($nodesData->hasField('field_sidebar_content2_text') && !$nodesData->get('field_sidebar_content2_text')->isEmpty())
            {
              $body = $nodesData->get('field_sidebar_content2_text')->getValue();
              $sidebar2_text = $body[0]['value'];
            }
            
            //get sidebar1 image...
            if($nodesData->hasField('field_sidebar_content1_image') && !$nodesData->get('field_sidebar_content1_image')->isEmpty())
               $sidebar1_image = file_create_url($nodesData->field_sidebar_content1_image->entity->getFileUri());
            
            //get color class...
            if($nodesData->hasField('field_color_class') && !$nodesData->get('field_color_class')->isEmpty())
              $color_class = $nodesData->get('field_color_class')->getString();
            
            //get client name..
            if($nodesData->hasField('field_client_name') && !$nodesData->get('field_client_name')->isEmpty())
              $field_client_name = $nodesData->get('field_client_name')->getString();
            
            //get company name..
            if($nodesData->hasField('field_company_name') && !$nodesData->get('field_company_name')->isEmpty()){
              $body = $nodesData->get('field_company_name')->getValue();
              $field_company_name =$body[0]['value'];
            }
            
            //Section 2 body contents start
            if($nodesData->hasField('field_section2_left_content') && !$nodesData->get('field_section2_left_content')->isEmpty()){
              $body= $nodesData->get('field_section2_left_content')->getValue();
              $left_sec2=$body[0]['value'];
            }
          
          if($nodesData->hasField('field_section2_right_content') && !$nodesData->get('field_section2_right_content')->isEmpty()){
              $body=$nodesData->get('field_section2_right_content')->getValue();
              $right_sec2=$body[0]['value'];
          }

          $image_array = array();
          if ($nodesData->hasField('field_popup_section_three')) {
          foreach ($nodesData->field_popup_section_three as $item) {
              if ($item->entity) {
                $image_array[] = $item->entity->url();
              }
            }
          }

        //pdf download image 
        if($nodesData->hasField('field_download_link_image_popup'))
              $download_link_image_popup=file_create_url($nodesData->field_download_link_image_popup->entity->getFileUri());
        
        /*Pdf link*/
        if($nodesData->hasField('field_pdf_file')){
          $pdf_file_target_id=$nodesData->field_pdf_file->getValue()[0]['target_id'];
          $pdf_file.=$base_url.'/'.$pdf_file_target_id;
        }
        //Html popup view....
          $return.='<div id="'.$nodeId.'" class="cs-popup modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg";>
              <div class="modal-content">
                <div class="modal-header clearfix">
                      <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">&times</button>
                      <div class="logo pull-left"><a href="'.$base_url.'"> <img  width="248px" src="'.$logo_image.'"></a>
                        <p class="logo-title">An ISO 9001:2008 Certified Company</p>
                      </div>
                      <h3 class="pull-right story-headmain">Client Success Story</h3>
                    </div>

                    <div id="PostList" class="modal-body" style="-webkit-overflow-scrolling: touch;" >
                      <div class="story-slide"> <img src="'.$carousel_image.'" class="img-responsive"> </div>
                     <!=-31-3-16  m-b-65-->';
                             if($sidebar2_text == ""){//</div>
                                  $return .=' <div class="client-sec clearfix">
                                  <div class="client-des clearfix">
                                      <div class="cs-logo pull-left">
                                          <img src="'.$sidebar1_image.'" class=" clearfix">
                                          '.$sidebar1_text.'
                                      </div>';
                                  }
                                 else{
                                  $return.='<div class="client-sec clearfix"><div class="with-testo clearfix">
                                                <div class="col-md-4" >
                                                   <div class="main-bingo">
                                                    <div class="boingo-con"> <img src="'.$sidebar1_image.'" class="img-responsive clearfix">
                                                        '.$sidebar1_text.'
                                                    </div>
                                                   </div>
                                                   <div class="client-sto '.$color_class.'"> <i class="fa fa-quote-left "></i></i><p class="text-center story-cont">'.$sidebar2_text.' </p><i class="fa fa-quote-right pull-right"></i><img src="'.$sidebar2_image.'">
                                                     <h3 class="client-head">'.$field_client_name.'</h3>
                                                     <h4 class="client-sub-head">'.$field_company_name.'</h4>
                                                   </div>';
                                     $return .='</div>
                                                <div class="col-md-8 ">';
                                  }  
                           
                        for($j=0;$j <sizeof($popup_body_head);$j++){
                            if($j==0){
                                  if($sidebar2_text == ""){
                                      $return .='<div class="right-cont  clearfix pull-right col-sm-12 col-xs-12  col-md-8 nopadding " >';   
                                  }
                                  else{
                                      $return .='<div class="right-cont  clearfix pull-right col-sm-12 col-xs-12 nopadding" >';   
                                  }
                            }else
                            {
                                $return .='<div class="right-cont right-head-mt  clearfix  col-sm-12 col-xs-12 nopadding">';
                            }
                            $return .='<h3 class="right-main-head ">'.$popup_body_head[$j].'</h3>';
                            if($popup_body_inner_contents[$j]!=""){
                                $return .=$popup_body_inner_contents[$j];
                            }
                            $return.='</div>';
                      } 
                      if($sidebar2_text != ""){
                            $return.='</div>';
                      }
                    $return .='</div>
                     
                    <!--end container-->
                      <div class="our-solution clearfix ">';
                            if($right_sec2!= ""){
                                $return .='<div class="right-cont pull-left col-md-7 col-sm-12 nopadding"><h3 class="right-main-head ">Our Solution</h3>'.$left_sec2.'</div>';
                                $return.='<div class="techno-used pull-right col-md-4 col-sm-4  col-xs-12 '.$color_class.'"><h4>Technologies Used</h4>'.$right_sec2.'</div>';
                            }
                            else{
                                $return .='<div class="right-cont pull-left col-md-12 col-sm-12 nopadding"><h3 class="right-main-head ">Our Solution</h3>'.$left_sec2.'</div>';
                            }
                      $return.='</div>
                    <!--end client-sec form and image divs--> 
                      ';//vlearfix
                      if(sizeof($image_array)>0){
                        $return .='<div class="port-img clearfix">';
                        $count=0;
                      while($count <sizeof($image_array)){
                                $return .='<div class="screen-img"><img class="img-responsive" src="'.$image_array[$count].'"  ></div>';
                                $count++;
                      }
                      $return .='</div>';
                      }
                      $return .='<div class=" form-section clearfix"><div class="clearfix"></div><!--form-section-->
                               <div class="getfree-client text-center  clearfix"> 
                                  <h3>Get <span class="org-color">FREE</span> Consultation from our Experts</h3>';
                                   $return .=$this->loader_success_msg("pop_talkmsg");
                                   $return .='<span id="talkerrormsg" style="display: none"> Message delivery failed...Please try again later. </span>
                                     <div class="get-form">';
                   //Render a webform whose id :"webform-client-form-99 succ Popup inner form"
                   //$block = module_invoke('webform', 'block_view', 'webform-client-form-99');//99
                   $return .=drupal_render($this->loadWebform('popup_contact_form'));
                   $return .='</div>
                            </div>
                              <span id="pdf_error" style="display: none"> Please fill the form.</span>
                             
                            <div class="download-case  col-md-3 ">
                                <div class="head-down"><h3>Download Case Study</h3></div>
                                 <a class="pdf_dwn"  data-value="0" href="'.$pdf_file.'"  >
                                <img src="'.$download_link_image_popup.'"  class="img-responsive">
                                
                                    <img src="'.\Drupal::theme()->getActiveTheme()->getPath().'/images/pdf_icon.png" class="pdf-icon">
                                </a>
                            </div>
                     </div>
                   </div>
                  </div>
                <!--end modal-body form and image divs --> 
              </div>
            </div>
          </div>';
        }
        $r['html']=$return;
        return new JsonResponse($r);
        }
      }

      public function downloadPdf($id){
        if($id){
            $file_data = file_load($id);
            $file_name=$file_data->get('filename')->value;
            $path = $file_data->get('uri')->value;
            $file=$path;
            $len = filesize($file_name); // Calculate File Size
            ob_clean();
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public"); 
            header("Content-Description: File Transfer");
            header("Content-Type:application/pdf"); // Send type of file
            $header="Content-Disposition: attachment; filename=$file_name"; // Send File Name
            header($header);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".$len); // Send File Size
            @readfile($file);
          exit();
        }
      }
    
      public function loadWebform($webFormID){
        if($webFormID!=""){ 
          $my_form = \Drupal\webform\Entity\Webform::load($webFormID);
          //print_r($my_form); die;
          //$webform = \Drupal::entityTypeManager()->getStorage('webform')->load($webFormID);
          //$elements = $webform->getElementsDecodedAndFlattened();
          return $output = \Drupal::entityManager()
            ->getViewBuilder('webform')
            ->view($my_form);
          //print_r($my_form); die;
          // $webform = $webform->getSubmissionForm();
          // return $webform;
          
          // $output = \Drupal::entityManager()
          // ->getViewBuilder('webform')
          // ->view($webFormID);
          // return $output;

          // $renderer = \Drupal::service('renderer');
          // $html = $renderer->render(
          //   [
          //     '#type' => 'markup',
          //     '#webform' => $webFormID
          //   ]);
          // return $html;
         
        }
      }

      public function side_popup_html(){
        global $theme_path;
        $html .='<div class="slide-popup ">
                      <button onclick="" class="bannerbutton">X</button>
                        <a href="iot-cloud"> <img src="' . $theme_path . '/images/find-out.png"></a>
                      </div>';
        return $html;             
      }
      /* Related resource html content */
      public function getHtmlSection(){
        global $theme_path, $baseUrl;
        $html .='<div class="related-resources ">
                   <div class="container">
                    <h2 class="inner-page-head text-center">Related Resources</h2>
                    <div class="box clearfix">
                     <div class="col-md-4 col-xs-12 col-sm-4">
                       <h1>Templates</h1>
                       
                      <div class="tabscontet-border ">
                      <a class="templates " href="' . $baseUrl . '/sites/default/files/user_story.pdf">
                       <div class="tab-box1 nopadding">
                        <h6>What are User Stories and Why developers need them ?</h6>
                        <p>Developers need to understand the exact customer requirements or challenges that are faced by actual users of the application being developed.</p>
                        <span class="pull-right cloud_icon"></span>
                        </div>
                        </a>
                        <a href="resources#Templates"  class="view_all">View All</a>
                      </div>
                     </div>
                     
                     <div class="col-md-4 col-xs-12 col-sm-4">
                     <h1>Insights</h1>
                      <div class="tabscontet-border ">
                       <div class="chek-img-sec">
                       <a class="insights-imgs" data-toggle="lightbox" href="'. $theme_path . '/images/infographics.jpg"> 
                        <div class="curo-img-in">
                        <img src="sites/default/files/Pdf%20screenshot%20images/5-x.png">
                        </div>
                        <div class="text-check">
                         <p> The State of App Downloads and Monetization  </p>
                         <span class="pull-right cloud_icon"></span>
                        </div>
                        
                        </a>
                       </div>
                       <a href="resources#Insights"  class="view_all">View All</a>
                      </div>
                     </div>

                     <div class="col-md-4 col-xs-12 col-sm-4">
                     <h1>Success Stories</h1>
                     <div class="tabscontet-border ">
                      <div class="chek-img-sec">
                     
                      <a  class="popup_pdf_link success-story  " value="98" href="#">
                      <a id="pdf_popup" class="popup_pdf_link success-story success-story-inner " value="98" href="#" 0="">
                        <div class="curo-img-in"> 
                      
                          <img src="sites/default/files/Pdf%20screenshot%20images/boingo-x.jpg"> 
                        </div>
                        <div class="text-check">
                         <p> Offering Unified Omni-Channel Solution for Capturing Customer Experience </p>
                        </div>
                        
                          <div class="tab-pdf-in">
                           <img src="' . \Drupal::theme()->getActiveTheme()->getPath() . '/images/req/download_pdf_icon.png">
                          </div>
                          <div class="tab-pdf-out">
                              <img src="' . \Drupal::theme()->getActiveTheme()->getPath() . '/images/req/download_pdf_icon_white.png">
                          </div>
                      </a>
                       </div>
                       <a href="success-stories " class="view_all">View All</a>
                      </div>
                     </div>
                    </div>
                   </div>
                  </div>';
        return $html;             
      }
}