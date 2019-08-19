<?php
// wp_enqueue_script('');
class FVNPagination extends HBObject{
	function getListFooter(){
		$format= [];
		$state = $this->model_state->getData();
		unset($state['offset']);
		if(count($state)>0){
			foreach($state as $k=>$v){
				$format []= "{$k}=$v";
			}
		}
// 		debug($this);die;
		$input_html = "<input type='hidden' name='offset' value='{$this->offset}'/>";
		$input_html .= "<input type='hidden' name='limit' value='{$this->limit}'/>";
		return $input_html.paginate_links( array(
// 				'base' => esc_url( get_pagenum_link( ) ),
				'format' => '?'.implode('&',$format).'&offset=%#%',
				'current' => $this->offset,
				'end_size' => 3,
				'total' => ceil($this->total/$this->limit)
			) );
	}
}