<?php

/**
 * @file
 * Contains \Drupal\custom_overriding\Controller\DisplayController.
 */
namespace Drupal\custom_overriding\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class DisplayController extends ControllerBase {

  public function display($id) {
    
  	$entityObj = entity_load('node',$id);

	//return new JsonResponse($entityObj->toArray());
  	$siteapikey = \Drupal::state()->get('siteapikey');

  	if(empty($siteapikey)){
  		throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
  	}else{

	  	if(!empty($entityObj)){
			$bundle = $entityObj->bundle();
			
			if($bundle == 'page'){
				return new JsonResponse($entityObj->toArray());
			}
			else{
				//drupal_set_message(t('There is no node associated with page with nid @id', array('@id' => $id)));
				throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
			}
		}
		else{
			/*return array(
	      		'#type' => 'markup',
	      		'#markup' => $this->t('Id not exist'),
	    	);*/
	    	throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
		}
	}
  }
}
