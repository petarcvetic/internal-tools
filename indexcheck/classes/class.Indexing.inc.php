<?php
 
class Indexing{	

	private $conn;
	
	public function __construct(){
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	
	public function insert_indexing_url($url, $status){
		
		try{
			$stmt = $this->conn->prepare("INSERT INTO live_sites(live_url,status) VALUES (:live_url, :status)");
			
			$stmt->bindparam(":live_url", $url);
			$stmt->bindparam(":status", $status);
				
			$stmt->execute();	
			
			return $stmt;	
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function getIndexingList(){
        try{
 //           $stmt = $this->conn->prepare("SELECT * FROM live_sites ORDER BY live_url DESC");
 //           $stmt = $this->conn->prepare("SELECT * FROM live_sites ORDER BY SUBSTRING(live_url,'9') ASC");
            $stmt = $this->conn->prepare("SELECT * FROM live_sites ORDER BY SUBSTRING(REPLACE(live_url,'http://','https://'),'8') ASC"); 

            $stmt->execute();

            $indexing_urls = $stmt->fetchAll(PDO::FETCH_OBJ );

            $indexing_url_list=array();
            foreach($indexing_urls as $url){
                $indexing_url_list[] = array($url->live_id, $url->live_url, $url->status);
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $indexing_url_list;
    }

    public function getIndexedSite($site_url){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM live_sites WHERE live_url = :url ORDER BY live_id DESC LIMIT 1");

            $stmt->bindparam(":url", $site_url );
            $stmt->execute();
 
            $result = $stmt->fetch();

        }catch(PDOException $e){
            echo $e->getMessage();
       }
    
        return $result;
    }

    function check_indexing($url){
        $index = 0;
        if(@get_meta_tags($url)){
            $meta_tags_aray = get_meta_tags($url);
            

            foreach($meta_tags_aray as $tag){
                if (strpos($tag, 'noindex') !== false){
                    $index =+ 1;
                }
            }
        }
        else{
            $context = stream_context_create(
                array(
                    "http" => array(
                        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                    )
                )
            );

            if(@file_get_contents($url, false, $context)){
                $content = file_get_contents($url, false, $context);

                if (strpos($content, 'noindex') !== false) {
                    $index = 1;
                }
            }

            else{
                $index = -1;
            }
        }

        if($index < 0){
            return "error";
        }
        else if($index > 0){
            return "1";
        }
        else{
            return "0";
        }
            
    }
	
	function deleteURL($id){
		try{
            $stmt = $this->conn->prepare("DELETE FROM live_sites WHERE live_id = :id ");

            $stmt->bindparam(":id", $id );
            $stmt->execute();
			return true;
        }catch(PDOException $e){
            echo $e->getMessage();
       }
	}


	function edit_URL($id,$live_url){
		try{
            $stmt = $this->conn->prepare("UPDATE live_sites SET live_url=:live_url WHERE live_id = :id ");
            $stmt->bindparam(":live_url", $live_url);
            $stmt->bindparam(":id", $id );
            $stmt->execute();
			return true;
        }catch(PDOException $e){
            echo $e->getMessage();
       }
	}


}	

?>