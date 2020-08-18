<?php

namespace Drupal\content_custom_modules\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\taxonomy\Entity\Term;
use \Drupal\node\Entity\Node;
use Drupal\Core\Render\Markup;

/**
 * Provides a 'Success Stories.
 *
 * @Block(
 *   id = "success_stories",
 *   admin_label = @Translation("Success Stories block"),
 *   category = @Translation("Success Stories"),
 * )
 */
class SuccessStoriesBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    global $theme_path;
    $return ='';
    $h_tid_array=array();
    $h_choose_tpl=array();
    $h_carousel_name_class=array();
    $h_icon_class=array();
    
    $v_tid_array=array();
    $v_choose_tpl=array();
    $v_carousel_name_class=array();
    
    $tpl_download_link_img=array();
    $tpl_back_img=array();
    $carousel_tpl_content=array();
    $carousel_tpl_head=array();

        $return .='<div class="container ">
			    		<div class="row">
						    <div class="col-md-12 main-inner-para">
						      	<div class="inner-headding">
					        		<h1 class="headingmain-blue text-center ">Success Stories</h1>
						        	<div class="main-sucess">';
		//Get horizontal tab field data...
		$h_terms =$this->getTaxonomyEntityData('success_story_hor_tabs');
		$count=0;
        foreach ($h_terms as $term) {
            $h_tid_array[$count]= $term->get('tid')->getString();
            $h_choose_tpl[$count] = $term->get('name')->getString();
            $h_carousel_name_class[$count]= $term->get('field_success_horizontal_tab_cla')->getString();
            if(!empty($term->field_icon_class)){
            $h_icon_class[$count]= $term->get('field_icon_class')->getString();
            }
            else
                $h_icon_class[$count]="";
            $count++;
        }
        //Get vertical tab field data...
        $v_terms =$this->getTaxonomyEntityData('succes_story_tabs');
        $count=0;
        foreach ($v_terms as $term) {
            $v_tid_array[$count]= $term->get('tid')->getString();
            $v_choose_tpl[$count] = $term->get('name')->getString();
            $v_carousel_name_class[$count]= $term->get('field_success_tab_class')->getString();
            $count++;
        } 
		/***  Horizontal tab view structure start ***/
    	$h_tab_count=0;
        $return.=' <ul role="tablist" class="nav nav-tabs resource-tabs success-tabs tabs-hori-succ">';
        while($h_tab_count < sizeof($h_choose_tpl)){
            if($h_tab_count==0){
            $return .='<li class=" active '.$h_carousel_name_class[$h_tab_count].' " role="presentation"> <a data-toggle="tab" role="tab" aria-controls="suc_h_'.$h_tab_count.'" href="#suc_h_'.$h_tab_count.'"><i class="fa '.$h_icon_class[$h_tab_count].'"></i> '.$h_choose_tpl[$h_tab_count].' </a></li>';
            }
            else{
                $return .=' <li class="'.$h_carousel_name_class[$h_tab_count].'" role="presentation"> <a data-toggle="tab" role="tab" aria-controls="suc_h_'.$h_tab_count.'" href="#suc_h_'.$h_tab_count.'"><i class="fa '.$h_icon_class[$h_tab_count].'"></i> '.$h_choose_tpl[$h_tab_count].'</a></li>';
            }
            $h_tab_count++;
        }
        $return .='</ul>';
     	/*** Horizontal tab view structure end ***/

     	/*** Verticle tab view structure start ****/
     	$return .='<div class="succe-ver-tabs">
            <div class="tabs-left   clearfix">      
              <ul class="nav nav-tabs tab-suces-ver ">';
        $v_tab_count=0;
        while($v_tab_count < sizeof($v_choose_tpl) ){
            	$return .=' <li class="'.$v_carousel_name_class[$v_tab_count].'"> <a data-toggle="tab"   href="#suc_v_'.$v_tab_count.'"> '.$v_choose_tpl[$v_tab_count].'</a></li>';
          	$v_tab_count++;
        }
        $return .='</ul>';
        /*** Verticle tab view structure end ***/

        /*** Verticle tab div implimentation start*/
        $return .='<div class="tab-succ-cont   clearfix">
                    <div class="tab-content clearfix">';
                    $return .=$this->success_inner_method($v_tid_array,"suc_v_");
        /*Verticle tab divs  end*/

        /*Horizontal tab div  start*/
                    $return .=$this->success_inner_method($h_tid_array,"suc_h_");
        /*Horizontal tab div  end*/
        $return .='</div>
                </div>
            </div>
        </div>';

        $return .='</div><div class="success-tab-mob">
                <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group client-tab ">';
                $counter=0;
                while($counter<sizeof($h_tid_array)){
                    $return .='<div class="panel panel-default">';
                        $return .='<div id="heading'.$counter.'" role="tab" class="panel-heading">
                                        <h4 class="panel-title clie-head '.$h_carousel_name_class[$counter].'"> <a aria-controls="collapseOne" aria-expanded="false" href="#suc_hori_tab'.$counter.'" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">'.$h_choose_tpl[$counter].' </a> </h4>
                                   </div>
                                   <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="suc_hori_tab'.$counter.'" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">';
                                         $return .=$this->success_inner_div_structute($h_tid_array[$counter]);
                             $return .='</div>'
                               . ' </div>'
                          . '</div>';
                    $counter++;
                }
                $counter=0;
                while($counter<sizeof($v_tid_array)){
                    $return .='<div class="panel panel-default">';
                        $return .='<div  role="tab" class="panel-heading">
                                        <h4 class="panel-title clie-head '.$v_carousel_name_class[$counter].' "> <a aria-controls="collapseOne" aria-expanded="false" href="#suc_ver_tab'.$counter.'" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">'.$v_choose_tpl[$counter].' </a> </h4>
                                   </div>
                                   <div aria-labelledby="" role="tabpanel" class="panel-collapse collapse" id="suc_ver_tab'.$counter.'" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">';
                                            $return .=$this->success_inner_div_structute($v_tid_array[$counter]);
                             $return .='</div> '
                                . '</div>'
                            .'</div>';
                    $counter++;
                }
            $return .='</div></div>';
    $return .='</div></div></div>
		
