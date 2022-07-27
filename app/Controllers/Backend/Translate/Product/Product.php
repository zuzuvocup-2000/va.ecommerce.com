<?php 
namespace App\Controllers\Backend\Translate\Product;
use App\Controllers\BaseController;
use App\Libraries\Nestedsetbie;

class Product extends BaseController
{
	protected $data;
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'product';
	}
	public function index($objectid = 0,  $language = ''){
		$session = session();
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/translate/product/product/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		$objectid = (int)$objectid;
		$moduleExtract = explode('_', $this->data['module']);

		// Get data current language isset
		$this->data['object'] = $this->data_current_language($objectid, $this->currentLanguage());
		if(!isset($this->data['object']) || is_array($this->data['object']) == false || count($this->data['object']) == 0){
			$session->setFlashdata('message-danger', 'Bản ghi không tồn tại!');
			return redirect()->to(BASE_URL.'backend/product/product/index');
		}

		// Get data translate 
		$this->data['translate'] = $this->data_translate($objectid, $language);
		
		$this->data['router'] = $this->AutoloadModel->_get_where([
			'select' => 'view,',
			'table' => 'router',
			'where' => ['module' => $this->data['module']]
		]);
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation($this->data['module']);
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$store = $this->storeLanguage($objectid, $language);
				if(isset($this->data['translate']) && is_array($this->data['translate']) && count($this->data['translate'])){
					$flag = $this->AutoloadModel->_update([
			 			'table' => 'product_translate',
			 			'where' => [
			 				'objectid' => $objectid,
			 				'language' => $language,
			 				'module' => $this->data['module']
			 			],
			 			'data' => $store,
			 		]);
			 		if($this->data['translate'] != $store['canonical']){
			 			$this->AutoloadModel->_update([
				 			'table' => 'router',
				 			'where' => [
				 				'objectid' => $objectid,
				 				'language' => $language,
				 				'module' => $this->data['module']
				 			],
				 			'data' => [
				 				'canonical' => slug($store['canonical'])
				 			],
				 		]);
			 		}
				}else{
					$flag = $this->AutoloadModel->_insert([
			 			'table' => 'product_translate',
			 			'data' => $store,
			 		]);
					$this->AutoloadModel->_insert([
			 			'table' => 'router',
			 			'data' => [
			 				'canonical' => slug($store['canonical']),
			 				'module' => $this->data['module'],
			 				'objectid' => $objectid,
			 				'language' => $language,
			 				'view' => $this->data['router']['view']
			 			],
			 		]);
				}
		 		if($flag > 0){
		 			$session->setFlashdata('message-success', 'Tạo Bản Dịch Thành Công! Hãy tạo danh mục tiếp theo.');
	 				return redirect()->to(BASE_URL.'backend/product/product/index');
		 		}
	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['template'] = 'backend/translate/product/product/translate';
		return view('backend/dashboard/layout/home', $this->data);
	}

	private function storeLanguage($objectid = 0, $language = 'vi'){
		helper(['text']);
		$store = [
			'objectid' => $objectid,
			'title' => validate_input($this->request->getPost('title')),
			'canonical' => slug($this->request->getPost('canonical')),
			'description' => base64_encode($this->request->getPost('description')),
			'content' => base64_encode($this->request->getPost('content')),
			'meta_title' => validate_input($this->request->getPost('meta_title')),
			'meta_description' => validate_input($this->request->getPost('meta_description')),
			'language' => $language,
			'module' => $this->data['module'],
		];
		return $store;
	}

	private function data_current_language($objectid = 0, $language = 'vi'){
		$moduleExtract = explode('_', $this->data['module']);
		$object = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb2.title, tb2.canonical, tb2.description, tb2.content, tb2.meta_title, tb2.meta_description , tb2.sub_title, tb2.sub_content,',
			'table' => $this->data['module'].' as tb1',
			'join' => [
				[
					$moduleExtract[0].'_translate as tb2','tb1.id = tb2.objectid','inner'
				]
			],
			'where' => [
				'tb1.id' => $objectid,
				'tb2.module' => $this->data['module'],
				'tb2.language' => $language,
			]
		]);

		if(isset($object) && is_array($object) && count($object)){
			$object['sub_title'] = json_decode(base64_decode($object['sub_title']));
			$object['sub_content'] = json_decode(base64_decode($object['sub_content']));
		}
		return $object;
	}

	private function data_translate($objectid = 0, $language = 'vi'){
		$moduleExtract = explode('_', $this->data['module']);
		$translate = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb2.title, tb2.canonical, tb2.description, tb2.content, tb2.meta_title, tb2.meta_description',
			'table' => $this->data['module'].' as tb1',
			'join' => [
				[
					$moduleExtract[0].'_translate as tb2', 'tb1.id = tb2.objectid', 'inner'
				]
			],
			'where' => [
				'tb1.id' => $objectid,
				'tb2.module' => $this->data['module'],
				'tb2.language' => $language,
			]
		]);

		if(isset($translate) && is_array($translate) && count($translate)){
			$translate['sub_title'] = json_decode(base64_decode($translate['sub_title']));
			$translate['sub_content'] = json_decode(base64_decode($translate['sub_content']));
		}
		return $translate;
	}

	private function validation($module = ''){
		$validate = [
			'title' => 'required',
			'canonical' => 'required|check_canonical['.$module.']',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			'canonical' => [
				'required' => 'Bạn phải nhập giá trị cho trường đường dẫn',
				'check_canonical' => 'Đường dẫn đã tồn tại, vui lòng chọn đường dẫn khác',
			],
		];
		return [
			'validate'      => $validate,
			'errorValidate' => $errorValidate,
		];
	}
}
