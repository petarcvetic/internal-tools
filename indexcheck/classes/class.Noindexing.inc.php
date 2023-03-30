<?php

class Noindexing{	

	private $conn;
	
	public function __construct(){
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql){
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function insert_noindexing_url($url, $status){
		
		try{
			$stmt = $this->conn->prepare("INSERT INTO stage_sites(stage_url,status) VALUES (:stage_url, :status)");
			
			$stmt->bindparam(":stage_url", $url);
			$stmt->bindparam(":status", $status);
				
			$stmt->execute();	
			
			return $stmt;	
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function getNoindexingList(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM stage_sites ORDER BY SUBSTRING(REPLACE(stage_url,'http://','https://'),'8') ASC");

            $stmt->execute();

            $noindexing_urls = $stmt->fetchAll(PDO::FETCH_OBJ );

            $noindexing_url_list=array();
            foreach($noindexing_urls as $url){
                $noindexing_url_list[] = array($url->stage_id, $url->stage_url, $url->status);
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $noindexing_url_list;
    }

    public function getNoindexedSite($site_url){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM stage_sites WHERE stage_url = :url ORDER BY stage_id DESC LIMIT 1");

            $stmt->bindparam(":url", $site_url );
            $stmt->execute();
 
            $result = $stmt->fetch();

        }catch(PDOException $e){
            echo $e->getMessage();
       }   
        return $result;
    }
/*	
	function check_indexing($url){
    	$meta_tags_aray = get_meta_tags($url);
    	$index = 0;

    	foreach($meta_tags_aray as $tag){
			if (strpos($tag, 'noindex') !== false){
				$index =+ 1;
			}
		}
		if($index != 0){
			return false;
		}
		else{
			return true;
		}
    }
*/

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
            $stmt = $this->conn->prepare("DELETE FROM stage_sites WHERE stage_id = :id ");

            $stmt->bindparam(":id", $id );
            $stmt->execute();

			return true;
        }catch(PDOException $e){
            echo $e->getMessage();
       }
	}
	
	
	function edit_URL($id,$stage_url){
		try{
            $stmt = $this->conn->prepare("UPDATE stage_sites SET stage_url=:stage_url WHERE stage_id = :id ");
            $stmt->bindparam(":stage_url", $stage_url);
            $stmt->bindparam(":id", $id );
            $stmt->execute();
			return true;
        }catch(PDOException $e){
            echo $e->getMessage();
       }
	}

}				


?>