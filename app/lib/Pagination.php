<?
namespace app\lib;

class Pagination {
    
    public $userPerPage = 3;
    private $route;
    public $current_page;
    private $total;

    //Calculating the amount of pages and current page 
 	public function __construct($route, $total) {
        $this->route = $route;
        $this->total = (int)$total;
        $this->amount = $this->amount();
        $this->setCurrentPage();
    }

    //Render the pagination module
    public function getPagination(){
    	$elems = null;
    	$html = '<nav><ul class="pagination">';
    	for ($page=1; $page <= $this->amount; $page++) { 
    		if($page == $this->current_page){
    			$elems .= '<li class="page-item active"><span class="page-link">'.$page.'</span></li>';
    		} else {
    			$elems .= $this->generateLink($page);
    		}
    	}
    	if(!is_null($elems)){
    		if ($this->current_page < $this->amount) {
                $elems .= $this->generateLink($this->current_page + 1, 'Вперед');
            }
            if ($this->current_page > 1) {
                $elems = $this->generateLink($this->current_page - 1, 'Назад').$elems;
            }
    	}
    	$html .= $elems.' </ul></nav>';
    	return $html;
    }

    //Generate <li> element of pagination
    private function generateLink($page, $text = null){
    	if(!$text)
    		$text = $page;
    	return '<li class="page-item"><a class="page-link" href="/admin/list/'.$page.'">'.$text.'</a></li>';
    }

    //Calculate current page
    private function setCurrentPage() {
        $currentPage = $this->route['page'] ?? 1;
        $this->current_page = $currentPage;
        
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    //Calculate the amount of pages
    private function amount(){
    	return ceil($this->total / $this->userPerPage);
    }
}
?>