</div></div>';




    return [
      '#markup' => $return,
    ];
  }

  /**  This function is used to fetch tab view data **/
  public function getTaxonomyEntityData($entityQueryCondition)
  {
  	/*Query, to get textnomy list in which having vid or machine name tabs*/

    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', $entityQueryCondition)
          ->sort('weight');
    $tids = $query->execute();
    $terms = Term::loadMultiple($tids);
    return $terms;
  }

/*Inner method of a success page tab block*/
public function success_inner_method($v_tid_array,$tab_id){
		$count=0;
	    $return ='';
	    while($count < sizeof($v_tid_array)){
	            if($count==0){
	                if($tab_id=="suc_h_")
	                $return .='<div id="'.$tab_id.''.$count.'" class="tab-pane tab-panel-inner  active ">  ';   
	                else
	                    $return .='<div id="'.$tab_id.''.$count.'" class="tab-pane tab-panel-inner">  ';    
	            }
	            else{
	               $return .='<div id="'.$tab_id.''.$count.'" class="tab-pane tab-panel-inner ">  '; 
	            }
	           $return .=$this->success_inner_div_structute($v_tid_array[$count]);//call nested method for creating divs
	           $return .='</div>';
	    $count++;
	    }
	    return $return;
	}
public function success_inner_div_structute($array_value){
    global $theme_path;
    $carousel_tpl_head = array();
 	$carousel_tpl_content = array();
	$tpl_back_img = array();
	$popup_page_node_id = array();
    $return ='';
    $array=$this->getNodesByTaxonomyTermIds($array_value);
    $j=0;
    while($j<sizeof($array)){
        $nodesData = Node::load($array[$j]);
        $i=0;
        while($i < sizeof($nodesData)) {

                if($nodesData->hasField('field_pdf_head') && !$nodesData->get('field_pdf_head')->isEmpty()){
	                $body = $nodesData->get('field_pdf_head')->getValue();
	                $carousel_tpl_head[$i] = $body[0]['value'];
              	}

                if($nodesData->hasField('field_tpl_back_image') && !$nodesData->get('field_tpl_back_image')->isEmpty())
                    $tpl_back_img[$i] = file_create_url($nodesData->field_tpl_back_image->entity->getFileUri());

                if($nodesData->hasField('field_pdf_dwn_link_image') && !$nodesData->get('field_pdf_dwn_link_image')->isEmpty())
                    $tpl_download_link_img[$i] = file_create_url($nodesData->field_pdf_dwn_link_image->entity->getFileUri());

                if($nodesData->hasField('field_select_popup_page_for_pdf') && !$nodesData->get('field_select_popup_page_for_pdf')->isEmpty())
              	{
                    $body = $nodesData->get('field_select_popup_page_for_pdf')->getValue();
                    $popup_page_node_id[$i] = $body[0]['target_id'];
              	}

                $i++;
                if( sizeof($carousel_tpl_head) > 0 ){//sizeof($carousel_tpl_content) >0 ||
                       $counter=0;
                      
                        while( $counter < sizeof($tpl_back_img) || $counter < sizeof($carousel_tpl_head) ){     
                            $return .='<a id="pdf_popup"'.$counter.' class="popup_pdf_link success-story success-story-inner " href="#" value="'.$popup_page_node_id[$counter].'" ><div class="col-md-3 col-sm-6 case-succ-stu">
                                            <div class="case-stu-img"> <img class="img-responsive" src="'.$tpl_back_img[$counter].'"> </div>
                                            <div class=" text-check text-success-in">
                                              <p>'.$carousel_tpl_head[$counter].'</p>
                                            </div>
                                            <div class="pdf-succe-in"> <img src="'.\Drupal::theme()->getActiveTheme()->getPath().'/images/pdf_icon.png"> </div>
                                            <div class="  tab-pdf-out">
                                            <img src="'.\Drupal::theme()->getActiveTheme()->getPath() . '/images/req/download_pdf_icon_white.png">
                                        </div>
                                       </div>
                                       </a>';
                            $counter++;
                        }
                }
                 $i++;
        }
        $j++;
    }    
    return $return ;
}
/** Inherit other block class method **/
 public function getNodesByTaxonomyTermIds($termIds){
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