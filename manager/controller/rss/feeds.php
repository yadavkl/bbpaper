<?php
class ControllerRssFeeds extends Controller{

	public function index(){
				
		$data['header']=$this->load->view('rss/header.tpl');
		$data['footer']=$this->load->view('rss/footer.tpl');
		
		$this->response->setOutput($this->load->view('rss/cricket.tpl',$data));
	
	}
	
	public function headline(){	
	
		$url = "https://ajax.googleapis.com/ajax/services/search/news?ned=in&rsz=1&topic=h&v=1.0";	
		$json = file_get_contents($url);
		
		$data = json_decode($json,true);
		
		foreach($data as $results){
			
			$news = $results['results'];
			foreach($news as $new){
				var_dump($new['clusterUrl']);
				var_dump($new['content']);
				var_dump($new['title']);
				var_dump($new['titleNoFormatting']);
				var_dump($new['url']);
				var_dump($new['relatedStories']);
			}
			
		}
		
	}
	

}